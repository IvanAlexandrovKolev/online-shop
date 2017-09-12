{include file="header.tpl"}
<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <form id="search" method="GET" action="products">
        <div class="form-group" style="width: 51%;padding: 3px">
            <div class="col-lg-10">
                <div class="input-group">
                <span class="input-group-btn">
                <select class="form-control" id="categories_search" name="category" style="width: 150px">
                    <option value="all">All categories</option>
                    {foreach from=$all_categories_subcategories key=id item= row}
                        <option value="{$id}"
                                {if isset($category_id) && $category_id==$id}selected{/if}>{$row.category_name}</option>
                    {/foreach}
                </select>
                </span>
                    <span class="input-group-btn">
                <select class="form-control" name="subcategory" id="subcategories_search"
                        style="width: 190px;{if !isset($category_id)}display: none;{/if}">
                    <option value="none">Select subcategory</option>
                    {foreach from=$subcategories key=id item=subcategory}
                        <option value="{$id}"
                                {if isset($subcategory_id) && $subcategory_id==$id}selected{/if}>{$subcategories[$id]}</option>
                    {/foreach}
                </select>
                </span>
                    <input type="text" class="form-control" style="width: 300px"
                           name="search_text" {if isset($search_text)} value="{$search_text}" {/if}>
                    <span class="input-group-btn">
      <input class="btn btn-default" type="submit" value="Search">
    </span>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    <br>
    {if isset($msg)}
        <div>{$msg}</div>
    {else}
        <div style="padding-left: 15px">
            <h2>Products <b>{$textline1}</b></h2>
        </div>
    {/if}
    {foreach name = test from=$all_products item=product}
        {if $smarty.foreach.test.index % 5 == 0}
            <div class="row" style="padding-left: 27px">
        {/if}
        <div class="col-md-1 text-center" style="width: 130px;padding: 5px">
            <div style="background-color: lightgrey;width: 120px;margin:  auto;padding: 5px">
                <a href="http://ivan.urandeals.eu/products?prod_id={$product.id}">
                    <img src="http://localhost/Register/images/products/{$product.image_name}">
                </a>
                <p><b>{$product.name|truncate:16}</b></p>
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
        {if $smarty.foreach.test.index % 5 == 4 || {$all_products|@count}-1 == $smarty.foreach.test.index}
            </div>
        {/if}
    {/foreach}
    <div id="pagination_controls">{$pagination_ctrls}</div>
</div>

<script src="http://ivan.urandeals.eu/someFunctions.js"></script>
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




