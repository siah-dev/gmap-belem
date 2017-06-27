<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeitosUnidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leitos-unidades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_unidade')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\UnidadesSaude::find()->all(),'id','nome_hospital'),
        ['disabled'=>$model->isNewRecord?false:'disabled','prompt'=>'Selecione a Unidade de Saúde']
    ) ?>

    <?= $form->field($model, 'leito_tipo')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\LeitoTipo::find()->all(),'id','descricao'),
        ['disabled'=>$model->isNewRecord?false:'disabled','prompt'=>'Selecione o tipo de Leito']
    ) ?>

    <?= $form->field($model, 'LT_qnt')->textInput() ?>

    <?= $form->field($model, 'LT_qnt_sus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
