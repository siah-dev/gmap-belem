<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Sistema de Mapas'; 
?>


		<?php 
				$link = Html::a('Iniciar o Mapa', Url::toRoute('site/mapa'), [
						'id' => 'initMapa',
						'class'=>'btn btn-lg btn-success margin-top',
						'data-on-done' => 'simpleDone',
					]
				);
				echo Html::tag('div', $link, ['id' => 'mapa']);	
		?>

		<?php $this->registerJs("$('#initMapa').click(handleAjaxLink);", \yii\web\View::POS_READY); ?>
        <!-- Maps API Javascript -->
       <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBC52jiaTp1RQFL6c1reMZdEPtQde9ZSC0&sensor=FALSE"></script>
       
       
