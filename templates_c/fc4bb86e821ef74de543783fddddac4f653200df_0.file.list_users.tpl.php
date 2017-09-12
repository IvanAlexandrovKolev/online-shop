<?php
/* Smarty version 3.1.30, created on 2017-03-20 12:31:01
  from "C:\xampp\htdocs\Register\views\list_users.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58cfbd75df3882_30657136',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc4bb86e821ef74de543783fddddac4f653200df' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\list_users.tpl',
      1 => 1490009458,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58cfbd75df3882_30657136 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <form id="search" action="users" method="get">
        <div class="form-group" style="width: 42%;padding: 5px">
            <div class="col-lg-10">
                <div class="input-group">
            <span class="input-group-btn">
 <select class="form-control" id="select" name="search_by" style="width: 130px" required>
     <option value="">Search by</option>
                <option <?php if (isset($_smarty_tpl->tpl_vars['search_by']->value) && $_smarty_tpl->tpl_vars['search_by']->value == 'username') {?>selected <?php }?>
                        value="username">Username</option>
            <option <?php if (isset($_smarty_tpl->tpl_vars['search_by']->value) && $_smarty_tpl->tpl_vars['search_by']->value == 'email') {?>selected <?php }?> value="email">Email</option>
            </select>
         </span>
                    <input type="text" class="form-control" style="width: 200px;"
                           name="search_text" <?php if (isset($_smarty_tpl->tpl_vars['search_text']->value)) {?> value="<?php echo $_smarty_tpl->tpl_vars['search_text']->value;?>
" <?php }?> required>
                    <span class="input-group-btn">
      <input class="btn btn-default" type="submit" value="Search">
    </span>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
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
    <br>
    <div style="padding: 20px;">
        <?php if (isset($_smarty_tpl->tpl_vars['msg']->value)) {?>
            <div><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
        <?php } else { ?>
            <h2><?php echo $_smarty_tpl->tpl_vars['textline1']->value;?>
</h2>
            <div style="width: 60%;">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                        <?php if ($_SESSION['username'] !== $_smarty_tpl->tpl_vars['user']->value['username'] && $_smarty_tpl->tpl_vars['user']->value['deleted'] != 1 && $_smarty_tpl->tpl_vars['user']->value['activated'] == 1) {?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['username']);?>
</td>
                                <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['email']);?>
</td>
                                <td>
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="delete_user" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['token'];?>
">
                                        <input type="submit" value="Delete" class="btn btn-default btn-sm">
                                    </form>
                                    <form method="GET" style="display: inline-block;" >
                                        <input type="hidden" name="edit_user" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['token'];?>
">
                                        <input type="submit" value="Edit" class="btn btn-default btn-sm">
                                    </form>
                                    <?php if ($_smarty_tpl->tpl_vars['user']->value['admin'] == 0) {?>
                                        <form method="POST" style="display: inline-block;">
                                            <input type="hidden" name="make_admin" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['token'];?>
">
                                            <input type="submit" value="Make admin" class="btn btn-default btn-sm">
                                        </form>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['admin'] == 1) {?>
                                        <form method="POST" style="display: inline-block;">
                                            <input type="hidden" name="make_user" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['token'];?>
">
                                            <input type="submit" value="Make user" class="btn btn-default btn-sm">
                                        </form>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </tbody>
                </table>
            </div>
            <div id="pagination_controls"><?php echo $_smarty_tpl->tpl_vars['pagination_ctrls']->value;?>
</div>
        <?php }?>
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
>


<?php }
}
