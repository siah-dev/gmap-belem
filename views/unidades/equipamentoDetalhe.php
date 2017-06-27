<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Sistema de Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
  	<div class="row table-responsive">
		<?php foreach($equipamentos as $e): ?>
        <h2><?= $e['hospital'];?><small><?= $e['regional'];?></small></h2>
        <h3><small><?= $e['esp_descricao'];?></small></h3>
        <?php break; ?>
        <?php endforeach;?>
        <table class='table table-bordered table-hover small table-striped'>
              <caption>
              </caption>
              <thead>
                <tr>
                    <th>EQUIPAMENTO</th>
                    <th>EXISTENTES</th>
                    <th>EM USO</th>
                    <th>SUS</th>
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
                    <th><?= $e['descricao'];?></th>
                    <td><?= $e['existente'];?></td>
                    <td><?= $e['em_uso']; ?></td>  
                    <td><?= $e['sus']; ?></td>  
                </tr>
                <?php endforeach; ?>
                
                <th>Total:</th>
                    <td><?= $totalExistentes; ?></td>
                    <td><?= $totalEmUso; ?></td>
                    <td></td>
                </tr>
              </tbody>
            </table>
      </div>
</div>