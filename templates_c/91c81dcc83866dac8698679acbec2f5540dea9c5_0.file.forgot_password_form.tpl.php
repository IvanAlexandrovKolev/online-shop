<?php
/* Smarty version 3.1.30, created on 2017-04-04 10:56:54
  from "/home/ivanurandeals/public_html/views/forgot_password_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58e37bf614a7e1_27881407',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91c81dcc83866dac8698679acbec2f5540dea9c5' => 
    array (
      0 => '/home/ivanurandeals/public_html/views/forgot_password_form.tpl',
      1 => 1490950559,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58e37bf614a7e1_27881407 (Smarty_Internal_Template $_smarty_tpl) {
?>


<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal" action="reset_password"  method="POST" >
            <fieldset>
                <legend>Forgot password</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your username here" name="username"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your email address here" name="email"
                               required <?php if (isset($_SESSION['email'])) {?>value="<?php echo $_SESSION['email'];?>
"<?php }?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;">Send
                        </button>
                    </div>
                </div>
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
><?php }
}
