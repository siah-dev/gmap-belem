<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'Sistema de Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="container text-center">
        <h1>Seja bem vindo!</h1>
		<?php if(Yii::$app->user->isGuest){ ?>
        <p class="lead">Para acessar o sistema de mapas, favor, efetuar Login do usuário.</p>
		<?php }else{ ?>
        <p class="lead"></p>
        <?php }?>
        <p>
        	<?php if(Yii::$app->user->isGuest){ ?>
            	<a class="btn btn-lg btn-success" href="<?= Url::toRoute('site/login');?>">Login</a></p>
            <?php }else{ ?>
            	<a class="btn btn-lg btn-success" href="<?= Url::toRoute('site/mapa');?>">Mapa</a></p>
            <?php }?>
    </div>
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
