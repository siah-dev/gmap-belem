<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "espec_equipamento".
 *
 * @property integer $codigo
 * @property string $descricao
 *
 * @property TipoEquipamentos[] $tipoEquipamentos
 */
class EspecEquipamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'espec_equipamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 100]
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
    public function getTipoEquipamentos()
    {
        return $this->hasMany(TipoEquipamentos::className(), ['cod_esp_eq' => 'codigo']);
    }

    /**
     * @inheritdoc
     * @return EspecEquipamentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EspecEquipamentoQuery(get_called_class());
    }
}
