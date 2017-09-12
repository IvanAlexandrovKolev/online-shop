<?php
/* Smarty version 3.1.30, created on 2017-03-29 14:38:13
  from "C:\xampp\htdocs\Register\views\login_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58dbaab51a5c82_82359304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2aec63784f4f17840cc43bba502e3a470635ebbd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\login_form.tpl',
      1 => 1490791090,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58dbaab51a5c82_82359304 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal" id="login_form" method="POST">
            <fieldset>
                <legend>Login</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Username" name="username"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Password"
                               name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;">Login
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="/Register/forgot_password" class="btn btn-default" style="width: 100%;">Forgot
                            password?</a>
                    </div>
                </div>
                <a href="fblogin.php">Facebook Login Button</a>
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
            </fieldset>
        </form >
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
