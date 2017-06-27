<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especialidade_leito".
 *
 * @property integer $codigo
 * @property string $descricao
 *
 * @property LeitosUnidades[] $leitosUnidades
 */
class EspecialidadeLeito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'especialidade_leito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descricao'], 'required'],
            [['codigo'], 'integer'],
            [['descricao'], 'string', 'max' => 100],
            [['descricao'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => Yii::t('app', 'Codigo'),
            'descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeitosUnidades()
    {
        return $this->hasMany(LeitosUnidades::className(), ['id_esp_leito' => 'codigo']);
    }

    /**
     * @inheritdoc
     * @return EspecialidadeLeitoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EspecialidadeLeitoQuery(get_called_class());
    }
}
