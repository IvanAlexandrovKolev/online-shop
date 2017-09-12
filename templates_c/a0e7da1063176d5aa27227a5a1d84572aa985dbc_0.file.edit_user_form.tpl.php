<?php
/* Smarty version 3.1.30, created on 2017-03-15 14:48:22
  from "C:\xampp\htdocs\Register\views\edit_user_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c94626e647e1_06897358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0e7da1063176d5aa27227a5a1d84572aa985dbc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\edit_user_form.tpl',
      1 => 1489585700,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58c94626e647e1_06897358 (Smarty_Internal_Template $_smarty_tpl) {
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
    <form class="form-horizontal" enctype="multipart/form-data" id="edit_form" method="POST">
        <div style="width: 60%;padding-left: 5%">
            <fieldset>
                <legend>Edit user ID: <?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Name" name="username"
                               <?php if (isset($_smarty_tpl->tpl_vars['user']->value['username'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
" <?php }?> >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Password" name="password">
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
