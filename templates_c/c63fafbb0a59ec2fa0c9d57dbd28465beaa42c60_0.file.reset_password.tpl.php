<?php
/* Smarty version 3.1.30, created on 2017-02-14 15:35:43
  from "C:\xampp\htdocs\Register\views\reset_password_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a315bfc31d49_21561643',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c63fafbb0a59ec2fa0c9d57dbd28465beaa42c60' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\reset_password_form.tpl',
      1 => 1487082917,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58a315bfc31d49_21561643 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal" action="reset_password.php" id="login_form" method="POST" >
            <?php if (isset($_smarty_tpl->tpl_vars['token']->value)) {?>
                <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
            <?php }?>
            <fieldset>
                <legend>Reset password</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Enter your new password here" name="pass"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Repeat password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Repeat your new password here" name="conf_pass"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;">Reset password
                        </button>
                    </div>
                </div>
                <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
                    <div style="color: red"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
                <?php }?>
            </fieldset>
        </form>
    </div>
</div>

<?php }
}
