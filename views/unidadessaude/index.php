<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UnidadesSaudeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Unidades de Saúde');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidades-saude-index">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div><!--/.row-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nova Unidade de Saúde'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'cidade_n',
                'value' => 'codCidade.nome',
                'label'=>'Cidade'
            ],
            'nome_hospital',
            'descricao:ntext',
            [
                'attribute' => 'crs_n',
                'value' => 'crs0.nome',
                'label'=>'CRS'
            ],
            // 'crr',
            // 'latitude',
            // 'longitude',
            // 'cnes',
            // 'tipo_estabelecimento',
            // 'urlCnes:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
