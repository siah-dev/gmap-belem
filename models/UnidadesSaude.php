<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidades_saude".
 *
 * @property integer $id
 * @property integer $cod_cidade
 * @property string $nome_hospital
 * @property string $descricao
 * @property integer $crs
 * @property double $latitude
 * @property double $longitude
 * @property integer $cnes
 * @property integer $tipo_estabelecimento
 * @property string $urlCnes
 *
 * @property EquipamentosUnidades[] $equipamentosUnidades
 * @property LeitosUnidades[] $leitosUnidades
 * @property Cidade $codCidade
 * @property RegioesSaude $crs0
 * @property Estabelecimento $tipoEstabelecimento
 */
class UnidadesSaude extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidades_saude';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cod_cidade', 'nome_hospital', 'latitude', 'longitude', 'tipo_estabelecimento', 'urlCnes'], 'required'],
            [['cod_cidade', 'crs', 'cnes', 'tipo_estabelecimento'], 'integer'],
            [['descricao'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['nome_hospital'], 'string', 'max' => 100],
            [['urlCnes'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cod_cidade' => Yii::t('app', 'Cidade'),
            'nome_hospital' => Yii::t('app', 'Hospital'),
            'descricao' => Yii::t('app', 'Descricao'),
            'crs' => Yii::t('app', 'CRS'),
            'crr' => Yii::t('app', 'CRR'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'cnes' => Yii::t('app', 'Cnes'),
            'tipo_estabelecimento' => Yii::t('app', 'Tipo Estabelecimento'),
            'urlCnes' => Yii::t('app', 'Url Cnes'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentosUnidades()
    {
        return $this->hasMany(EquipamentosUnidades::className(), ['unidade' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeitosUnidades()
    {
        return $this->hasMany(LeitosUnidades::className(), ['id_unidade' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodCidade()
    {
        return $this->hasOne(Cidade::className(), ['cod_ibge' => 'cod_cidade']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrs0()
    {
        return $this->hasOne(RegioesSaude::className(), ['id' => 'crs']);
    }

    public function getCrr0()
    {
        return $this->hasOne(CentralRegulacaoRegional::className(), ['id' => 'crr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEstabelecimento()
    {
        return $this->hasOne(Estabelecimento::className(), ['id' => 'tipo_estabelecimento']);
    }

    /**
     * @inheritdoc
     * @return UnidadesSaudeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnidadesSaudeQuery(get_called_class());
    }
}
