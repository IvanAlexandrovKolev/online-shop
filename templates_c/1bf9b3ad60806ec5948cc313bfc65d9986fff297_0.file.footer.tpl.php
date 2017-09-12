<?php
/* Smarty version 3.1.30, created on 2017-02-07 15:54:38
  from "C:\xampp\htdocs\Register\views\footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5899dfae181593_24134246',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1bf9b3ad60806ec5948cc313bfc65d9986fff297' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\footer.tpl',
      1 => 1486479274,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5899dfae181593_24134246 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
    $('#errorBox').show();
    setTimeout(function() {
        $('#errorBox').fadeOut();
    }, 3000);
    $('#infoBox').show();
    setTimeout(function() {
        $('#infoBox').fadeOut();
    }, 3000);
<?php echo '</script'; ?>
>
<?php }
}
