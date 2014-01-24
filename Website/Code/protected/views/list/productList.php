<?php
/* @var $products ProductUser[] */

function getSelectBox($value) {
    $sSelectBox = '';
    for ($i = 1; $i <= 50; $i++) {
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
            <th style="text-align: right;">Prijs</th>
            <th style="text-align: right;">Aantal</th>
            <th style="text-align: right;">Totaal prijs</th>
            <th></th>

        </tr>

    </thead>
    <tbody>
        <?php
        if (count($products) > 0) {
            foreach ($products as $productUser) {
                echo CHtml::openTag('tr');
                echo CHtml::openTag('td');
                echo $productUser->product->name;
                echo CHtml::closeTag('td');
                echo CHtml::openTag('td', array('style' => 'text-align: right;'));
                echo "&euro; " . number_format($productUser->product->price, 2, '.', '');
                echo CHtml::closeTag('td');
                echo CHtml::openTag('td', array('style' => 'text-align: right;'));
                echo CHtml::openTag('select', array('class' => 'productAmount form-control', 'id' => "product_amount_" . $productUser->id));
                echo getSelectBox($productUser->amount);
                echo CHtml::closeTag('select');
                echo CHtml::closeTag('td');
                echo CHtml::openTag('td', array('style' => 'text-align: right;'));
                echo "&euro; " . number_format($productUser->product->price * $productUser->amount, 2, '.', '');
                echo CHtml::closeTag('td');
                echo CHtml::openTag('td');
                echo CHtml::tag('a', array('class' => 'btn removeProduct pull-right', 'id' => "remove_product_" . $productUser->id), "<span class='glyphicon glyphicon-remove'></span>");
                echo CHtml::closeTag('td');
                echo CHtml::closeTag('tr');

                $fPrice += $productUser->product->price;
                $fTotalPrice += $productUser->product->price * $productUser->amount;
                $iTotalAmount += $productUser->amount;
            }
        } else {
            echo CHtml::openTag('tr');
            echo CHtml::openTag('td', array('colspan' => '5'));
            echo 'Uw boodschappenlijst is leeg.';
            echo CHtml::closeTag('td');
            echo CHtml::closeTag('tr');
        }
        ?>
    </tbody>

    <tfoot>
        <tr>

            <td class=""><strong>Totaal</strong></td>
            <td style="text-align: right;"><strong>&euro; <?= number_format($fPrice, 2, '.', '') ?></strong></td>
            <td style="text-align: right;"><strong><?= $iTotalAmount ?></strong></td>
            <td style="text-align: right;"><strong>&euro; <?= number_format($fTotalPrice, 2, '.', '') ?></strong></td>
            <td></td>

        </tr>

    </tfoot>

</table>
<div class="overlay">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/style/img/pac-man.gif" class="img-load" />
</div>
