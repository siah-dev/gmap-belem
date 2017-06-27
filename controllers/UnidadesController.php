<?php

namespace app\controllers;

use app\models\FormSearch;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use app\models\LeitosUnidades;
use app\models\UnidadesSaude;
use app\models\UnidadesSearch;

class UnidadesController extends Controller
{
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['leitos','leitodetalhe'],
                'rules' => [
                    [
                        'actions' => ['leitos','leitodetalhe'],
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
	
	public function actionDetalhes($id,$crs){
		if(Yii::$app->request->isAjax){
			Yii::$app->response->format = Response::FORMAT_JSON;
				//NOVO LEITO BANCO DE DADOS
				$leitosComplementares = LeitosUnidades::find()->joinWith(['leitoTipo','idUnidade'])->where(['id_unidade'=>$id,'esp_leito'=>999])->all();
				
				$connection = Yii::$app->db;
				$leitos = $connection->createCommand('SELECT SUM(LT_qnt) as leitos, SUM(LT_qnt_sus) as leitos_SUS, esp.descricao,esp.codigo,lu.id_unidade 
													FROM leitos_unidades lu
													INNER JOIN leito_tipo lt ON lt.id = lu.leito_tipo
													INNER JOIN especialidade_leito esp ON lt.esp_leito = esp.codigo
													INNER JOIN unidades_saude us ON us.id = lu.id_unidade
													WHERE lu.id_unidade = :id_unidade
													GROUP BY esp.descricao')
													->bindValues([':id_unidade'=>$id])
													->queryAll();
				$equipamentos = $connection->createCommand('SELECT SUM(EU.existente) as existente, SUM(EU.em_uso) as em_uso, EU.sus, EE.descricao,EE.codigo,EU.unidade 
													FROM equipamentos_unidades EU
													INNER JOIN tipo_equipamentos TE ON TE.id = EU.id_tipo_eq
													INNER JOIN unidades_saude US ON US.id = EU.unidade
													INNER JOIN regioes_saude RS ON RS.id = US.crs
													INNER JOIN espec_equipamento EE ON EE.codigo = TE.cod_esp_eq
													WHERE EU.unidade = :id_unidade
													GROUP BY EE.descricao')
													->bindValues([':id_unidade'=>$id])
													->queryAll();
				$servicos_esp = $connection->createCommand('SELECT SEU.id_serv,
																	SEU.caracteristica,
																	SEU.amb_sus,
																	SEU.amb_n_sus,
																	SEU.hospitalar_sus,
																	SEU.hospitalar_n_sus,
																	SE.descricao,
																	SEU.id_unid
															FROM servicos_esp_unid SEU
															INNER JOIN servicos_especializados SE ON SEU.id_serv = SE.id
															WHERE id_unid = :id_unidade')
											->bindValues([':id_unidade'=>$id])
											->queryAll();

            $cidades = $connection->createCommand("SELECT c.nome AS  'nome', c.populacao AS  'populacao'
                                                    FROM regulacao_municipio r
                                                    INNER JOIN cidade c ON c.cod_ibge = r.cod_ibge
                                                    INNER JOIN central_regulacao_regional cc ON cc.id = r.crr
                                                    INNER JOIN unidades_saude u ON u.crr = cc.id
                                                    WHERE u.id = :id_unidade")
                ->bindValues([':id_unidade'=>$id])
                ->queryAll();
				
				$unidade = UnidadesSaude::find()->where(['id'=>$id])->one();
				$data = $this->renderPartial('leitosv2',['id'=>$id,'cidades'=>$cidades,'leitos'=>$leitos,'leitosComplementares'=>$leitosComplementares,'unidade'=>$unidade,'equipamentos'=>$equipamentos,'servicos'=>$servicos_esp]);
				$data = str_replace("\t","",$data);
				$data = str_replace("\n","",$data);
				$data = str_replace("\r","",$data);
				return $data;
		}
    }
	
	public function actionLeitodetalhe($unidade,$especialidade){
			$connection = Yii::$app->db;
			$leitos = $connection->createCommand('SELECT lt.descricao as descricao,LT_qnt as leito, LT_qnt_sus as leito_SUS, us.nome_hospital as hospital, rs.nome as regional, esp.descricao as esp_descricao
												FROM leitos_unidades lu
												INNER JOIN leito_tipo lt ON lt.id = lu.leito_tipo
												INNER JOIN especialidade_leito esp ON esp.codigo = lt.esp_leito
												INNER JOIN unidades_saude us ON lu.id_unidade = us.id
												INNER JOIN regioes_saude rs ON us.crs = rs.id
												WHERE esp.codigo = :espc AND lu.id_unidade = :id_unidade
												GROUP BY lt.descricao')
												->bindValues([':espc'=>$especialidade,':id_unidade'=>$unidade])
												->queryAll();
			$data = $this->render('leitoDetalhe',['leitos'=>$leitos]);
			return $data;
	}
	
	public function actionEquipamentodetalhe($unidade,$especialidade){
		$connection = Yii::$app->db;
		$equipamentos = $connection->createCommand('SELECT EU.id, EU.unidade, US.nome_hospital as hospital, RS.nome as regional, EU.existente, EU.em_uso, EU.sus,EE.codigo, EE.descricao as esp_descricao, TE.id, TE.cod_esp_eq, TE.descricao
													FROM equipamentos_unidades EU
													INNER JOIN tipo_equipamentos TE ON TE.id = EU.id_tipo_eq
													INNER JOIN unidades_saude US ON US.id = EU.unidade
													INNER JOIN regioes_saude RS ON RS.id = US.crs
													INNER JOIN espec_equipamento EE ON EE.codigo = TE.cod_esp_eq
													WHERE EU.unidade = :id_unidade AND TE.cod_esp_eq = :esp')
													->bindValues([':esp'=>$especialidade,':id_unidade'=>$unidade])
													->queryAll();
		return $this->render('equipamentoDetalhe',['equipamentos'=>$equipamentos]);
	}
	
	public function actionServicoclassificacao($unidade,$id_serv){
		$connection = Yii::$app->db;
		$serv_classificacao = $connection->createCommand('SELECT SC.descricao, SCU.terceiro,SCU.cnes_recebedor,US.nome_hospital as hospital,RS.nome as regional,SE.descricao as desc_servico
														FROM servicos_classificacao_unid SCU
														INNER JOIN servicos_classificacao SC ON SCU.codigo_serv_classif = SC.codigo
														INNER JOIN servicos_especializados SE ON SE.id = SC.id_serv
														INNER JOIN unidades_saude US ON US.id = SCU.id_unid
														INNER JOIN regioes_saude RS ON US.crs = RS.id
														WHERE id_unid = :id_unidade AND SC.id_serv = :id_serv
														ORDER BY SC.descricao')
													->bindValues([':id_serv'=>$id_serv,':id_unidade'=>$unidade])
													->queryAll();
		return $this->render('servicoClassificacao',['serv_classificacao'=>$serv_classificacao]);
	}
	
	public function actionPerfil($id){
		$perfil = UnidadesSaude::find()->where(['id'=>$id])->one();
		return $this->render('perfil',['perfil'=>$perfil]);
	}

    public function actionSearch(){
                $model = new FormSearch();
                $model->load(Yii::$app->request->post());
                $pesquisa = new UnidadesSearch();
                $pesquisa->setAttribute('conteudo',$model->conteudo);
                $result = $pesquisa->search();
                return $this->render('pesquisa',['dataProvider'=>$result,'model'=>$model]);
    }
}