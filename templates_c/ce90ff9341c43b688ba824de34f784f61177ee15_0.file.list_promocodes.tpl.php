<?php
/* Smarty version 3.1.30, created on 2017-03-15 15:06:09
  from "C:\xampp\htdocs\Register\views\list_promocodes.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c94a51605449_75373201',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce90ff9341c43b688ba824de34f784f61177ee15' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\list_promocodes.tpl',
      1 => 1489586763,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58c94a51605449_75373201 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
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
    <?php if (isset($_smarty_tpl->tpl_vars['create']->value)) {?>
        <form method="POST" style="margin: 10px;padding-bottom: 45px">
            <span style="margin-left: 20px">If you leave the text field empty - random promocode will be generated:</span> <br>
            <div class="form-group" style="width: 51%;padding: 3px">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input class="form-control" type="text" name="promocode" <?php if (isset($_smarty_tpl->tpl_vars['promocode']->value)) {?> value = "<?php echo $_smarty_tpl->tpl_vars['promocode']->value;?>
"<?php }?> style="width: 370px">
                        <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" value="Create">
                        </span>
                    </div>
                </div>
            </div>
        </form>
    <?php } else { ?>
        <form method="get" action="promocodes">
            <button type="submit" value="create" name="action" class="btn btn-default" style="margin-top: 5px">Create
                promocode
            </button>
        </form>
        <b style="margin-left: 1px">PROMOCODES:</b>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_promocodes']->value, 'promocode');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['promocode']->value) {
?>
            <div class="row " style="background-color: lightgrey; margin-left: 1px; margin-bottom: 10px; width: 400px">
                <div class="col-md-6" style="width: 100px">
                    <span class="text-left"><?php echo $_smarty_tpl->tpl_vars['promocode']->value['promocode'];?>
</span>
                </div>
                <div class="col-md-6 text-right" style="float: right">
                    <form method="POST" style="display: inline">
                        <input type="hidden" name="delete_promo" value="<?php echo $_smarty_tpl->tpl_vars['promocode']->value['id'];?>
">
                        <input type="submit" id="del-btn" class="btn btn-default btn-sm del-btn" value="Delete">
                    </form>
                </div>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <div id="pagination_controls" ><?php echo $_smarty_tpl->tpl_vars['pagination_ctrls']->value;?>
</div>
    <?php }?>
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
