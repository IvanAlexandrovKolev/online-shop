<?php
/* Smarty version 3.1.30, created on 2017-02-02 15:14:52
  from "C:\xampp\htdocs\Register\views\edit_product_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58933edcc3a5f6_63912812',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7daccbea649cc96073dd553b819dd8ce6413cc53' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\edit_product_form.tpl',
      1 => 1486044892,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58933edcc3a5f6_63912812 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
    <div style="color: red"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
<?php }?>
<form enctype="multipart/form-data" id="edit_product_form" action="edit_product.php" method="post">
    <div>Product ID: <?php echo $_smarty_tpl->tpl_vars['prod_id']->value;?>
</div>
    <input type="hidden" name="prod_id" value="<?php echo $_smarty_tpl->tpl_vars['prod_id']->value;?>
">
    <input type="hidden" name="image_name" value="<?php echo $_smarty_tpl->tpl_vars['image_name']->value;?>
">
    <?php if (isset($_smarty_tpl->tpl_vars['big_image_name']->value)) {?>
        <input type="hidden" name="big_image_name" value="<?php echo $_smarty_tpl->tpl_vars['image_name']->value;?>
">
    <?php }?>
    <br>
    <div>Name</div>
    <input type="text" name="name" <?php if (isset($_smarty_tpl->tpl_vars['name']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['name']->value;
}?>">
    <div>Description</div>
    <input type="text" name="description" <?php if (isset($_smarty_tpl->tpl_vars['description']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
"<?php }?>>
    <div>Quantity</div>
    <input type="text" name="quantity" <?php if (isset($_smarty_tpl->tpl_vars['quantity']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
 <?php }?>">
    <div>Price</div>
    <input type="text" name="price" <?php if (isset($_smarty_tpl->tpl_vars['price']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['price']->value;
}?>">
    <div>Picture</div>
    <input type="file" size="32" name="new_image_field" value="12">
    <p>Current picture:</p>
    <img src="http://localhost/Register/images/products/<?php echo $_smarty_tpl->tpl_vars['image_name']->value;?>
">
    <div><input type="submit" value="Edit"></div>
</form><?php }
}
