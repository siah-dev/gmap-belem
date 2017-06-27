<?php

namespace app\controllers;

use app\models\CentralRegulacaoRegional;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use app\models\Estabelecimento;
use app\models\LeitosUnidades;
use app\models\LeitoTipo;
use app\models\UnidadesSaude;
use app\models\Cidade;
use app\models\Estado;
use app\models\RegioesSaude;


class MapaController extends Controller
{
	private $idCrs;
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','mapa'],
                'rules' => [
                    [
                        'actions' => ['logout','mapa'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
	
	public function actionIndex(){
		$cordenadasEstado = Estado::find()->where(['uf'=>'PA'])->all();
		$regioesSaude = RegioesSaude::find()->where(['id'=>'14'])->orderBy('nome')->all();
		$estabelecimentos = Estabelecimento::find()->all();
		//AJAX REQUEST
		if (Yii::$app->request->isAjax){
			$res = Yii::$app->response->format = Response::FORMAT_JSON;	 
			$data = Yii::$app->request->post();
			$unidades = UnidadesSaude::find()
							->joinWith(['leitos','tipoEstabelecimento'])
							->where($data)->asArray()->all();
			
			return json_encode($unidades);
		}
		//FIM AJAX REQUEST
		return $this->render('mapav2',[
									'cordenadasE'=>$cordenadasEstado,
									'regSaude'=>$regioesSaude,
									'estabelecimentos'=>$estabelecimentos,
									]);	
	}
	
	public function actionMarcarMapa(){
		if (Yii::$app->request->isAjax){
			
			$res = Yii::$app->response->format = Response::FORMAT_JSON;	 
			$data = Yii::$app->request->post();
			
				$unidades = UnidadesSaude::find()
							->joinWith(['leitos','tipoEstabelecimento'])
							->where($data)->asArray()->all();
							return json_encode($unidades);
			
			
		}
	}
	
	public function actionTeste(){
		$teste = UnidadesSaude::find()
							->joinWith(['leitos','tipoEstabelecimento'])
							->where(['crs'=>14])->asArray()->all();
		$estabelecimentos = Estabelecimento::find()->all();
		return $this->render('teste',[
									'teste'=>$teste,
									'x'=>$estabelecimentos
									]);	
	}

    /*public function actionTrs($crs = []){
        $cordenadasEstado = Estado::find()->where(['uf'=>'PA'])->all();
        $regioesSaude = CentralRegulacaoRegional::find()->orderBy('id')->all();
        $estabelecimentos = Estabelecimento::find()->all();
        //AJAX REQUEST
        if (Yii::$app->request->isAjax && $crs != NULL){
            $crs = explode(',',$crs);
            $res = Yii::$app->response->format = Response::FORMAT_JSON;
            $data = Yii::$app->request->post();


            $unidades['unidades'] = UnidadesSaude::find()
                ->joinWith(['tipoEstabelecimento','crr0','crs0'])
                ->where($data)->andWhere(['crr'=>$crs])->andWhere('crr IS NOT NULL')->asArray()->all();
            $unidades['regioes'] = CentralRegulacaoRegional::find()->where(['id'=>$crs])->orderBy('regionais')->asArray()->all();
            $unidades['estabelecimentos'] = UnidadesSaude::find()
                ->joinWith(['tipoEstabelecimento'])
                ->where($data)
                ->andWhere(['crr'=>$crs])
                ->groupBy(['tipo_estabelecimento'])
                ->asArray()
                ->all();
            return json_encode($unidades);

        }

        //FIM AJAX REQUEST
        return $this->render('mapatrs',[
            'cordenadasE'=>$cordenadasEstado,
            'regSaude'=>$regioesSaude,
            'estabelecimentos'=>$estabelecimentos,
        ]);
    }*/
}
