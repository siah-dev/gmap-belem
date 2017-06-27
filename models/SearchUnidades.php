<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnidadesSaude;

/**
 * SearchUnidades represents the model behind the search form about `app\models\UnidadesSaude`.
 */
class SearchUnidades extends UnidadesSaude
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cod_cidade', 'crs', 'cnes', 'tipo_estabelecimento'], 'integer'],
            [['nome_hospital', 'descricao', 'urlCnes'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'cnes' => $this->cnes,
            'tipo_estabelecimento' => $this->tipo_estabelecimento,
        ]);

        $query->andFilterWhere(['like', 'nome_hospital', $this->nome_hospital])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'urlCnes', $this->urlCnes]);

        return $dataProvider;
    }
}
