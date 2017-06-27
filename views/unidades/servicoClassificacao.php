<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Sistema de Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
  	<div class="row table-responsive">
		<?php foreach($serv_classificacao as $s): ?>
        <h2><?= $s['hospital'];?><small><?= $s['regional'];?></small></h2>
        <h3><small><?= $s['desc_servico'];?></small></h3>
        <?php break; ?>
        <?php endforeach;?>
        <table class='table table-bordered table-hover small table-striped'>
              <caption>
              </caption>
              <thead>
                <tr>
                    <th>CLASSIFICAÇÃO</th>
                    <th>TERCEIRO</th>
                    <th>CNES RECEBEDOR</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $totalExistentes = 0;
                $totalEmUso = 0;
              ?>
              <?php foreach($serv_classificacao as $s): ?>
                <tr>
                    <th><?= $s['descricao'];?></th>
                    <td><?= $s['terceiro'];?></td>
                    <td><?= $s['cnes_recebedor']; ?></td> 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
      </div>
</div>