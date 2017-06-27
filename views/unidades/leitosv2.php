<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\components\Legendas;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php 
$totalSus = null;
$totalNSus = null;
$totalExist = null;
?>
<div class='table-responsive'>
	<h4><?php echo $unidade->nome_hospital; ?></h4>
    <div role='tabpanel'>
    <!-- Nav tabs -->
      <ul class='nav nav-tabs' id='myTab' role='tablist'>
        <li role='presentation' class='active'><a href='#leitos' aria-controls='leitos' role='tab' data-toggle='tab'>Leitos</a></li>
        <li role='presentation'><a href='#leitosComp' aria-controls='leitosComp' role='tab' data-toggle='tab'>Leitos Complementares</a></li>
        <li role='presentation'><a href='#equip' aria-controls='equip' role='tab' data-toggle='tab'>Equipamentos</a></li>
          <li role='presentation'><a href='#servicos' aria-controls='servicos' role='tab' data-toggle='tab'>Serviços</a></li>
          <li role='presentation'><a href='#cidades' aria-controls='cidades' role='tab' data-toggle='tab'>Cidades atendidas</a></li>
      </ul>
      	<!-- Tab panes -->
       	<div class='tab-content'>    
        	<div role='tabpanel' class='tab-pane active' id='leitos'>
                <?php if(count($leitos)>0): ?>
        	<table class='table table-bordered table-hover small table-striped'>
              <caption>
              </caption>
              <thead>
                <tr>
                    <th>LEITOS</th>
                    <th>EXISTENTES</th>
                    <th>HABILITADO</th>
                    <th>NÃO HABILITADO</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $totalExistentes = 0;
                $totalSus = 0;
                $totalNSus = 0;
              ?>
              <?php foreach($leitos as $l): ?>
                    <?php
                        $totalExistentes += $l['leitos'];
                        $totalSus += $l['leitos_SUS'];
                        $totalNSus += $l['leitos']-$l['leitos_SUS'];
                    ?>
                <tr>
                    <th><?= "<a href='../unidades/leitodetalhe?unidade=".$l['id_unidade']."&especialidade=".$l['codigo']."' class='leitosViewQtip' target='_blank'>".$l['descricao']."</a>";?></th>
                    <td><?= $l['leitos'];?></td>
                    <td><?= $l['leitos_SUS']; ?></td>
                    <td><?= $l['leitos']-$l['leitos_SUS']; ?></td>        
                </tr>
                <?php endforeach; ?>
                
                <th>Total:</th>
                    <td><?= $totalExistentes; ?></td>
                    <td><?= $totalSus; ?></td>
                    <td><?= $totalNSus; ?></td>
                </tr>
              </tbody>
            </table>
            <?php else: ?>
                    <h4><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Unidade não possui leitos cadastrados!</h4>
            <?php endif ?>
            </div>
        <div role='tabpanel' class='tab-pane' id='leitosComp'>
            <?php if(count($leitosComplementares)>0): ?>
        	<table class='table table-bordered table-hover small table-striped'>
              <caption>
              </caption>
              <thead>
                <tr>
                    <th>LEITOS</th>
                    <th>EXISTENTES</th>
                    <th>HABILITADO</th>
                    <th>NÃO HABILITADO</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $totalExistentes = 0;
                $totalSus = 0;
                $totalNSus = 0;
              ?>
              <?php foreach($leitosComplementares as $l): ?>
                    <?php
                        $totalExistentes += $l->LT_qnt;
                        $totalSus += $l->LT_qnt_sus;
                        $totalNSus += $l->LT_qnt-$l->LT_qnt_sus;
                    ?>
                <tr>
                    <th><?= $l->leitoTipo->descricao;?></th>
                    <td><?= $l->LT_qnt;?></td>
                    <td><?= $l->LT_qnt_sus; ?></td>
                    <td><?= $l->LT_qnt-$l->LT_qnt_sus; ?></td>        
                </tr>
                <?php endforeach; ?>
                
                <th>Total:</th>
                    <td><?= $totalExistentes; ?></td>
                    <td><?= $totalSus; ?></td>
                    <td><?= $totalNSus; ?></td>
                </tr>
              </tbody>
            </table>
            <?php else: ?>
                <h4><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Unidade não possui leitos complementares cadastrados!</h4>
            <?php endif ?>
        </div>
        
        <div role='tabpanel' class='tab-pane' id='equip'>
            <?php if(count($equipamentos)>0): ?>
         	<table class='table table-bordered table-hover small table-striped'>
              <caption>
              </caption>
              <thead>
                <tr>
                    <th>EQUIPAMENTOS</th>
                    <th>EXISTENTES</th>
                    <th>EM USO</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $totalExistentes = 0;
                $totalEmUso = 0;
              ?>
              <?php foreach($equipamentos as $e): ?>
                    <?php
                        $totalExistentes += $e['existente'];
                        $totalEmUso += $e['em_uso'];
                    ?>
                <tr>
                    <th><?= "<a href='../unidades/equipamentodetalhe?unidade=".$e['unidade']."&especialidade=".$e['codigo']."' class='leitosViewQtip' target='_blank'>".$e['descricao']."</a>";?></th>
                    <td><?= $e['existente'];?></td>
                    <td><?= $e['em_uso']; ?></td>      
                </tr>
                <?php endforeach; ?>
                
                <th>Total:</th>
                    <td><?= $totalExistentes; ?></td>
                    <td><?= $totalEmUso; ?></td>
                </tr>
              </tbody>
            </table>
            <?php else: ?>
                <h4><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Unidade não possui equipamentos cadastrados!</h4>
            <?php endif ?>
        </div>
        <div role='tabpanel' class='tab-pane' id='servicos'>
            <?php if(count($servicos)>0): ?>
        <table class='table table-bordered table-hover small table-striped'>
              <caption>
              </caption>
              <thead>
                <tr>
                    <th>SERVIÇOS</th>
                    <th>TIPO</th>
                    <th>AMB. SUS</th>
                    <th>AMB. NÃO SUS</th>
                    <th>HOSP. SUS</th>
                    <th>HOSP. NÃO SUS</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($servicos as $s): ?>
                <tr>
                    <th><a href=<?= '../unidades/servicoclassificacao?unidade='.$s['id_unid'].'&id_serv='.$s['id_serv'].'' ?> target="_blank"><?= $s['descricao'];?></a></th>
                    <td><?= $s['caracteristica'];?></td>
                    <td><?= $s['amb_sus']; ?></td>
                    <td><?= $s['amb_n_sus']; ?></td>
                    <td><?= $s['hospitalar_sus']; ?></td>
                    <td><?= $s['hospitalar_n_sus']; ?></td>      
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php else: ?>
                <h4><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Unidade não possui serviços cadastrados!</h4>
            <?php endif ?>
        </div>
            <div role='tabpanel' class='tab-pane' id='cidades'>
                <?php if(count($cidades)>0): ?>
                <table class='table table-bordered table-hover small table-striped'>
                    <caption>
                    </caption>
                    <thead>
                    <tr>
                        <th>Cidades</th>
                        <th>População</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($cidades as $c): ?>
                        <tr>
                            <td><?= $c['nome'];?></td>
                            <td><?= number_format($c['populacao'], null, null, '.');?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <h4><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Unidade não possui cidades atendidas cadastrados!</h4>
                <?php endif ?>
            </div>

      </div>
      </div>
      
</div>