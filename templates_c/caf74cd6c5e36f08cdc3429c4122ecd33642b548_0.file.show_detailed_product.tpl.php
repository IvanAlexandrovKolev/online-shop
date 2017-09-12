<?php
/* Smarty version 3.1.30, created on 2017-03-20 12:22:29
  from "C:\xampp\htdocs\Register\views\show_detailed_product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58cfbb753590b1_53680779',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caf74cd6c5e36f08cdc3429c4122ecd33642b548' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\show_detailed_product.tpl',
      1 => 1490008947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58cfbb753590b1_53680779 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'C:\\xampp\\htdocs\\Register\\libs\\plugins\\modifier.truncate.php';
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>




    <div class="row" style="padding-left: 27px;position: absolute;
top: 10% ;
left: 35%;">
        <div class="col-md-1 text-center" style="width: 130px;padding: 5px">
            <div style="background-color: lightgrey;width: 400px;margin:  auto;padding: 5px;border: 1px solid #000;">
                <div style="padding: 20px">
                <img src="http://localhost/Register/images/products/<?php echo $_smarty_tpl->tpl_vars['product']->value['big_image_name'];?>
" style=" border: 1px solid grey">
                <p><b>Name</b></p>
                <p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],16);?>
</p>
                <p><b>Description</b></p>
                <p><?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>
</p>
                <p><b>Price</b></p>
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
><?php }
}
