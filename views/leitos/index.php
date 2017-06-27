<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeitosUnidadesSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Leitos de Unidade');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leitos-unidades-index">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div><!--/.row-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Novo Leito para Unidade'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
                [
                    'attribute' => 'unidade',
                    'value' => 'idUnidade.nome_hospital',
                    'label'=>'Unidade'
                ],
                [
                    'attribute' => 'tleito',
                    'value' => 'leitoTipo.descricao',
                    'label'=>'Leito'
                ],
            'LT_qnt:text:LEITO QNT',
            'LT_qnt_sus:text:LEITO QNT SUS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
