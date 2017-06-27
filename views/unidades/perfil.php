<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Sistema de Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
  	<div class="row">
		<h2><?= $perfil->nome_hospital;?> <small class="text-uppercase">Perfil</small></h2>
		<p class="text-justify"><?= $perfil->descricao;?></p>
    </div>
</div>