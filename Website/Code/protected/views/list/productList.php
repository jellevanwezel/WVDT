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

$fPrice = 0;
$fTotalPrice = 0;
$iTotalAmount = 0;

?>
<table class="table table-striped">
    
    <thead>
        <tr>
        
            <th>Productnaam</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th>Totaal prijs</th>
            <th></th>
            
        </tr>
        
    </thead>
<?php

foreach ($products as $productUser) {
    echo CHtml::openTag('tbody');
        echo CHtml::openTag('tr');
            echo CHtml::openTag('td');
             echo $productUser->product->name;
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td');
                echo "&euro; " . number_format($productUser->product->price, 2, '.', '');
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td');//'style' => 'margin-right: 5px; width: 80px;', 
                echo CHtml::openTag('select', array('class' => 'productAmount form-control', 'id' => "product_amount_" . $productUser->id));
                    echo getSelectBox($productUser->amount);
                echo CHtml::closeTag('select');
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td');
                echo "&euro; " . number_format($productUser->product->price * $productUser->amount, 2, '.', '');
            echo CHtml::closeTag('td');
            echo CHtml::openTag('td'); 
                echo CHtml::tag('button', array('class' => 'btn btn-default removeProduct pull-right', 'id' => "remove_product_" . $productUser->id), "Verwijder");
            echo CHtml::closeTag('td');
        echo CHtml::closeTag('tr');
    echo CHtml::closeTag('tbody');

    $fPrice += $productUser->product->price;
    $fTotalPrice += $productUser->product->price * $productUser->amount;
    $iTotalAmount += $productUser->amount;
}

?>
    
    <tfoot>
        <tr>
        
            <td class=""><strong>Totaal</strong></td>
            <td><strong>&euro; <?=number_format($fPrice, 2, '.', '')?></strong></td>
            <td><strong><?=$iTotalAmount?></strong></td>
            <td><strong>&euro; <?=number_format($fTotalPrice, 2, '.', '')?></strong></td>
            <td></td>
            
        </tr>
        
    </tfoot>
    
</table>