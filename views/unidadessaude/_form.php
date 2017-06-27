<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cidade;
use app\models\CentralRegulacaoRegional;
use app\models\RegioesSaude;
use app\models\Estabelecimento;
/* @var $this yii\web\View */
/* @var $model app\models\UnidadesSaude */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidades-saude-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cod_cidade')->dropDownList(ArrayHelper::map(Cidade::find()->all(),'cod_ibge','nome'),['prompt'=>'Escolha uma cidade']) ?>

    <?= $form->field($model, 'nome_hospital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'crs')->dropDownList(ArrayHelper::map(RegioesSaude::find()->all(),'id','nome'),['prompt'=>'Selecione uma Região de Saúde']) ?>

    <?= $form->field($model, 'crr')->dropDownList(ArrayHelper::map(CentralRegulacaoRegional::find()->all(),'id','regionais'),['prompt'=>'Selecione uma Central de Regulação Regional']) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'cnes')->textInput() ?>

    <?= $form->field($model, 'tipo_estabelecimento')->dropDownList(ArrayHelper::map(Estabelecimento::find()->all(),'id','tipo'),['prompt'=>'Selecione o tipo de Estabelecimento']) ?>

    <?= $form->field($model, 'urlCnes')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Novo') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
