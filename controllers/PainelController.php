<?php

namespace app\controllers;

use app\models\UnidadesSaude;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * PainelController implements the CRUD actions for LeitosUnidades model.
 */
class PainelController extends Controller
{
    public $layout = 'painel';
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','datasus'],
                'rules' => [
                    [
                        'actions' => ['index','datasus'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionDatasus(){
        if(Yii::$app->request->isAjax){
            $model = UnidadesSaude::findOne(Yii::$app->request->post('id'));
            $cod_unidade = substr((string)$model->cod_cidade,0,-1).(string)$model->cnes;
            $hosp_leitos = "http://cnes2.datasus.gov.br/cabecalho_reduzido.asp?VCod_Unidade=".$cod_unidade;

            $url = file_get_contents($hosp_leitos);

            return $this->renderAjax('extractdatasus',['data'=>$url]);
        }
        return $this->render('datasus');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}