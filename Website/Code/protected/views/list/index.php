<?php
/* @var $this ListController */
/* @var $list ProductUser[] */
?>
<h1>Product listje</h1>
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Voeg product toe!
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Voeg product toe</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="search_product" />
                <div id="products">
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div>
    <?php
    foreach ($list as $product) {
        echo CHtml::openTag('div', array('class' => 'well'));
        echo CHtml::openTag('div');
        echo $product->product->name;
        echo " ";
        echo $product->product->price;
        echo CHtml::tag('button', array('class' => 'btn btn-default removeProduct pull-right', 'id' => "remove_product_" . $product->id), "Verwijder");
        echo CHtml::closeTag('div');
        echo CHtml::closeTag('div');
    }
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
        setRemoveEvents();
    
        $('#search_product').keyup(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxGetProducts'); ?>",
                data: {name: $(this).val()}
            })
                    .done(function(msg) {
                $("#products").html(msg);
                setAddEvents();
            });
        });
    });

    function setAddEvents() {
        $(".addProduct").click(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxAddProduct'); ?>",
                data: {id: $(this).attr('id').replace('add_product_', ''), amount: 1}
            })
                    .done(function(msg) {
                $("#products").html(msg);
            });
        });
    }

    function setRemoveEvents() {
        $(".removeProduct").click(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxRemoveProduct'); ?>",
                data: {id: $(this).attr('id').replace('remove_product_', '')}
            })
                    .done(function(msg) {
                $("#products").html(msg);
            });
        });
    }

</script>
