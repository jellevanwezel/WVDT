<?php
/* @var $products Product[] */

$sSelectBox = '';
for ( $i = 1; $i <= 50; $i ++ ) {
    $sSelectBox .= CHtml::openTag('option', array ( 'value' => $i));
    $sSelectBox .= $i;
    $sSelectBox .= CHtml::closeTag('option');
}

foreach($products as $product){
    echo CHtml::openTag('div',array('class'=>'well'));
    echo CHtml::openTag('div');
    echo $product->name;
    echo CHtml::tag('button',array('class'=>'btn btn-default addProduct pull-right','id'=>"add_product_".$product->id),"Voeg Toe");
    echo CHtml::openTag('select',array('class' => 'pull-right', 'id' => "product_amount_" . $product->id));
    echo $sSelectBox;
    echo CHtml::closeTag('select');
    echo CHtml::closeTag('div');
    echo CHtml::closeTag('div');
}
?>


