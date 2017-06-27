<?php
namespace app\components;
use yii\helpers\Url;
use yii\base\Widget;
use yii\helpers\Html;


class Legendas extends Widget{
	public $message;
	public function init(){
		parent::init();
		$this->message = "<div class='container-legend'>";
		$this->message .= "</div>";
	}
	
	public function run(){
		return $this->message;
	}
}
?>