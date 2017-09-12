<?php
/* Smarty version 3.1.30, created on 2016-12-16 12:12:36
  from "C:\xampp\htdocs\Register\views\novo.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5853cc24c2f247_44723470',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7eb81efcc646ce3afcc9ae23b888e888b6ddf660' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\novo.tpl',
      1 => 1481886756,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5853cc24c2f247_44723470 (Smarty_Internal_Template $_smarty_tpl) {
ob_start();
echo $_smarty_tpl->tpl_vars['error']->value;
$_prefixVariable1=ob_get_clean();
if (isset($_prefixVariable1)) {?>
    <div style="color: red"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
<?php }
}
}
