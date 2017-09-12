<?php
/* Smarty version 3.1.30, created on 2017-03-17 13:53:16
  from "C:\xampp\htdocs\Register\views\list_products.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58cbdc3c0de890_14795287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '613dbfebeb985543061900eb9ee6b887d0f3bc07' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\list_products.tpl',
      1 => 1489755193,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58cbdc3c0de890_14795287 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'C:\\xampp\\htdocs\\Register\\libs\\plugins\\modifier.truncate.php';
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <form id="search" method="GET" action="products">
        <div class="form-group" style="width: 51%;padding: 3px">
            <div class="col-lg-10">
                <div class="input-group">
                <span class="input-group-btn">
                <select class="form-control" id="categories_search" name="category" style="width: 150px">
                    <option value="all">All categories</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_categories_subcategories']->value, 'row', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['row']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"
                                <?php if (isset($_smarty_tpl->tpl_vars['category_id']->value) && $_smarty_tpl->tpl_vars['category_id']->value == $_smarty_tpl->tpl_vars['id']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                </span>
                    <span class="input-group-btn">
                <select class="form-control" name="subcategory" id="subcategories_search"
                        style="width: 190px;<?php if (!isset($_smarty_tpl->tpl_vars['category_id']->value)) {?>display: none;<?php }?>">
                    <option value="none">Select subcategory</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['subcategories']->value, 'subcategory', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['subcategory']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"
                                <?php if (isset($_smarty_tpl->tpl_vars['subcategory_id']->value) && $_smarty_tpl->tpl_vars['subcategory_id']->value == $_smarty_tpl->tpl_vars['id']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['subcategories']->value[$_smarty_tpl->tpl_vars['id']->value];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                </span>
                    <input type="text" class="form-control" style="width: 300px"
                           name="search_text" <?php if (isset($_smarty_tpl->tpl_vars['search_text']->value)) {?> value="<?php echo $_smarty_tpl->tpl_vars['search_text']->value;?>
" <?php }?>>
                    <span class="input-group-btn">
      <input class="btn btn-default" type="submit" value="Search">
    </span>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
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
    <br>
    <?php if (isset($_smarty_tpl->tpl_vars['msg']->value)) {?>
        <div><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
    <?php } else { ?>
        <div style="padding-left: 15px">
            <h2>Products <b><?php echo $_smarty_tpl->tpl_vars['textline1']->value;?>
</b></h2>
        </div>
    <?php }?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_products']->value, 'product', false, NULL, 'test', array (
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index']++;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index'] : null)%5 == 0) {?>
            <div class="row" style="padding-left: 27px">
        <?php }?>
        <div class="col-md-1 text-center" style="width: 130px;padding: 5px">
            <div style="background-color: lightgrey;width: 120px;margin:  auto;padding: 5px">
                <a href="http://localhost/Register/products?prod_id=<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                    <img src="http://localhost/Register/images/products/<?php echo $_smarty_tpl->tpl_vars['product']->value['image_name'];?>
">
                </a>
                <p><b><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],16);?>
</b></p>
                <p><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
 lv.</p>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity'] > 0) {?>
                    <p>Available</p>
                    <?php if ((isset($_COOKIE['token']) && (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0))) {?>
                        <div>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="add_to_cart" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                                <input type="submit" value="Add to cart" class="btn btn-default btn-sm">
                            </form>
                        </div>
                    <?php }?>
                <?php } else { ?>
                    <p>Unavailable</p>
                <?php }?>
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {?>
                    <form method="get" style="display: inline-block;" action="edit_product">
                        <input type="hidden" name="prod_id" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                        <input type="submit" value="Edit" class="btn btn-default btn-sm">
                    </form>
                    <form method="POST" style="display: inline-block;">
                        <input type="hidden" name="delete_product" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                        <input type="submit" value="Delete" class="btn btn-default btn-sm">
                    </form>
                <?php }?>
            </div>
        </div>
        <?php ob_start();
echo count($_smarty_tpl->tpl_vars['all_products']->value);
$_prefixVariable1=ob_get_clean();
if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index'] : null)%5 == 4 || $_prefixVariable1-1 == (isset($_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_test']->value['index'] : null)) {?>
            </div>
        <?php }?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <div id="pagination_controls"><?php echo $_smarty_tpl->tpl_vars['pagination_ctrls']->value;?>
</div>
</div>

<?php echo '<script'; ?>
 src="http://localhost/Register/someFunctions.js"><?php echo '</script'; ?>
>
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




<?php }
}
