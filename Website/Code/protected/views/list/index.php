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
<div id="product_list">
    <?php
    $this->renderPartial('productList', array(
            'products' => $list,
                )
        );
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        setRemoveEvents();
        setChangeEvents();

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
            var id = $(this).attr('id').replace('add_product_', '');

            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxAddProduct'); ?>",
                data: {id: id, amount: $('#product_amount_' + id).val()}
            })
                    .done(function(msg) {
                        refreshProductList();
                    });
        });
    }

    function refreshProductList() {
        $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxGetProductList'); ?>"
            })
                .done(function(msg) {
                    $("#product_list").html(msg);
                    setRemoveEvents();
                    setChangeEvents();
                });
    }

    function setChangeEvents() {

        $(".productAmount").change(function() {
            var id = $(this).attr('id').replace('product_amount_', '');

            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxChangeProductAmount'); ?>",
                data: {id: id, amount: $('#product_amount_' + id).val()}
            })
                    .done(function(msg) {
                        refreshProductList();
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
                        refreshProductList();
                    });
        });
    }

</script>
