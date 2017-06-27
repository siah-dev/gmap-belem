<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "central_regulacao_regional".
 *
 * @property integer $id
 * @property string $regionais
 *
 * @property RegulacaoMunicipio[] $regulacaoMunicipios
 * @property UnidadesSaude[] $unidadesSaudes
 */
class CentralRegulacaoRegional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'central_regulacao_regional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionais'], 'required'],
            [['regionais'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'regionais' => Yii::t('app', 'Regionais'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegulacaoMunicipios()
    {
        return $this->hasMany(RegulacaoMunicipio::className(), ['crr' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesSaudes()
    {
        return $this->hasMany(UnidadesSaude::className(), ['crr' => 'id']);
    }
}
