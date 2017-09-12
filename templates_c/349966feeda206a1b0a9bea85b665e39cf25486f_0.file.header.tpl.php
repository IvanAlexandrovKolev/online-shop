<?php
/* Smarty version 3.1.30, created on 2017-02-28 16:36:18
  from "C:\xampp\htdocs\Register\views\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b598f212a3d8_16053129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '349966feeda206a1b0a9bea85b665e39cf25486f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\header.tpl',
      1 => 1488296177,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58b598f212a3d8_16053129 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link rel="stylesheet" href="libs/bootstrap.css">
<link rel="stylesheet" href="libs/bootstrap-theme.css">
<link rel="stylesheet" href="style.css">
<div  style="width: 100%;height: 43px;background-color: #222222">
    <div class="container">
        <?php if (isset($_SESSION['username'])) {?>
            <div class="btn-group btn-group-justified" style="width: 100%">
                <?php if ($_SESSION['admin'] == 1) {?>
                    <a href="/Register/categories" class="btn btn-default">Categories</a>
                    <a href="/Register/create_product" class="btn btn-default">Create new product</a>
                    <a href="/Register/promocodes" class="btn btn-default">Promocodes</a>
                    <a href="/Register/products" class="btn btn-default">Products</a>
                    <a href="/Register/orders" class="btn btn-default">Orders</a>
                    <a href="/Register/users" class="btn btn-default">Users</a>
                    <a href="/Register/logout" class="btn btn-default">Logout</a>
                <?php } else { ?>
                    <a href="/Register/products" class="btn btn-default">Products</a>
                    <a href="/Register/orders" class="btn btn-default">Your orders</a>
                    <a href="/Register/cart " class="btn btn-default">Cart</a>
                    <a href="/Register/logout" class="btn btn-default">Logout</a>
                <?php }?>
            </div>
        <?php } else { ?>
            <div class="btn-group btn-group-justified">
                <a href="/Register/login" class="btn btn-default">Login</a>
                <a href="/Register/register" class="btn btn-default">Register</a>
                <a href="/Register/products" class="btn btn-default">List products</a>
                <a href="/Register/cart" class="btn btn-default">Cart</a>
            </div>
        <?php }?>
    </div>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['er_message']->value)) {?>
    <div id="errorBox" style="display: none"><?php echo $_smarty_tpl->tpl_vars['er_message']->value;?>
</div>
<?php }
if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
    <div id="infoBox" style="display: none"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<?php }
echo '<script'; ?>

        src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="libs/bootstrap.js"><?php echo '</script'; ?>
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
