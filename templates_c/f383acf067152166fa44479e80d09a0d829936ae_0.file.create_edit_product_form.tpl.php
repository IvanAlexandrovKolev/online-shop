<?php
/* Smarty version 3.1.30, created on 2017-03-31 11:52:55
  from "/home/ivanurandeals/public_html/views/create_edit_product_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58de4317e21eb9_26866071',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f383acf067152166fa44479e80d09a0d829936ae' => 
    array (
      0 => '/home/ivanurandeals/public_html/views/create_edit_product_form.tpl',
      1 => 1490950558,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58de4317e21eb9_26866071 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">

    <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
        <div style="color: red">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['error']->value, 'er');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['er']->value) {
?>
                <?php echo $_smarty_tpl->tpl_vars['er']->value;?>

                <br>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
    <?php }?>
    <div style="width: 60%;padding-left: 5%">
        <form class="form-horizontal" enctype="multipart/form-data" id="create_prod_form" method="POST">
            <?php if (isset($_smarty_tpl->tpl_vars['product']->value['big_image_name'])) {?>
                <input type="hidden" name="big_image_name" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['big_image_name'];?>
">
            <?php }?>
            <fieldset>
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['id'])) {?>
                    <legend>Edit product ID: <?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
</legend>
                    <input type="hidden" name="prod_id" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                <?php } else { ?>
                    <legend>Create</legend>
                <?php }?>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Name</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Name" name="name"
                               <?php if (isset($_smarty_tpl->tpl_vars['product']->value['name'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
" <?php }?> required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea" name="description" placeholder="Description"
                                      required><?php if (isset($_smarty_tpl->tpl_vars['product']->value['description'])) {
echo $_smarty_tpl->tpl_vars['product']->value['description'];
}?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Price</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Price" name="price"
                               <?php if (isset($_smarty_tpl->tpl_vars['product']->value['price'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
" <?php }?> required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Quantity</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Quantity"
                               name="quantity" <?php if (isset($_smarty_tpl->tpl_vars['product']->value['quantity'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
" <?php }?> required>
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
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_categories']->value, 'row', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"
                                        <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['category_id']) && $_smarty_tpl->tpl_vars['product']->value['category_id'] == $_smarty_tpl->tpl_vars['id']->value)) {?>selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subcategories" class="col-lg-2 control-label">Subcategory</label>
                    <div class="col-lg-10">
                        <select id="subcategories" class="form-control" name="subcategory">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subcategories']->value, 'subcategory', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['subcategory']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"
                                        <?php if (isset($_smarty_tpl->tpl_vars['product']->value['subcategory_id']) && $_smarty_tpl->tpl_vars['product']->value['subcategory_id'] == $_smarty_tpl->tpl_vars['id']->value) {?>selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['subcategory']->value;?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </select>
                    </div>
                </div>
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['id'])) {?>
                    <div class="form-group" name="image_name">
                        <label class="col-lg-2 control-label">Current picture</label>
                        <div class="col-lg-10">
                            <img src="http://localhost/Register/images/products/<?php echo $_smarty_tpl->tpl_vars['product']->value['image_name'];?>
">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-default" name="edit_product">Edit</button>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-default" name="create_product">Create</button>
                        </div>
                    </div>
                <?php }?>
            </fieldset>
        </form>
    </div>
</div>
<?php echo '<script'; ?>
>
    $('#errorBox').show();
    setTimeout(function () {
        $('#errorBox').fadeOut();
    }, 3000);
    $('#infoBox').show();
    setTimeout(function () {
        $('#infoBox').fadeOut();
    }, 3000);
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="http://localhost/Register/someFunctions.js"><?php echo '</script'; ?>
>



<?php }
}
