<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class UnidadesSearch extends UnidadesSaude // extends from Tour see?
{
    // add the public attributes that will be used to store the data to be search
    public $conteudo;
    public $unidades;
    public $crs;
    public $cidade;

    public function attributes(){
        return array_merge(parent::attributes(),['crs0.nome','codCidade.nome','conteudo']);
    }

    // now set the rules to make those attributes safe
    public function rules()
    {
        return [
            // ... more stuff here
            [['conteudo','unidades','crs0.nome','cidade'], 'safe'],
            // ... more grid configuration here
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params = [])
    {
        // create ActiveQuery
        $query = UnidadesSaude::find();

        $query->joinWith(['crs0','codCidade']);

        $query->andFilterWhere(['or',
            ['LIKE', 'regioes_saude.nome', $this->getAttribute('conteudo')],
            ['LIKE', 'cidade.nome', $this->getAttribute('conteudo')],
            ['LIKE', 'descricao', $this->getAttribute('conteudo')],
            ['LIKE', 'nome_hospital', $this->getAttribute('conteudo')]
            //... other searched attributes here
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>false,
        ]);
        /*
        $dataProvider->sort->attributes['crs0.nome'] = [
            'asc' => ['regioes_saude.nome' => SORT_ASC],
            'desc' => ['regioes_saude.nome' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['codCidade.nome'] = [
            'asc' => ['cidade.nome' => SORT_ASC],
            'desc' => ['cidade.nome' => SORT_DESC],
        ];
        */
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        return $dataProvider;
    }


}
