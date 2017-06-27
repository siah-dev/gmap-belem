<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicos_classificacao_unid".
 *
 * @property integer $id
 * @property integer $codigo_serv_classif
 * @property string $terceiro
 * @property string $cnes_recebedor
 * @property integer $id_unid
 */
class ServicosClassificacaoUnid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicos_classificacao_unid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_serv_classif', 'terceiro', 'cnes_recebedor', 'id_unid'], 'required'],
            [['codigo_serv_classif', 'id_unid'], 'integer'],
            [['terceiro', 'cnes_recebedor'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codigo_serv_classif' => Yii::t('app', 'Codigo Serv Classif'),
            'terceiro' => Yii::t('app', 'Terceiro'),
            'cnes_recebedor' => Yii::t('app', 'Cnes Recebedor'),
            'id_unid' => Yii::t('app', 'Id Unid'),
        ];
    }

    /**
     * @inheritdoc
     * @return ServicosClassificacaoUnidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicosClassificacaoUnidQuery(get_called_class());
    }
}
