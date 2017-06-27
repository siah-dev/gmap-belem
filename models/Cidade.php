<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidade".
 *
 * @property string $nome
 * @property integer $estado
 * @property integer $cod_ibge
 * @property string $gentilico
 * @property string $populacao
 * @property double $area_territorial
 * @property double $densidade_demografica
 * @property string $pib
 * @property double $latitude
 * @property double $longitude
 *
 * @property UnidadesSaude[] $unidadesSaudes
 */
class Cidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'cod_ibge', 'populacao', 'pib'], 'integer'],
            [['cod_ibge', 'latitude', 'longitude'], 'required'],
            [['area_territorial', 'densidade_demografica', 'latitude', 'longitude'], 'number'],
            [['nome'], 'string', 'max' => 120],
            [['gentilico'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'estado' => 'Estado',
            'cod_ibge' => 'Cod Ibge',
            'gentilico' => 'Gentilico',
            'populacao' => 'Populacao',
            'area_territorial' => 'Area Territorial',
            'densidade_demografica' => 'Densidade Demografica',
            'pib' => 'Pib',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesSaudes()
    {
        return $this->hasMany(UnidadesSaude::className(), ['cod_cidade' => 'cod_ibge']);
    }

    /**
     * @inheritdoc
     * @return CidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CidadeQuery(get_called_class());
    }
}
