<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_equipamentos".
 *
 * @property integer $id
 * @property integer $cod_esp_eq
 * @property string $descricao
 *
 * @property EquipamentosUnidades[] $equipamentosUnidades
 * @property EspecEquipamento $codEspEq
 */
class TipoEquipamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_equipamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cod_esp_eq', 'descricao'], 'required'],
            [['cod_esp_eq'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'cod_esp_eq' => Yii::t('app', 'Cod Esp Eq'),
            'descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentosUnidades()
    {
        return $this->hasMany(EquipamentosUnidades::className(), ['id_tipo_eq' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodEspEq()
    {
        return $this->hasOne(EspecEquipamento::className(), ['codigo' => 'cod_esp_eq']);
    }

    /**
     * @inheritdoc
     * @return TipoEquipamentosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoEquipamentosQuery(get_called_class());
    }
}
