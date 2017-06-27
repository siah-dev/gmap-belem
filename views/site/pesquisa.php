<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Sistema de Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <?php if(!Yii::$app->user->isGuest){ ?>
    <div class="jumbotron">
        <div class="container">
            <h3>Faça sua busca</h3>
            <?php $form = ActiveForm::begin(['method'=>'post','action'=>Yii::$app->urlManager->baseUrl.'/unidades/search','id'=>'formPesquisa','enableClientValidation'=>true,'enableAjaxValidation'=>false,'class'=>'form-horizontal']);?>
                <div class="form-group">
                    <?= $form->field($model,'conteudo')->input('text',['placeholder'=>'Pesquisar','class'=>'form-control'])->label(false); ?>
                </div>
                <?= Html::submitButton('Pesquisar',['class'=>'btn btn-default']);?>
            <?php $form->end(); ?>
        </div>
    </div>
    <?php }?>
    
    
</div>
