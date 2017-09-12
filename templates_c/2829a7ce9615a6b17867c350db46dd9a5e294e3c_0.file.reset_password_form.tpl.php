<?php
/* Smarty version 3.1.30, created on 2017-03-22 16:04:42
  from "C:\xampp\htdocs\Register\views\reset_password_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58d2928a65a2c4_58765597',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2829a7ce9615a6b17867c350db46dd9a5e294e3c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\reset_password_form.tpl',
      1 => 1490195081,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58d2928a65a2c4_58765597 (Smarty_Internal_Template $_smarty_tpl) {
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
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal"  method="POST" action="<?php echo $_smarty_tpl->tpl_vars['php_file']->value;?>
">
            <fieldset>
                <legend><?php echo $_smarty_tpl->tpl_vars['label']->value;?>
</legend>
                <?php if (isset($_SESSION['fb_username']) && isset($_SESSION['fb_email'])) {?>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <p>Username: <?php echo $_SESSION['fb_username'];?>
</p>
                            <p>Email: <?php echo $_SESSION['fb_email'];?>
</p>
                        </div>
                    </div>
                <?php }?>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail"
                               placeholder="Enter your new password here" name="pass"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Repeat password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail"
                               placeholder="Repeat your new password here" name="conf_pass"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;"><?php echo $_smarty_tpl->tpl_vars['label']->value;?>

                        </button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

<?php }
}
