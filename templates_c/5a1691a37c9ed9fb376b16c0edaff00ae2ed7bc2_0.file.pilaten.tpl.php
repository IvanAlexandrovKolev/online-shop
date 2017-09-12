<?php
/* Smarty version 3.1.30, created on 2017-04-11 14:18:53
  from "/home/ivanurandeals/public_html/views/pilaten.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58ece5cd3846b8_49110487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a1691a37c9ed9fb376b16c0edaff00ae2ed7bc2' => 
    array (
      0 => '/home/ivanurandeals/public_html/views/pilaten.tpl',
      1 => 1491920222,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58ece5cd3846b8_49110487 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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

<div class="form" id="order">
    <div class="divide"></div>
    <div class="what-text white-text align-center">
        <span>Поръчайте тук:</span>
    </div>

    <form action="" method="post" class="f-padding">
        <input type="hidden" value="1" name="save">
        <div class="col-md-12">
            <label for="a1">Име и Фамилия</label>
            <input type="text" id="a1" name="name" <?php if (isset($_smarty_tpl->tpl_vars['data']->value["name"])) {?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value["name"];?>
"<?php }?>>
        </div>
        <div class="col-md-12">
            <label for="a2">Телефон</label>
            <input type="text" id="a2" name="mobile" <?php if (isset($_smarty_tpl->tpl_vars['data']->value["mobile"])) {?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value["mobile"];?>
"<?php }?>>
        </div>

        <div class="col-md-12">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" <?php if (isset($_smarty_tpl->tpl_vars['data']->value["email"])) {?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value["email"];?>
"<?php }?>>
        </div>

        <div class="col-md-12 no-padding">
            <input type="radio" id="1" name="quantity" value="1" class="checkbox checkbox-custom" checked="checked">
            <label for="1" class="checkbox-label checkbox-custom-label">1 БРОЙ маска за лице ( <strong>1.99 лв.</strong> )</label>
        </div>

        <div class="col-md-12 no-padding">
            <input type="radio" id="2" name="quantity" value="5" class="checkbox checkbox-custom">
            <label for="2" class="checkbox-label checkbox-custom-label">5 БРОЯ маска за лице ( <strong>8.99 лв.</strong> )</label>
        </div>

        <div class="col-md-12 no-padding">
            <input type="radio" id="3" name="quantity" value="10" class="checkbox checkbox-custom">
            <label for="3" class="checkbox-label checkbox-custom-label">10 БРОЯ маска за лице ( <strong>16.99 лв.</strong> )</label>
        </div>
        <div class="col-md-12 no-padding">
            <input type="radio" id="4" name="quantity" value="15" class="checkbox checkbox-custom">
            <label for="4" class="checkbox-label checkbox-custom-label">60 гр. Тубичка маска за лице ( <strong>39.99 лв.</strong> )</label>
        </div>
        <div class="col-md-12">
            <div class="divider"></div>
            <div class="center-o">
                <input type="submit" value="boton" class="order-button2">
            </div>
        </div>
    </form>
</div><?php }
}
