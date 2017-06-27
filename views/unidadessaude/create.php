<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UnidadesSaude */

$this->title = Yii::t('app', 'Nova Unidade de Saúde');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidade de Saúde'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
