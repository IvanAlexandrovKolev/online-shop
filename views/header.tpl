<link rel="stylesheet" href="libs/bootstrap.css">
<link rel="stylesheet" href="libs/bootstrap-theme.css">
<link rel="stylesheet" href="style.css">
<div  style="width: 100%;height: 43px;background-color: #222222">
    <div class="container">
        {if isset($smarty.session['username'])}
            <div class="btn-group btn-group-justified" style="width: 100%">
                {if $smarty.session['admin'] == 1}
                    <a href="/categories" class="btn btn-default">Categories</a>
                    <a href="/create_product" class="btn btn-default">Create new product</a>
                    <a href="/promocodes" class="btn btn-default">Promocodes</a>
                    <a href="/products" class="btn btn-default">Products</a>
                    <a href="/orders" class="btn btn-default">Orders</a>
                    <a href="/users" class="btn btn-default">Users</a>
                    <a href="/logout" class="btn btn-default">Logout</a>
                    <a href="/pilates" class="btn btn-default">Pilates</a>
                {else}
                    <a href="/products" class="btn btn-default">Products</a>
                    <a href="/orders" class="btn btn-default">Your orders</a>
                    <a href="/cart " class="btn btn-default">Cart</a>
                    <a href="/logout" class="btn btn-default">Logout</a>
                    <a href="/pilates" class="btn btn-default">Pilates</a>
                {/if}
            </div>
        {else}
            <div class="btn-group btn-group-justified">
                <a href="/login" class="btn btn-default">Login</a>
                <a href="/register" class="btn btn-default">Register</a>
                <a href="/products" class="btn btn-default">List products</a>
                <a href="/cart" class="btn btn-default">Cart</a>
                <a href="/pilates" class="btn btn-default">Pilates</a>
            </div>
        {/if}
    </div>
</div>
{if isset($er_message)}
    <div id="errorBox" style="display: none">{$er_message}</div>
{/if}
{if isset($message)}
    <div id="infoBox" style="display: none">{$message}</div>
{/if}
<script
        src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous"></script>
<script src="libs/bootstrap.js"></script>
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
