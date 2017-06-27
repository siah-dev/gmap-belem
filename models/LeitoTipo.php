<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leito_tipo".
 *
 * @property integer $id
 * @property integer $esp_leito
 * @property string $descricao
 *
 * @property EspecialidadeLeito $espLeito
 * @property LeitosUnidades[] $leitosUnidades
 */
class LeitoTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leito_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['esp_leito', 'descricao'], 'required'],
            [['esp_leito'], 'integer'],
            [['descricao'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'esp_leito' => Yii::t('app', 'Esp Leito'),
            'descricao' => Yii::t('app', 'Descricao'),
        ];
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspLeito()
    {
        return $this->hasOne(EspecialidadeLeito::className(), ['codigo' => 'esp_leito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeitosUnidades()
    {
        return $this->hasMany(LeitosUnidades::className(), ['leito_tipo' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LeitoTipoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LeitoTipoQuery(get_called_class());
    }
}
