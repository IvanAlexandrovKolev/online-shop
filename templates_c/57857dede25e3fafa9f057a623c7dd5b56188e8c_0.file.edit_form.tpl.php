<?php
/* Smarty version 3.1.30, created on 2017-03-07 11:01:34
  from "C:\xampp\htdocs\Register\views\edit_user_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58be84feb92e18_23740052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57857dede25e3fafa9f057a623c7dd5b56188e8c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\edit_user_form.tpl',
      1 => 1488880892,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58be84feb92e18_23740052 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
        <div style="color: red"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
    <?php }?>
    <form class="form-horizontal" enctype="multipart/form-data" id="edit_form" method="POST">
        <div style="width: 60%;padding-left: 5%">
            <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
">
            <fieldset>
                <legend>Edit user ID: <?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Name" name="username"
                               <?php if (isset($_smarty_tpl->tpl_vars['username']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" <?php }?> >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Price" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default">Edit</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>
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
