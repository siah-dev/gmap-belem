<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regioes_saude".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property UnidadesSaude[] $unidadesSaudes
 */
class RegioesSaude extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regioes_saude';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['nome'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadesSaudes()
    {
        return $this->hasMany(UnidadesSaude::className(), ['crs' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RegioesSaudeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegioesSaudeQuery(get_called_class());
    }
}
