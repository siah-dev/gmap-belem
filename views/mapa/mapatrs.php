<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Sistema de Mapas - TRS';
?>

<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <?php $link = "<a href='#' class='btn btn-lg btn-primary margin-top btn_mFiltros'>Iniciar Mapa</a>"; ?>
    <?php echo Html::tag('div', $link, ['id' => 'mapa']); ?>
    <div class="loading-progress"></div>
    <!-- Modal HTML -->
    <div id="modalFiltros" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Regiões</h4>
                </div>
                <div class="modal-body">
                    <form id="formReg" method="post">
                        <smal>Selecione a regional:</smal>
                        <div class="row">
                            <div class="form-group">
                                <div class="searchable-container">
                                    <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                                        <div class="info-block block-info clearfix">
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default" onclick='marcardesmarcar()'>
                                                    <div class="bizcontent">
                                                        <input type="checkbox" autocomplete="off">
                                                        <small><p style="max-height:30px;white-space: pre-wrap;word-wrap: break-word;">TODOS</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    foreach($regSaude as $value): ?>
                                        <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                                            <div class="info-block block-info clearfix">
                                                <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                    <label class="btn btn-default marcar">
                                                        <div class="bizcontent">
                                                            <input type="checkbox" class="marcar" name="crr[]" id="crs" autocomplete="off" value="<?= $value->id; ?>">
                                                            <small><p style="max-height:30px;white-space: pre-wrap;word-wrap: break-word;"><?= $value->regionais; ?></small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                    <button type="button" id="initMapa" value="crr" data-on-done="simpleDoneTrs" data-dismiss="modal" data-form-id="formReg" role="dialog" class="btn btn_mFiltros btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modalLeitos" id="modalLeitos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalhes</h4>
            </div>
            <div class="modal-body modalLeitosBody">
                ...
            </div>
            <div class="modal-footer cnes-modal">
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs("
$(document).ready(function(){
	$('.btn_mFiltros').click(function(){
		$('#modalFiltros').modal('show');
	});
});
$(function() {
    $('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });
});
", \yii\web\View::POS_READY);
$this->registerCss(".bs-example{
							margin: 20px;
					}
					.searchable-container{margin:20px 0 0 0}
					.searchable-container label.btn-default.active{background-color:#007ba7;color:#FFF}
					.searchable-container label.btn-default{width:90%;border:1px solid #efefef;margin:5px; box-shadow:5px 8px 8px 0 #ccc;}
					.searchable-container label .bizcontent{width:100%;}
					.searchable-container .btn-group{width:90%}
					.searchable-container .btn span.glyphicon{
						opacity: 0;
					}
					.searchable-container .btn.active span.glyphicon {
						opacity: 1;
					}
						");
//SOLICITACAO AJAX DEPOIS DA SELECAO DE REGIONAL
$this->registerJs("$('#initMapa').click(handleAjaxLinkTrs);", \yii\web\View::POS_READY);
?>
<!-- Maps API Javascript -->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBC52jiaTp1RQFL6c1reMZdEPtQde9ZSC0"></script>