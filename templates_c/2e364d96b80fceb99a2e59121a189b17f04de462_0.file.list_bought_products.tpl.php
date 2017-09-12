<?php
/* Smarty version 3.1.30, created on 2017-02-23 10:40:37
  from "C:\xampp\htdocs\Register\views\list_orders.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58aeae154caae0_35189773',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2e364d96b80fceb99a2e59121a189b17f04de462' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\list_orders.tpl',
      1 => 1487842836,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58aeae154caae0_35189773 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {?>
    <form id="search" action="orders.php" method="get">
        <div class="form-group" style="width: 42%;padding: 5px">
            <div class="col-lg-10">
                <div class="input-group">
                    <span class="input-group-btn">
                    <select name="search_by" class="form-control" style="width: 150px" required>
                        <option value="">Search by</option>
                        <option <?php if (isset($_smarty_tpl->tpl_vars['search_by']->value) && $_smarty_tpl->tpl_vars['search_by']->value == 'username') {?>selected <?php }?> value="username">
                            Username
                        </option>
                        <option <?php if (isset($_smarty_tpl->tpl_vars['search_by']->value) && $_smarty_tpl->tpl_vars['search_by']->value == 'order_id') {?>selected <?php }?> value="order_id">Orded
                            Id
                        </option>
                    </select>
                    </span>
                    <input type="text" class="form-control" style="width: 200px;" name="search_text" <?php if (isset($_smarty_tpl->tpl_vars['search_text']->value)) {?> value="<?php echo $_smarty_tpl->tpl_vars['search_text']->value;?>
" <?php }?>
                           required>
                    <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Search">
                    </span>
                </div>
            </div>
        </div>
    </form>
<?php }?>
    <br>
    <br>
    <?php if (isset($_smarty_tpl->tpl_vars['len_error']->value)) {?>
        <div style="padding-left: 20px;color: red"><?php echo $_smarty_tpl->tpl_vars['len_error']->value;?>
</div>
    <?php }?>
<br>
<?php if (isset($_smarty_tpl->tpl_vars['empty']->value)) {?>
    <h2><?php echo $_smarty_tpl->tpl_vars['empty']->value;?>
</h2>
<?php } else { ?>
    <h2 style="padding-left: 15px"><?php echo $_smarty_tpl->tpl_vars['textline1']->value;?>
</h2>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
        <div style="padding-left: 17px">
            <div style="padding-left: 10px; background-color: lightgrey; width: 100%">
                <p style="display: inline-block;"><b>Order ID:</b> <?php echo $_smarty_tpl->tpl_vars['group']->value[0]['order_token'];?>
</p>
                <p style="display: inline-block;"><b>Username:</b><?php echo $_smarty_tpl->tpl_vars['group']->value[0]['username'];?>
</p>
                <p style="display: inline-block;"><b>Date:</b> <?php echo date("y.m.d",$_smarty_tpl->tpl_vars['group']->value[0]['date']);?>
</p>
                <p style="display: inline-block;"><b>Total:</b> <?php echo $_smarty_tpl->tpl_vars['group']->value[sizeof($_smarty_tpl->tpl_vars['group']->value)-1];?>
 lv.</p>
            </div>
        </div>
        <div class="row" style="padding-left: 27px">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['group']->value, 'product', false, NULL, 'i', array (
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['index']++;
?>
                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_i']->value['index'] : null) != sizeof($_smarty_tpl->tpl_vars['group']->value)-1) {?>
                    <div class="col-md-1 text-center" style="width: 130px;padding: 5px">
                        <div style="background-color: lightgrey;width: 120px;margin:  auto;padding: 5px">
                            <a href="http://localhost/Register/show_detailed_product.php?prod_id=<?php echo $_smarty_tpl->tpl_vars['product']->value['product_id'];?>
">
                                <img src="http://localhost/Register/images/products/<?php echo $_smarty_tpl->tpl_vars['product']->value['image_name'];?>
">
                            </a>
                            <p><b><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name']);?>
</b></p>
                            <p><b>Quantity bought:</b><?php echo $_smarty_tpl->tpl_vars['product']->value['quantity'];?>
</p>
                        </div>
                    </div>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <div id="pagination_controls" style="padding-left: 15px"
    "><?php echo $_smarty_tpl->tpl_vars['pagination_ctrls']->value;?>
</div>
<?php }?>
</div>
<?php echo '<script'; ?>
 src="http://localhost/Register/update_quantity.js"><?php echo '</script'; ?>
>


<?php }
}
