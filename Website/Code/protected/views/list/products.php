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
    <tbody>
        <?php
        foreach ($products as $product) {
            echo CHtml::openTag('tr');
            echo CHtml::openTag('td');
            echo $product->name;
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td');
            echo "&euro; " . number_format($product->price, 2, '.', '');
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td'); //'style' => 'margin-right: 5px; width: 80px;', 
            echo CHtml::openTag('select', array('class' => 'form-control', 'id' => "add_product_amount_" . $product->id));
            echo $sSelectBox;
            echo CHtml::closeTag('select');
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td');
            echo CHtml::tag('button', array('title'=>'Toevoegen','alt'=>'Toevoegen','class' => 'btn btn-default addProduct pull-right', 'id' => "add_product_" . $product->id), "<span class='glyphicon glyphicon-plus'></span>");
            echo CHtml::closeTag('td');
            echo CHtml::closeTag('tr');
        }
        ?>
    </tbody>

</table>
<div class="overlay">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/style/img/pac-man.gif" class="img-load" />
</div>
