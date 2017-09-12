<?php
/* Smarty version 3.1.30, created on 2017-03-31 13:17:18
  from "/home/ivanurandeals/public_html/views/list_cart_products.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58de56de726203_72170529',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed6c423c4904cc1902e0f58f5ad6eaf09c6c0be9' => 
    array (
      0 => '/home/ivanurandeals/public_html/views/list_cart_products.tpl',
      1 => 1490966226,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58de56de726203_72170529 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/home/ivanurandeals/public_html/libs/plugins/modifier.truncate.php';
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container " style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <?php if (isset($_smarty_tpl->tpl_vars['total_price']->value)) {?>
        <div style="padding-left: 20px;">Total: <span id="total_price"><?php echo $_smarty_tpl->tpl_vars['total_price']->value;?>
</span> lv.</div>
        <form method="POST" style="padding-left: 20px;">
            <input type="submit" name="buy_products" value="Buy" class="btn btn-default">
        </form>
        <?php if (!isset($_SESSION['promocode']) && !isset($_SESSION['c_promocode'])) {?>
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
        <?php } else { ?>
            <div id="promocode_yes" style="padding-left: 20px;">Promocode used.</div>
        <?php }?>
    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['empty']->value)) {?>
        <h2><?php echo $_smarty_tpl->tpl_vars['empty']->value;?>
</h2>
    <?php } else { ?>
        <br>
        <h2 style="padding-left: 19px;">Products in your cart: <?php echo $_smarty_tpl->tpl_vars['textline1']->value;?>
</h2>


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
                    <a href="http://ivan.urandeals.eu/products?prod_id=<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                        <img src="http://localhost/Register/images/products/<?php echo $_smarty_tpl->tpl_vars['product']->value['image_name'];?>
">
                    </a>
                    <p><b><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],16);?>
</b></p>
                    <p><?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
 lv.</p>
                    <div style="padding: 4px" class="text-center">
                        <select id="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
" class="quantity form-control">
                            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['product']->value['quantity']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
                            <?php }
}
?>

                        </select>
                    </div>
                    <form method="POST" style="">
                        <input type="hidden" name="discard_product" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
                        <input type="submit" value="Discard product" class="btn btn-default btn-sm">
                    </form>
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
    <?php }?>
</div>
<?php echo '<script'; ?>
 src="http://ivan.urandeals.eu/someFunctions.js"><?php echo '</script'; ?>
>

<?php }
}
