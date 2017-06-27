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
$totalSus;
$totalNSus;
$totalExist;
if(count($leitos)>0){ ?>
<div class='table-responsive'>
<table class='table table-bordered table-hover small table-striped'>
  <caption><h4><?php foreach($leitos as $l){echo $l->idUnidadeSaude->nome_hospital;} ?><hr /><a class='btn btn-primary btn-xs' title='<?php foreach($leitos as $l){echo $l->idUnidadeSaude->nome_hospital;} ?>' href='<?= $url; ?>' target='_blank'>CNES</a></h4></caption>
  <thead>
  	<tr>
    	<th>LEITOS</th>
        <th>EXISTENTES</th>
    	<th>NÃO SUS</th>
    	<th>SUS</th>
    </tr>
  </thead>
  <tbody>
  	<tr>
    	<th>Cirurgico</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_cirurgico;?></td>
        <td><?= $l->lt_cirurgico-$l->SUS_lt_cirurgico; ?></td>
        <td><?= $l->SUS_lt_cirurgico; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Clínico</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_clinico;?></td>
        <td><?= $l->lt_clinico-$l->SUS_lt_clinico; ?></td>
        <td><?= $l->SUS_lt_clinico; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UCI Neo Canguru</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uci_neo_canguru; ?></td>
        <td><?= $l->lt_uci_neo_canguru-$l->SUS_lt_uci_neo_canguru; ?></td>
        <td><?= $l->SUS_lt_uci_neo_canguru; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Isolamento</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_isolamento; ?></td>
        <td><?= $l->lt_isolamento-$l->SUS_lt_isolamento; ?></td>
        <td><?= $l->SUS_lt_isolamento; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Pediatrica I</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_pediatrico_I; ?></td>
        <td><?= $l->lt_uti_pediatrico_I-$l->SUS_lt_uti_pediatrico_I; ?></td>
        <td><?= $l->SUS_lt_uti_pediatrico_I; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Pediatrica II</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_pediatrico_II; ?></td>
        <td><?= $l->lt_uti_pediatrico_II-$l->SUS_lt_uti_pediatrico_II; ?></td>
        <td><?= $l->SUS_lt_uti_pediatrico_II; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Coronariana</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_coronariana; ?></td>
        <td><?= $l->lt_uti_coronariana-$l->SUS_lt_uti_coronariana; ?></td>
        <td><?= $l->SUS_lt_uti_coronariana; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Neo</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_neo; ?></td>
        <td><?= $l->lt_uti_neo-$l->SUS_lt_uti_neo; ?></td>
        <td><?= $l->SUS_lt_uti_neo; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Neo II</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_neo_II; ?></td>
        <td><?= $l->lt_uti_neo_II-$l->SUS_lt_uti_neo_II; ?></td>
        <td><?= $l->SUS_lt_uti_neo_II; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UCI Neo Convencional</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uci_neo_convencional; ?></td>
        <td><?= $l->lt_uci_neo_convencional-$l->SUS_lt_uci_neo_convencional; ?></td>
        <td><?= $l->SUS_lt_uci_neo_convencional; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Unid. Interm. Neo</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_unid_interm_neo; ?></td>
        <td><?= $l->lt_unid_interm_neo-$l->SUS_lt_unid_interm_neo; ?></td>
        <td><?= $l->SUS_lt_unid_interm_neo; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Adulto II</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_adulto_II; ?></td>
        <td><?= $l->lt_uti_adulto_II-$l->SUS_lt_uti_adulto_II; ?></td>
        <td><?= $l->SUS_lt_uti_adulto_II; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Adulto III</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_adulto_III; ?></td>
        <td><?= $l->lt_uti_adulto_III-$l->SUS_lt_uti_adulto_III; ?></td>
        <td><?= $l->SUS_lt_uti_adulto_III; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>UTI Queimados</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_uti_queimados; ?></td>
        <td><?= $l->lt_uti_queimados-$l->SUS_lt_uti_queimados; ?></td>
        <td><?= $l->SUS_lt_uti_queimados; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Obstetrico</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_obstetrico; ?></td>
        <td><?= $l->lt_obstetrico-$l->SUS_lt_obstetrico; ?></td>
        <td><?= $l->SUS_lt_obstetrico; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Pediatrico</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_pediatrico; ?></td>
        <td><?= $l->lt_pediatrico-$l->SUS_lt_pediatrico; ?></td>
        <td><?= $l->SUS_lt_pediatrico; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Psiquiatria</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_psiquiatria; ?></td>
        <td><?= $l->lt_psiquiatria-$l->SUS_lt_psiquiatria; ?></td>
        <td><?= $l->SUS_lt_psiquiatria; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>HOSP. DIA</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_hosp_dia; ?></td>
        <td><?= $l->lt_hosp_dia-$l->SUS_lt_hosp_dia; ?></td>
        <td><?= $l->SUS_lt_hosp_dia; ?></td>
        <?php endforeach; ?>
  	</tr>
    <tr>
    	<th>Total:</th>
        <?php foreach($leitos as $l): ?>
        <td><?= $l->lt_hosp_dia; ?></td>
        <td><?= $l->lt_hosp_dia-$l->SUS_lt_hosp_dia; ?></td>
        <td><?= $l->SUS_lt_hosp_dia; ?></td>
        <?php endforeach; ?>
  	</tr>
  </tbody>
</table>
</div>
<?php }else{ ?>
	<h2><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Unidade não possui leitos cadastrados!</h2>
<?php } ?>
