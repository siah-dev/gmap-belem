<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipamentos_unidades".
 *
 * @property integer $id
 * @property integer $id_tipo_eq
 * @property integer $unidade
 * @property integer $existente
 * @property integer $em_uso
 * @property string $sus
 *
 * @property TipoEquipamentos $idTipoEq
 * @property UnidadesSaude $unidade0
 */
class EquipamentosUnidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipamentos_unidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_eq', 'unidade', 'existente', 'em_uso', 'sus'], 'required'],
            [['id_tipo_eq', 'unidade', 'existente', 'em_uso'], 'integer'],
            [['sus'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_tipo_eq' => Yii::t('app', 'Id Tipo Eq'),
            'unidade' => Yii::t('app', 'Unidade'),
            'existente' => Yii::t('app', 'Existente'),
            'em_uso' => Yii::t('app', 'Em Uso'),
            'sus' => Yii::t('app', 'Sus'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoEq()
    {
        return $this->hasOne(TipoEquipamentos::className(), ['id' => 'id_tipo_eq']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidade0()
    {
        return $this->hasOne(UnidadesSaude::className(), ['id' => 'unidade']);
    }

    /**
     * @inheritdoc
     * @return EquipamentosUnidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EquipamentosUnidadesQuery(get_called_class());
    }
}
