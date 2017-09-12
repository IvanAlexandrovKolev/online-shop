{include file="header.tpl"}



    <div class="row" style="padding-left: 27px;position: absolute;
top: 10% ;
left: 35%;">
        <div class="col-md-1 text-center" style="width: 130px;padding: 5px">
            <div style="background-color: lightgrey;width: 400px;margin:  auto;padding: 5px;border: 1px solid #000;">
                <div style="padding: 20px">
                <img src="http://localhost/Register/images/products/{$product.big_image_name}" style=" border: 1px solid grey">
                <p><b>Name</b></p>
                <p>{$product.name|truncate:16}</p>
                <p><b>Description</b></p>
                <p>{$product.description}</p>
                <p><b>Price</b></p>
                <p>{$product.price} lv.</p>
                {if $product.quantity > 0}
                    <p>Available</p>
                    {if (isset($smarty.cookies['token']) && (!isset($smarty.session['admin']) || $smarty.session['admin']== 0))}
                        <div>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="add_to_cart" value="{$product.id}">
                                <input type="submit" value="Add to cart" class="btn btn-default btn-sm">
                            </form>
                        </div>
                    {/if}
                {else}
                    <p>Unavailable</p>
                {/if}
                {if isset($smarty.session['admin']) && $smarty.session['admin']== 1}
                    <form method="get" style="display: inline-block;" action="edit_product">
                        <input type="hidden" name="prod_id" value="{$product.id}">
                        <input type="submit" value="Edit" class="btn btn-default btn-sm">
                    </form>
                    <form method="POST" style="display: inline-block;">
                        <input type="hidden" name="delete_product" value="{$product.id}">
                        <input type="submit" value="Delete" class="btn btn-default btn-sm">
                    </form>
                {/if}
            </div>
            </div>
        </div>
    </div>


<script>
    $('#errorBox').show();
    setTimeout(function () {
        $('#errorBox').fadeOut();
    }, 3000);
    $('#infoBox').show();
    setTimeout(function () {
        $('#infoBox').fadeOut();
    }, 3000);
</script>