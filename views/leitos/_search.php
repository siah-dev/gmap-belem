<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeitosUnidadesSeach */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leitos-unidades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_unidade') ?>

    <?= $form->field($model, 'leito_tipo') ?>

    <?= $form->field($model, 'LT_qnt') ?>

    <?= $form->field($model, 'LT_qnt_sus') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Pesquisar'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reiniciar pesquisa'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
