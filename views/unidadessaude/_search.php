<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadesSaudeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unidades-saude-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cod_cidade') ?>

    <?= $form->field($model, 'nome_hospital') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'crs') ?>

    <?php // echo $form->field($model, 'crr') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'cnes') ?>

    <?php // echo $form->field($model, 'tipo_estabelecimento') ?>

    <?php // echo $form->field($model, 'urlCnes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
