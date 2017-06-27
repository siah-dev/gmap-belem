<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "leitos_unidades".
 *
 * @property integer $id
 * @property integer $id_unidade
 * @property integer $leito_tipo
 * @property integer $LT_qnt
 * @property integer $LT_qnt_sus
 *
 * @property LeitoTipo $leitoTipo
 * @property UnidadesSaude $idUnidade
 */
class LeitosUnidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leitos_unidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_unidade', 'leito_tipo', 'LT_qnt', 'LT_qnt_sus'], 'required'],
            [['id_unidade', 'leito_tipo', 'LT_qnt', 'LT_qnt_sus'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_unidade' => Yii::t('app', 'Unidade'),
            'leito_tipo' => Yii::t('app', 'Tipo de Leito'),
            'LT_qnt' => Yii::t('app', 'Quantidade de Leitos (Próprio)'),
            'LT_qnt_sus' => Yii::t('app', 'Quantidade de Leitos (SUS)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeitoTipo()
    {
        return $this->hasOne(LeitoTipo::className(), ['id' => 'leito_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidade()
    {
        return $this->hasOne(UnidadesSaude::className(), ['id' => 'id_unidade']);
    }

    /**
     * @inheritdoc
     * @return LeitosUnidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LeitosUnidadesQuery(get_called_class());
    }
}
