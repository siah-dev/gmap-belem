<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UnidadesSaude */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidade de Saúde'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidades-saude-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Atualizar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Excluir'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Você realmente deseja excluir este item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cod_cidade',
            'nome_hospital',
            'descricao:ntext',
            'crs0.nome:ntext:CRS',
            'crr0.nome:ntext:CRR',
            'latitude',
            'longitude',
            'cnes',
            'tipo_estabelecimento',
            'urlCnes:url',
        ],
    ]) ?>

</div>
