<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnidadesSaude;

/**
 * UnidadesSaudeSearch represents the model behind the search form about `app\models\UnidadesSaude`.
 */
class UnidadesSaudeSearch extends UnidadesSaude
{
    public $crs_n;
    public $cidade_n;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cod_cidade', 'crs', 'crr', 'cnes', 'tipo_estabelecimento'], 'integer'],
            [['nome_hospital', 'descricao', 'urlCnes','crs_n', 'cidade_n'], 'safe'],
            [['latitude', 'longitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UnidadesSaude::find();
        $query->joinWith(['crs0','codCidade']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['crs_n'] = [
            'asc' => ['crs0.nome' => SORT_ASC],
            'desc' => ['crs0.nome' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cidade_n'] = [
            'asc' => ['codCidade.nome' => SORT_ASC],
            'desc' => ['codCidade.nome' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cod_cidade' => $this->cod_cidade,
            'crs' => $this->crs,
            'crr' => $this->crr,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'cnes' => $this->cnes,
            'tipo_estabelecimento' => $this->tipo_estabelecimento,
        ]);

        $query->andFilterWhere(['like', 'nome_hospital', $this->nome_hospital])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'urlCnes', $this->urlCnes])
            ->andFilterWhere(['like', 'crs.nome', $this->crs_n])
            ->andFilterWhere(['like', 'cidade.nome', $this->cidade_n]);

        return $dataProvider;
    }
}
