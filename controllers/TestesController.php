<?php

namespace app\controllers;

use app\models\EquipamentosUnidades;
use app\models\EspecEquipamento;
use app\models\ServicosEspUnid;
use app\models\TipoEquipamentos;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\models\Estabelecimento;
use app\models\Leitos;
use app\models\LeitoTipo;
use app\models\LeitosUnidades;
use app\models\UnidadesSaude;

use yii\db\Connection;

class TestesController extends Controller
{
	public function actionTeste(){
		$teste = [1,2,3];
		$connection = Yii::$app->db;
		$id = 330;
		$teste = $connection->createCommand('SELECT SUM(LT_qnt) as leitos, SUM(LT_qnt_sus) as leitos_SUS, esp.descricao 
											FROM leitos_unidades lu
											INNER JOIN leito_tipo lt ON lt.id = lu.leito_tipo
											INNER JOIN especialidade_leito esp ON lt.esp_leito = esp.codigo
											INNER JOIN unidades_saude us ON us.id = lu.id_unidade
											WHERE lu.id_unidade = :id_unidade
											GROUP BY esp.descricao')
											->bindValues([':id_unidade'=>$id])
											->queryAll();

			return $this->render('testes',['teste'=>$teste]);
		}

	public function actionImportunidades(){
        $file = file(Yii::$app->basePath.'\web\dados\unidades.CSV');
        $total = 0;
        foreach ($file as $k => $v){
            list($c_cidade,$nome,$desc, $crs,$crr,$lat,$lon,$cnes,$t_e,$url) = explode(';',$v);
            $nome = str_replace('_',' ',$nome);
            $unidade = new UnidadesSaude();
            $unidade->cod_cidade = $c_cidade;
            $unidade->nome_hospital = $nome;
            $unidade->descricao = $desc;
            $unidade->crs = $crs;
            $unidade->crr = $crr;
            $unidade->latitude = $lat;
            $unidade->longitude = $lon;
            $unidade->cnes = $cnes;
            $unidade->tipo_estabelecimento = $t_e;
            $unidade->urlCnes = $url.(string)$c_cidade.(string)$cnes;
            try{
                $unidade->save();
                $msg = 'Inserido com sucesso';
            }catch (\PDOException $e){
                $msg ='Erro ao salvar banco de dados';
            }
            $total++;
        }
		return $this->render('response',['msg'=>$msg,'total'=>$total]);
	}

    public function actionImportleitos(){
        $file = file(Yii::$app->basePath.'\web\dados\leitos.CSV');
        $total = 0;
        foreach ($file as $k => $v) {
            list($especialidade,$codigo,$nome,$leitos_existentes,$sus,$cnes) = explode(';', $v);
            $unidade = UnidadesSaude::find()->andWhere(['cnes'=>(int)$cnes])->one();
            $l = new LeitosUnidades();
            $l->leito_tipo = (int)$codigo;
            $l->LT_qnt = (int)$leitos_existentes;
            $l->LT_qnt_sus = (int)$sus;
            $l->id_unidade = (int)$unidade->id;
            try {
                $l->save();
                $msg = 'Inserido com sucesso';
            }catch (\PDOException $e){
                $msg = 'Erro ao salvar leito';
            }
        $total++;
        }
        return $this->render('response',['msg'=>$msg,'total'=>$total]);
    }
    public function actionImportservicosesp(){
        $file = file(Yii::$app->basePath.'\web\dados\servicos_especializados.CSV');
        $total = 0;
        foreach ($file as $k => $v) {
            list($cod,$servico,$caracteristicas,$amb_sus,$amb_n_sus,$hosp_sus,$hosp_n_sus,$cnes) = explode(';', $v);
            $unidade = UnidadesSaude::find()->andWhere(['cnes'=>(int)$cnes])->one();
            $s = new ServicosEspUnid();
            $s->id_serv = $cod;
            $s->caracteristica = utf8_encode($caracteristicas);
            $s->amb_sus = utf8_encode($amb_sus);
            $s->amb_n_sus = utf8_encode($amb_n_sus);
            $s->hospitalar_sus = utf8_encode($hosp_sus);
            $s->hospitalar_n_sus = utf8_encode($hosp_n_sus);
            $s->id_unid = $unidade->id;
            try {
                $s->save();
                $msg = 'Inserido com sucesso';
            }catch (\PDOException $e){
                $msg = 'Erro ao salvar leito';
            }
            $total++;
        }
        return $this->render('response',['msg'=>$msg,'total'=>$total]);
    }
    public function actionImportservicosclass(){
        $file = file(Yii::$app->basePath.'\web\dados\servicos_classificacao.CSV');
        $total = 0;
        foreach ($file as $k => $v) {
            list($cod,$servico,$caracteristicas,$amb_sus,$amb_n_sus,$hosp_sus,$hosp_n_sus,$cnes) = explode(';', $v);
            $unidade = UnidadesSaude::find()->andWhere(['cnes'=>(int)$cnes])->one();
            $s = new Ser();
            $s->id_serv = $cod;
            $s->caracteristica = utf8_encode($caracteristicas);
            $s->amb_sus = utf8_encode($amb_sus);
            $s->amb_n_sus = utf8_encode($amb_n_sus);
            $s->hospitalar_sus = utf8_encode($hosp_sus);
            $s->hospitalar_n_sus = utf8_encode($hosp_n_sus);
            $s->id_unid = $unidade->id;
            try {
                $s->save();
                $msg = 'Inserido com sucesso';
            }catch (\PDOException $e){
                $msg = 'Erro ao salvar leito';
            }
            $total++;
        }
        return $this->render('response',['msg'=>$msg,'total'=>$total]);
    }
    public function actionImportequipamentos(){
        $file = file(Yii::$app->basePath.'\web\dados\equipamentos.CSV');
        $total = 0;
        foreach ($file as $k => $v) {
            list($tipo,$equipamento,$existente,$emuso,$sus,$cnes) = explode(';', $v);
            $unidade = UnidadesSaude::find()->andWhere(['cnes'=>(int)$cnes])->one();
            $esp_equip = TipoEquipamentos::find()->andWhere(['descricao'=>(int)$equipamento])->one();

            $e = new EquipamentosUnidades();
            $e->id_tipo_eq = $esp_equip->id;
            $e->unidade = $unidade->id;
            $e->existente = $existente;
            $e->em_uso = $emuso;
            $e->sus = utf8_encode($sus);
            try {
                $e->save();
                $msg = 'Inserido com sucesso';
            }catch (\PDOException $msg){
                $msg = 'Erro ao salvar leito';
            }
            $total++;
        }
        return $this->render('response',['msg'=>$msg,'total'=>$total]);
    }
}