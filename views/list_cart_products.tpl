{include file="header.tpl"}
<div class="container " style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    {if isset($total_price)}
        <div style="padding-left: 20px;">Total: <span id="total_price">{$total_price}</span> lv.</div>
        <form method="POST" style="padding-left: 20px;">
            <input type="submit" name="buy_products" value="Buy" class="btn btn-default">
        </form>
        {if !isset($smarty.session['promocode']) && !isset($smarty.session['c_promocode'])}
            <div id="promocode_no">
                <p style="padding-left: 20px;">You have discount promocode?</p>
                <div class="form-group" style="width: 42%;padding: 5px">
                    <div class="col-lg-10">
                        <div class="input-group">
                            <input type="text" name="promocode" id="promocode" class="form-control"
                                   style="width: 265px;">
                            <span class="input-group-btn">
                <a onclick="updatePrice()" class="btn btn-default">Use promocode</a>
    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="promocode_yes" style="display:none;padding-left: 20px; ">Promocode used.</div>
        {else}
            <div id="promocode_yes" style="padding-left: 20px;">Promocode used.</div>
        {/if}
    {/if}

    {if isset($empty)}
        <h2>{$empty}</h2>
    {else}
        <br>
        <h2 style="padding-left: 19px;">Products in your cart: {$textline1}</h2>


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
                    <div style="padding: 4px" class="text-center">
                        <select id="{$product.id}" class="quantity form-control">
                            {for $i=1 to 10}
                                <option value="{$i}" {if $i==$product.quantity}selected{/if}>{$i}</option>
                            {/for}
                        </select>
                    </div>
                    <form method="POST" style="">
                        <input type="hidden" name="discard_product" value="{$product.id}">
                        <input type="submit" value="Discard product" class="btn btn-default btn-sm">
                    </form>
                </div>
            </div>
            {if $smarty.foreach.test.index % 5 == 4 || {$all_products|@count}-1 == $smarty.foreach.test.index}
                </div>
            {/if}
        {/foreach}
        <div id="pagination_controls">{$pagination_ctrls}</div>
    {/if}
</div>
<script src="http://ivan.urandeals.eu/someFunctions.js"></script>

