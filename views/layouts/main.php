<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\components\Legendas;
use app\components\Filtros;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img class=\'logo_top\' src=\''.Yii::$app->getUrlManager()->getBaseUrl().'/img/prefeitura.png\' alt=\'PREFEITURA DE BELÉM\' />',
                'brandUrl' => 'http://www.belem.pa.gov.br/',
                'options' => [
                    'class' => 'navbar navbar-default navbar-fixed-top',
                ],
            ]);
	?>
	<div id='ident_local'></div>
   	<div class='container-legend'></div>

    <?php
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right multi-level'],
                'items' => [
                    ['label' => 'Início', 'url' => ['/site/index']],
                    ['label' => 'Mapa', 'url' => ['/site/mapa']],
                    Yii::$app->user->isGuest ? '':['label' => 'Pesquisa', 'url' => ['/site/pesquisa']],
					Yii::$app->user->isGuest ? '':
					['label' => 'Filtros', 'url'=>['/site/mapa'],
													'items' => [	
														'<li class=\'dropdown-header dropdown_submenu\'><a href=\'#\' class=\'btn btn-default btn-xs btn_mFiltros\'>Filtros</a>',										
														Filtros::widget(),
														'</li>',
            											],	
					],
                    Yii::$app->user->isGuest ? '':['label' => 'Painel', 'url' => ['/painel/index']],
                    Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site/login']] :
                    ['label' => 'Sair (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                	],

            ]);
		?>
        <?php
            NavBar::end();
        ?>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left"><img src="<?= Yii::$app->getUrlManager()->getBaseUrl()?>/img/logo.png" /></p>
            <p class="pull-right"><img src="<?= Yii::$app->getUrlManager()->getBaseUrl()?>/img/belem.png" /><?php //Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>