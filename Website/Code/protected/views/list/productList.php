<?php

/* @var $products ProductUser[] */

function getSelectBox($value) {
    $sSelectBox = '';
    for ($i = 1; $i <= 50; $i ++) {
        $sSelectBox .= CHtml::openTag('option', array('value' => $i, 'selected' => $value == $i ? 'selected' : ''));
        $sSelectBox .= $i;
        $sSelectBox .= CHtml::closeTag('option');
    }
    return $sSelectBox;
}

foreach ($products as $productUser) {
    echo CHtml::openTag('div', array('class' => 'well'));
    echo CHtml::openTag('div');
    echo $productUser->product->name;
    echo " &euro; ";
    echo $productUser->product->price;
    echo CHtml::openTag('select', array('class' => 'productAmount pull-right', 'id' => "product_amount_" . $productUser->id));
    echo getSelectBox($productUser->amount);
    echo CHtml::closeTag('select');
    echo CHtml::tag('button', array('class' => 'btn btn-default removeProduct pull-right', 'id' => "remove_product_" . $productUser->id), "Verwijder");
    echo CHtml::closeTag('div');
    echo CHtml::closeTag('div');
}
?>


