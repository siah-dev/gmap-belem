<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LeitosUnidades */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Leito de Unidade',
]) . ' ' . $model->idUnidade->nome_hospital;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leitos Unidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
            <div class="panel-body">
                <div class="col-md-6">

                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
