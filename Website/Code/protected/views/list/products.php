<?php
/* @var $products Product[] */
foreach($products as $product){
    echo CHtml::openTag('div',array('class'=>'well'));
    echo CHtml::openTag('div');
    echo $product->name;
    echo CHtml::tag('button',array('class'=>'btn btn-default addProduct pull-right','id'=>"add_product_".$product->id),"Voeg Toe");
    echo CHtml::closeTag('div');
    echo CHtml::closeTag('div');
}
?>


