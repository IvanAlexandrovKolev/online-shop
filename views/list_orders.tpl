{include file="header.tpl"}
<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
{if isset($smarty.session['admin']) && $smarty.session['admin']== 1}
    <form id="search" action="orders.php" method="get">
        <div class="form-group" style="width: 42%;padding: 5px">
            <div class="col-lg-10">
                <div class="input-group">
                    <span class="input-group-btn">
                    <select name="search_by" class="form-control" style="width: 150px" required>
                        <option value="">Search by</option>
                        <option {if isset($search_by) && $search_by == 'username'}selected {/if} value="username">
                            Username
                        </option>
                        <option {if isset($search_by) && $search_by == 'order_id'}selected {/if} value="order_id">Orded
                            Id
                        </option>
                    </select>
                    </span>
                    <input type="text" class="form-control" style="width: 200px;" name="search_text" {if isset($search_text)} value="{$search_text}" {/if}
                           required>
                    <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Search">
                    </span>
                </div>
            </div>
        </div>
    </form>
{/if}
    <br>
    <br>
<br>
{if isset($empty)}
    <h2>{$empty}</h2>
{else}
    <h2 style="padding-left: 15px">Orders <b>{$textline1}</b></h2>
    {foreach from=$all_groups item=group}
        <div style="padding-left: 17px">
            <div style="padding-left: 10px; background-color: lightgrey; width: 100%">
                <p style="display: inline-block;"><b>Order ID:</b> {$group[0].order_token}</p>
                <p style="display: inline-block;"><b>Username:</b>{$group[0].username}</p>
                <p style="display: inline-block;"><b>Date:</b> {date("y.m.d", $group[0].date)}</p>
                <p style="display: inline-block;"><b>Total:</b> {$group[sizeof($group)-1]} lv.</p>
            </div>
        </div>
        <div class="row" style="padding-left: 27px">
            {foreach from=$group item=product name=i}
                {if $smarty.foreach.i.index != sizeof($group)-1}
                    <div class="col-md-1 text-center" style="width: 130px;padding: 5px">
                        <div style="background-color: lightgrey;width: 120px;margin:  auto;padding: 5px">
                            <a href="http://localhost/Register/products?prod_id={$product.product_id}">
                                <img src="http://localhost/Register/images/products/{$product.image_name}">
                            </a>
                            <p><b>{htmlspecialchars($product.name)}</b></p>
                            <p><b>Quantity bought:</b>{$product.quantity}</p>
                        </div>
                    </div>
                {/if}
            {/foreach}
        </div>
    {/foreach}
    <div id="pagination_controls" style="padding-left: 15px"
    ">{$pagination_ctrls}</div>
{/if}
</div>
<script src="http://localhost/Register/update_quantity.js"></script>


