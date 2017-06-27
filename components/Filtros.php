<?php
namespace app\components;
use yii\helpers\Url;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Estabelecimento;
use app\models\RegioesSaude;


class Filtros extends Widget{
	public $message;
	
	public function init(){
		parent::init();
		$regionais = RegioesSaude::find()->orderBy('id')->all();
		$estabelecimentos = Estabelecimento::find()->orderBy('tipo')->all();
		/*$this->message = "<a href='#' data-toggle='dropdown' class='dropdown-toggle btn_mFiltros'>Por estabelecimento <b class='caret'></b></a>";
		$this->message .= "<ul class='dropdown-submenu'>";
		foreach($estabelecimentos as $estabelecimento){
			$this->message .= "<li><a href='#' tabindex='-1' class='small'>".$estabelecimento->tipo."</a></li>";	
		}
		$this->message .= "</ul>";
		*/
		$this->message = "<a href='#' data-toggle='dropdown' class='dropdown-toggle btn_mFiltros' target='_blank'>Regionais <b class='caret'></b></a>";
		$this->message .= "<ul class='dropdown-submenu'>";
		foreach($regionais as $reg){
			$this->message .= "<li><a href='../regionais/regionalview?crs=".$reg->id."' tabindex='-1' class='small'>".$reg->nome."</a></li>";	
		}
		$this->message .= "</ul>";
		$this->message .= "<div id='unidades_saudeContainer' style='display:none'><a href='#' class='btn_mFiltros'>Unidades de Saúde<b class='caret'></b></a>";
		$this->message .= "<div class='unidades_saude' style='height:300px;overflow: scroll;'>";
		$this->message .= "</div></div>";
	}
	
	public function run(){
		return $this->message;
	}
}
?>