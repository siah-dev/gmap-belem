<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Leitos por Regional';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
  	<div class="row table-responsive">
		<?php foreach($leitos as $l): ?>
        <h2><?= $l['regional'];?></h1>
        <?php break; ?>
        <?php endforeach;?>
        <table class='table table-hover small table-striped table-bordered'>
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
                                $totalExistentes += $l['leito'];
                                $totalSus += $l['leito_SUS'];
                                $totalNSus += $l['leito']-$l['leito_SUS'];
                            ?>
                        <tr>
                            <th><?= $l['descricao']?></th>
                            <td><?= $l['leito'];?></td>
                            <td><?= $l['leito_SUS']; ?></td>
                            <td><?= $l['leito']-$l['leito_SUS']; ?></td>        
                        </tr>
                        <?php endforeach; ?>
                        
                        <th>Total:</th>
                            <td><?= $totalExistentes; ?></td>
                            <td><?= $totalSus; ?></td>
                            <td><?= $totalNSus; ?></td>
                        </tr>
                      </tbody>
                    </table>
      </div>
</div>