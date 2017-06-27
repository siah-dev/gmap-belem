<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
$this->title = 'Sistema de Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'filterModel'=>$model,
    'columns'=>[
        'nome_hospital',
        'descricao:html',
        'crs0.nome:text:Região de Saúde',
        'codCidade.nome:text:Cidade',
    ]
]);
?>