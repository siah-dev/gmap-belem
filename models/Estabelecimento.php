<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estabelecimento".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $img
 *
 * @property UnidadesSaude[] $unidadesSaudes
 */
class Estabelecimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estabelecimento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'img'], 'required'],
            [['tipo', 'img'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
            'img' => Yii::t('app', 'Img'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesSaudes()
    {
        return $this->hasMany(UnidadesSaude::className(), ['tipo_estabelecimento' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EstabelecimentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstabelecimentoQuery(get_called_class());
    }
}
