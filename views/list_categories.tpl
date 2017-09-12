{include file="header.tpl"}
<div class="container" style="border:1px solid black;margin-top: 5px">
    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    {if isset($edit_category) ||  isset($edit_subcategory) || isset($create)}
    <div style="padding-left: 16px;margin: 10px;padding-bottom: 4%">
        <div style="width: 250px;padding-left: 20px">{$info_msg}</div>
        <form method="POST">
            <div class="form-group" style="width: 51%;padding: 3px">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input class="form-control" type="text" name="new_category/subcategory"
                               {if isset($edit_category)}value="{$edit_category}" {elseif isset($edit_subcategory)}
                               value="{$edit_subcategory}"{/if} style="width: 250px">
                        {if isset($edit_subcategory)}
                            <span class="input-group-btn">
                                    <select class="form-control" id="categories" name="for_category"
                                            style="width: 180px">
                                        <option value="{$category_id}">{$edit_subcategory_for}</option>
                                    </select>
                                    </span>
                        {elseif isset($create)}
                            <span class="input-group-btn">
                                    <select class="form-control" id="categories" name="for_category"
                                            style="width: 180px">
                                        <option value="none">Select category</option>
                                        {foreach from=$all_categories_subcategories key= category_id item=row}
                                            <option value="{$category_id}">{$row.category_name}</option>
                                        {/foreach}
                                    </select>
                                    </span>
                        {/if}
                        <span class="input-group-btn">
                            {if isset($edit_category) || isset($edit_subcategory)}
                                <input class="btn btn-default" type="submit" value="Edit">
                                                                        {else}
                                <input class="btn btn-default" type="submit" value="Create">
                            {/if}
                            </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {else}
    <div style="padding-left: 30px;">
        <form method="get" action="categories">
            <button type="submit" value="create" name="action" class="btn btn-default" style="margin-top: 5px">Create
                new category/subcategory
            </button>
        </form>
        <p>Existing categories: <b>{$textline1}</b></p>
        {foreach from=$all_categories_subcategories key = category_id item=row}
            <div class="row " style="background-color: grey; padding: 2px; margin-bottom: 10px; width: 400px">
                <div class="col-md-6" style="width: 100px">
                    <span class="text-left">{$row.category_name}</span>
                </div>
                <div class="col-md-6 text-right" style="float: right">
                    <form method="GET" action="categories" style="display: inline;">
                        <input type="hidden" name="categ_id" value="{$category_id}">
                        <input type="submit" class="btn btn-default btn-sm" value="Edit">
                    </form>
                    <form method="POST" style="display: inline">
                        <input type="hidden" name="delete_cat" value="{$category_id}">
                        <input type="submit" id="del-btn" class="btn btn-default btn-sm del-btn" value="Delete">
                    </form>
                </div>
            </div>
            {foreach from=$row.subcategories key= subcategory_id item=subcategory_name}
                <div style="padding-left: 50px">
                    <div class="row "
                         style="background-color: lightgrey; padding: 2px; margin-bottom: 10px; width: 350px;">
                        <div class="col-md-2" style="width: 100px">
                            <span class="text-left">&#9632;</span>
                        </div>
                        <div class="col-md-5" style="width: 100px">
                            <span>{$subcategory_name}</span>
                        </div>
                        <div class="col-md-5 text-right" style="float: right">
                            <form method="GET" action="categories" style="display: inline;">
                                <input type="hidden" name="subcateg_id" value="{$subcategory_id}">
                                <input type="submit" class="btn btn-default btn-sm" value="Edit">
                            </form>
                            <form method="POST" style="display: inline">
                                <input type="hidden" name="delete_subcat" value="{$subcategory_id}">
                                <input type="submit" class="btn btn-default btn-sm del-btn" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            {/foreach}
        {/foreach}
    </div>
    <div id="pagination_controls"
    ">{$pagination_ctrls}</div>
    </div>
{/if}

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

<script>
    $(function () {
        $('.del-btn').on('click', function () {
            var r = confirm("Are you sure you want to delete this?");
            if (r == false) {
                return false;
            }
        });
    });


</script>




