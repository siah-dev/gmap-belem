<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\Grupo;

class ListDropMenu extends Widget{
	public $message;
	
	public function init(){
		parent::init();
		$regioesSaude = Grupo::find()->orderBy('nome')->all();
		foreach($regioesSaude as $val){
			$this->message .= '<li><a href=\'#\' tabindex=\'-1\'>'.$val->sigla.'</a>';	
		}
	}
	
	public function run(){
		return $this->message;
	}
}
?>