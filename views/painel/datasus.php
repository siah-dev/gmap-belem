<?php
use yii\helpers\ArrayHelper;
use app\models\UnidadesSaude;
?>

<?php
$JS = <<<JS
$('.s_DATASUS').on('click',function(e){
    e.preventDefault;
    var u = $('#unidade').val();
    $.ajax({
       method: 'POST',
       data: {id:u}
    }).success(function(data){
       $(".extractdatasus").html(data);
    }).error(function() {
      console.log("ERRO CHAMADA AJAX");
    })
})
JS;
$this->registerJs($JS,\yii\web\View::POS_END);
?>

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Informe a Unidade</div>
                <div class="panel-body">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="unidade">Unidade:</label>
                                <?= \yii\helpers\Html::dropDownList('id',null,ArrayHelper::map(UnidadesSaude::find()->all(),'id','nome_hospital'),['id'=>'unidade']) ?>
                            </div>
                            <button type="submit" class="btn btn-primary s_DATASUS">Buscar</button>
                            <button type="reset" class="btn btn-default">Limpar</button>
                </div>
            </div>
        </div><!-- /.col-->



            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6 extractdatasus">

                        </div>
                    </div>
                </div><!-- /.col-->


        </div><!-- /.row -->