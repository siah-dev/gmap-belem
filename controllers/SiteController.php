<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use app\models\FormRegister;
use app\models\Users;
use app\models\User;
use app\models\Estabelecimento;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UnidadesSaude;
use app\models\Estado;
use app\models\RegioesSaude;
use app\models\FormSearch;
use yii\widgets\ActiveForm;


class SiteController extends Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','mapa','register'],
                'rules' => [
                    [
                        'actions' => ['logout','mapa','register'],
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

    public function actionIndex()
    {

        $model = new FormSearch();
        return $this->render('index',['model'=>$model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            if (User::isUserAdmin(Yii::$app->user->identity->id))
			{
			 return $this->redirect(["site/mapa"]);
			}
			else
			{
			 return $this->redirect(["site/mapa"]);
			}
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
             if (User::isUserAdmin(Yii::$app->user->identity->id))
			{
			 return $this->redirect(["site/mapa"]);
			}
			else
			{
			 return $this->redirect(["site/mapa"]);
			}
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	 private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
  
	 public function actionConfirm()
	 {
		$table = new Users;
		if (Yii::$app->request->get())
		{
	   
			//Obtenemos el valor de los parámetros get
			$id = Html::encode($_GET["id"]);
			$authKey = $_GET["authKey"];
		
			if ((int) $id)
			{
				//Realizamos la consulta para obtener el registro
				$model = $table
				->find()
				->where("id=:id", [":id" => $id])
				->andWhere("authKey=:authKey", [":authKey" => $authKey]);
	 
				//Si el registro existe
				if ($model->count() == 1)
				{
					$activar = Users::findOne($id);
					$activar->activate = 1;
					if ($activar->update())
					{
						echo "Parabéns registo concluído com sucesso, redirecionando...";
						echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
					}
					else
					{
						echo "Erro ao realizar o registro, redirecionando...";
						echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
					}
				 }
				else //Si no existe redireccionamos a login
				{
					return $this->redirect(["site/login"]);
				}
			}
			else //Si id no es un número entero redireccionamos a login
			{
				return $this->redirect(["site/login"]);
			}
		}
	 }
	 
	 
	 public function actionRegister()
	 {
	  //Creamos la instancia con el model de validación
	  $model = new FormRegister;
	   
	  //Mostrará un mensaje en la vista cuando el usuario se haya registrado
	  $msg = null;
	   
	  //Validación mediante ajax
	  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
			{
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model);
			}
	   
	  //Validación cuando el formulario es enviado vía post
	  //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
	  //También previene por si el usuario tiene desactivado javascript y la
	  //validación mediante ajax no puede ser llevada a cabo
	  if ($model->load(Yii::$app->request->post()))
	  {
	   if($model->validate())
	   {
		//Preparamos la consulta para guardar el usuario
		$table = new Users;
		$table->username = $model->username;
		$table->email = $model->email;
		//Encriptamos el password
		$table->password = crypt($model->password, Yii::$app->params["salt"]);
		//Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
		//clave será utilizada para activar el usuario
		$table->authKey = $this->randKey("abcdef0123456789", 200);
		//Creamos un token de acceso único para el usuario
		$table->accessToken = $this->randKey("abcdef0123456789", 200);
		 
		//Si el registro es guardado correctamente
		if ($table->insert())
		{
		 //Nueva consulta para obtener el id del usuario
		 //Para confirmar al usuario se requiere su id y su authKey
		 $user = $table->find()->where(["email" => $model->email])->one();
		 $id = urlencode($user->id);
		 $authKey = urlencode($user->authKey);
		  
		 $subject = "Confirmar registro";
		 $body = "<h1>Clique no link abaixo para completar o seu registo</h1>";
		 $body .= "<a href='http://siah.dyndns.ws/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
		  
		 //Enviamos el correo
		 Yii::$app->mailer->compose()
		 ->setTo($user->email)
		 ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
		 ->setSubject($subject)
		 ->setHtmlBody($body)
		 ->send();
		 
		 $model->username = null;
		 $model->email = null;
		 $model->password = null;
		 $model->password_repeat = null;
		 
		 $msg = "Parabéns, você agora só precisa confirmar o seu registo em sua caixa de correio";
		}
		else
		{
		 $msg = "Ocorreu um erro na execução de seu registro";
		}
		 
	   }
	   else
	   {
		$model->getErrors();
	   }
	  }
	  return $this->render("register", ["model" => $model, "msg" => $msg]);
	 }
	
	public function actionMapa($crs = array()){
		$cordenadasEstado = Estado::find()->where(['uf'=>'PA'])->all();
		$regioesSaude = RegioesSaude::find()->where('id <> 14')->orderBy('id')->all();
		$estabelecimentos = Estabelecimento::find()->all();
		//AJAX REQUEST
		if (Yii::$app->request->isAjax && $crs != NULL){
			$crs = explode(',',$crs);
			$res = Yii::$app->response->format = Response::FORMAT_JSON;	 
			$data = Yii::$app->request->post();
			
	
			$unidades['unidades'] = UnidadesSaude::find()
							->joinWith(['tipoEstabelecimento','crs0'])
							->where($data)->andWhere(['crs'=>$crs])->andWhere('crs IS NOT NULL')->asArray()->all();
			$unidades['regioes'] = RegioesSaude::find()->where(['id'=>$crs])->orderBy('nome')->asArray()->all();
			$unidades['estabelecimentos'] = UnidadesSaude::find()
															->joinWith(['tipoEstabelecimento'])
															->where($data)
															->andWhere(['crs'=>$crs])
															->groupBy(['tipo_estabelecimento'])
															->asArray()
															->all();
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

    public function actionPesquisa(){
        $model = new FormSearch();
        return $this->render('pesquisa',['model'=>$model]);
    }
	
}
