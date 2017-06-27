<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LeitosUnidades;

/**
 * LeitosUnidadesSeach represents the model behind the search form about `app\models\LeitosUnidades`.
 */
class LeitosUnidadesSeach extends LeitosUnidades
{
    public $unidade;
    public $tleito;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_unidade', 'leito_tipo', 'LT_qnt', 'LT_qnt_sus'], 'integer'],
            [['unidade', 'tleito'], 'safe'],
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
        $query = LeitosUnidades::find();
        $query->joinWith(['idUnidade','leitoTipo']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['unidade'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['idUnidade.nome_hospital' => SORT_ASC],
            'desc' => ['idUnidade.nome_hospital' => SORT_DESC],
        ];
        // Lets do the same with country now
        $dataProvider->sort->attributes['tleito'] = [
            'asc' => ['leitoTipo.descricao' => SORT_ASC],
            'desc' => ['leitoTipo.descricao' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_unidade' => $this->id_unidade,
            'leito_tipo' => $this->leito_tipo,
            'LT_qnt' => $this->LT_qnt,
            'LT_qnt_sus' => $this->LT_qnt_sus,
        ])
            ->andFilterWhere(['like', 'unidades_saude.nome_hospital', $this->unidade])
            ->andFilterWhere(['like', 'leito_tipo.descricao', $this->tleito]);

        return $dataProvider;
    }
}
