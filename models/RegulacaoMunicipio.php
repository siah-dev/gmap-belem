<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regulacao_municipio".
 *
 * @property integer $id
 * @property integer $cod_ibge
 * @property integer $crr
 *
 * @property CentralRegulacaoRegional $crr0
 * @property Cidade $codIbge
 */
class RegulacaoMunicipio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regulacao_municipio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cod_ibge', 'crr'], 'required'],
            [['cod_ibge', 'crr'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cod_ibge' => Yii::t('app', 'Cod Ibge'),
            'crr' => Yii::t('app', 'Crr'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrr0()
    {
        return $this->hasOne(CentralRegulacaoRegional::className(), ['id' => 'crr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodIbge()
    {
        return $this->hasOne(Cidade::className(), ['cod_ibge' => 'cod_ibge']);
    }
}
