<?php
/* @var $this ListController */
/* @var $list ProductUser[] */
$this->pageTitle = Yii::app()->name . ' - Boodschappenlijst';
?>
<h1><?= $this->pageTitle ?></h1>
<hr/>

<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Voeg product toe
</button>
<button type="button" class="btn btn-primary" id="emptyProductList">Lijst leegmaken</button>
<a href="<?= $this->createAbsoluteUrl('site/logout') ?>" class="btn btn-primary pull-right">Uitloggen</a>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Voeg product toe</h4>
            </div>
            <div class="modal-body" id="model-content">
                <div class="form-group">
                    <input class="form-control" placeholder="Zoek product" type="text" id="search_product" />
                </div>
                <hr/>
                <div class="alert alert-success fade in" id="alert" style="display: none;">
                    <button type="button" id="alertClose" class="close" aria-hidden="true">&times;</button>
                    Product toegevoegd!
                </div>
                <div id="products">
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div style="margin-top: 5px;" id="product_list">
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

        $("#emptyProductList").click(function() {
            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxRemoveAllProducts'); ?>"
            })
                    .done(function(msg) {
                refreshProductList();
            });
        });

        $(window).resize(function() {
            $(".overlay").each(function() {
                $(this).css({
                    left: $(this).parent().offset().left,
                    top: $(this).parent().offset().top,
                    width: $(this).parent().outerWidth(),
                    height: $(this).parent().outerHeight()
                }
                );
            })
            $(".overlay > img").each(function() {
                $(this).css({
                    top: ($(this).parent().parent().height() / 2),
                    left: ($(this).parent().parent().width() / 2)

                }
                );
            })

        });

        $('#alertClose').click(function() {
            $('#alert').fadeOut();
        });

        $('#search_product').keyup(function() {

            if ($(this).val().length == 0) {
                $("#products").html("");
                return;
            }
            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxGetProducts'); ?>",
                data: {name: $(this).val()},
                onSend: $("#products").html('<div class="row text-center"><img src="<?php echo Yii::app()->request->baseUrl; ?>/style/img/pac-man.gif" /></div>'),
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
            $('#alert').fadeOut();
            $.ajax({
                type: "GET",
                url: "<?php echo $this->createAbsoluteUrl('/list/AjaxAddProduct'); ?>",
                data: {id: id, amount: $('#add_product_amount_' + id).val()},
                onSend: initOverlay("#products", 1080),
            })
                    .done(function(msg) {
                refreshProductList();
                unsetOverlay("#products");
                $("#alert").fadeIn();
            });


        });
    }

    function refreshProductList() {
        $.ajax({
            type: "GET",
            url: "<?php echo $this->createAbsoluteUrl('/list/AjaxGetProductList'); ?>",
            onSend: initOverlay("#product_list", 10),
        })
                .done(function(msg) {
            $("#product_list").html(msg);
            setRemoveEvents();
            setChangeEvents();
            unsetOverlay("#product_list");
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

    function initOverlay(overlayedId, zindex) {
        var overlayedDiv = $(overlayedId);
        $(overlayedId + " > .overlay").css({
            zindex: zindex,
            opacity: 0.6,
            left: overlayedDiv.position().left,
            top: overlayedDiv.position().top,
            width: overlayedDiv.outerWidth(),
            height: overlayedDiv.outerHeight(),
        });
        $(overlayedId + " > .overlay > img").css({
            top: (overlayedDiv.height() / 2),
            left: (overlayedDiv.width() / 2)
        });
        $(overlayedId + " > .overlay").fadeIn('fast');
    }

    function unsetOverlay(overlayedId) {
        $(overlayedId + " > .overlay").fadeOut('fast');
    }

</script>
