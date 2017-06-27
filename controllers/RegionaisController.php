<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\models\Estabelecimento;

class RegionaisController extends Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['regionalview'],
                'rules' => [
                    [
                        'actions' => ['regionalview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	public function actionRegionalview($crs){
		//if(Yii::$app->request->isAjax){
			//Yii::$app->response->format = Response::FORMAT_JSON;
			$connection = Yii::$app->db;
			$leitos = $connection->createCommand('SELECT lt.descricao as descricao,SUM(LT_qnt) as leito, SUM(LT_qnt_sus) as leito_SUS,  rs.nome as regional
												FROM leitos_unidades lu
												INNER JOIN leito_tipo lt ON lt.id = lu.leito_tipo
												INNER JOIN especialidade_leito esp ON esp.codigo = lt.esp_leito
												INNER JOIN unidades_saude us ON lu.id_unidade = us.id
												INNER JOIN regioes_saude rs ON us.crs = rs.id
												WHERE us.crs = :crs
												GROUP BY lt.descricao')
												->bindValues([':crs'=>$crs])
												->queryAll();
			$data = $this->render('regionalView',['leitos'=>$leitos]);
			return $data;
		//}
	}
}