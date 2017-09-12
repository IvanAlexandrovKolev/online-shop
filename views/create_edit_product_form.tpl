{include file="header.tpl"}

<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">

    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    <div style="width: 60%;padding-left: 5%">
        <form class="form-horizontal" enctype="multipart/form-data" id="create_prod_form" method="POST">
            {if isset($product.big_image_name)}
                <input type="hidden" name="big_image_name" value="{$product.big_image_name}">
            {/if}
            <fieldset>
                {if isset($product.id)}
                    <legend>Edit product ID: {$product.id}</legend>
                    <input type="hidden" name="prod_id" value="{$product.id}">
                {else}
                    <legend>Create</legend>
                {/if}
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Name" name="name"
                               {if isset($product.name)}value="{$product.name}" {/if} required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea" name="description" placeholder="Description"
                                      required>{if isset($product.description)}{$product.description}{/if}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Price</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Price" name="price"
                               {if isset($product.price)}value="{$product.price}" {/if} required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Quantity</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Quantity"
                               name="quantity" {if isset($product.quantity)}value="{$product.quantity}" {/if} required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Picture</label>
                    <div class="col-lg-10">
                        <input type="file" class="form-control" id="inputEmail" size="32" name="new_image_field"
                               value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="categories" class="col-lg-2 control-label">Category</label>
                    <div class="col-lg-10">
                        <select id="categories" class="form-control" name="category">
                            {foreach from=$all_categories key = id item=row}
                                <option value="{$id}"
                                        {if (isset($product.category_id) && $product.category_id == $id)
                                        }selected {/if}>{$row.category_name}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subcategories" class="col-lg-2 control-label">Subcategory</label>
                    <div class="col-lg-10">
                        <select id="subcategories" class="form-control" name="subcategory">
                            {foreach from=$subcategories key=id item=subcategory}
                                <option value="{$id}"
                                        {if isset($product.subcategory_id) && $product.subcategory_id == $id}selected {/if}>{$subcategory}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                {if isset($product.id)}
                    <div class="form-group" name="image_name">
                        <label class="col-lg-2 control-label">Current picture</label>
                        <div class="col-lg-10">
                            <img src="http://localhost/Register/images/products/{$product.image_name}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-default" name="edit_product">Edit</button>
                        </div>
                    </div>
                {else}
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-default" name="create_product">Create</button>
                        </div>
                    </div>
                {/if}
            </fieldset>
        </form>
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

<script src="http://localhost/Register/someFunctions.js"></script>



