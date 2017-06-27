<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicos_esp_unid".
 *
 * @property integer $id
 * @property integer $id_serv
 * @property string $caracteristica
 * @property string $amb_sus
 * @property string $amb_n_sus
 * @property string $hospitalar_sus
 * @property string $hospitalar_n_sus
 * @property integer $id_unid
 */
class ServicosEspUnid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicos_esp_unid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_serv', 'caracteristica', 'amb_sus', 'amb_n_sus', 'hospitalar_sus', 'hospitalar_n_sus', 'id_unid'], 'required'],
            [['id_serv', 'id_unid'], 'integer'],
            [['caracteristica'], 'string', 'max' => 20],
            [['amb_sus', 'amb_n_sus', 'hospitalar_sus', 'hospitalar_n_sus'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_serv' => Yii::t('app', 'Id Serv'),
            'caracteristica' => Yii::t('app', 'Caracteristica'),
            'amb_sus' => Yii::t('app', 'Amb Sus'),
            'amb_n_sus' => Yii::t('app', 'Amb N Sus'),
            'hospitalar_sus' => Yii::t('app', 'Hospitalar Sus'),
            'hospitalar_n_sus' => Yii::t('app', 'Hospitalar N Sus'),
            'id_unid' => Yii::t('app', 'Id Unid'),
        ];
    }

    /**
     * @inheritdoc
     * @return ServicosEspUnidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicosEspUnidQuery(get_called_class());
    }
}
