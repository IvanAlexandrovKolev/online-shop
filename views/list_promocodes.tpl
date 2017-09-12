{include file="header.tpl"}
<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    {if isset($create)}
        <form method="POST" style="margin: 10px;padding-bottom: 45px">
            <span style="margin-left: 20px">If you leave the text field empty - random promocode will be generated:</span> <br>
            <div class="form-group" style="width: 51%;padding: 3px">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input class="form-control" type="text" name="promocode" {if isset($promocode)} value = "{$promocode}"{/if} style="width: 370px">
                        <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" value="Create">
                        </span>
                    </div>
                </div>
            </div>
        </form>
    {else}
        <form method="get" action="promocodes">
            <button type="submit" value="create" name="action" class="btn btn-default" style="margin-top: 5px">Create
                promocode
            </button>
        </form>
        <b style="margin-left: 1px">PROMOCODES:</b>
        {foreach from=$all_promocodes item=promocode}
            <div class="row " style="background-color: lightgrey; margin-left: 1px; margin-bottom: 10px; width: 400px">
                <div class="col-md-6" style="width: 100px">
                    <span class="text-left">{$promocode.promocode}</span>
                </div>
                <div class="col-md-6 text-right" style="float: right">
                    <form method="POST" style="display: inline">
                        <input type="hidden" name="delete_promo" value="{$promocode.id}">
                        <input type="submit" id="del-btn" class="btn btn-default btn-sm del-btn" value="Delete">
                    </form>
                </div>
            </div>
        {/foreach}
        <div id="pagination_controls" >{$pagination_ctrls}</div>
    {/if}
</div>

<script src="http://localhost/Register/someFunctions.js"></script>
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

