<?php
/* @var $products Product[] */

$sSelectBox = '';
for ($i = 1; $i <= 50; $i++) {
    $sSelectBox .= CHtml::openTag('option', array('value' => $i));
    $sSelectBox .= $i;
    $sSelectBox .= CHtml::closeTag('option');
}
?>
<table class="table table-striped">

    <thead>
        <tr>

            <th>Productnaam</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th></th>

        </tr>

    </thead>
    <?php
    foreach ($products as $product) {
//    echo CHtml::openTag('div',array('class'=>'well'));
//    echo CHtml::openTag('div');
//    echo $product->name;
//    echo " &euro; ";
//    echo $product->price;
//    echo CHtml::tag('button',array('class'=>'btn btn-default addProduct pull-right','id'=>"add_product_".$product->id),"Voeg Toe");
//    echo CHtml::openTag('select',array('class' => 'pull-right', 'id' => "product_amount_" . $product->id));
//    echo $sSelectBox;
//    echo CHtml::closeTag('select');
//    echo CHtml::closeTag('div');
//    echo CHtml::closeTag('div');

        echo CHtml::openTag('tbody');
        echo CHtml::openTag('tr');
        echo CHtml::openTag('td');
        echo $product->name;
        echo CHtml::closeTag('td');
        echo CHtml::openTag('td');
        echo "&euro; " . number_format($product->price, 2, '.', '');
        echo CHtml::closeTag('td');
        echo CHtml::openTag('td'); //'style' => 'margin-right: 5px; width: 80px;', 
        echo CHtml::openTag('select', array('class' => 'productAmount form-control', 'id' => "product_amount_" . $product->id));
        echo $sSelectBox;
        echo CHtml::closeTag('select');
        echo CHtml::closeTag('td');
        echo CHtml::openTag('td');
        echo CHtml::tag('button', array('class' => 'btn btn-default addProduct pull-right', 'id' => "add_product_" . $product->id), "Voeg Toe");
        echo CHtml::closeTag('td');
        echo CHtml::closeTag('tr');
        echo CHtml::closeTag('tbody');
    }
    ?>

</table>