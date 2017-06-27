<?php if(isset($data)): ?>
    <?php echo utf8_encode($data); ?>
<?php endif;  ?>

<?php

$JS = <<<JS
$("tr td").each(function(index,value){
    console.log(index+" : "+$(this).text());
    console.log(value);
})
$("tr").each(function(index,value){
    console.log(value.cells);
    $(value.cells).each(function(index,value){
        console.log(index+':'+value);
    });
})
JS;
$this->registerJs($JS,\yii\web\View::POS_END);
?>
