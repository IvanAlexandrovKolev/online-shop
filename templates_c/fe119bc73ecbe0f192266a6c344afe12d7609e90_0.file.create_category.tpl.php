<?php
/* Smarty version 3.1.30, created on 2017-02-10 12:41:05
  from "C:\xampp\htdocs\Register\views\list_categories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_589da6d1de81d3_29584553',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe119bc73ecbe0f192266a6c344afe12d7609e90' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\list_categories.tpl',
      1 => 1486726865,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_589da6d1de81d3_29584553 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;">
<?php if (isset($_smarty_tpl->tpl_vars['edit_category']->value) || isset($_smarty_tpl->tpl_vars['edit_subcategory']->value) || isset($_smarty_tpl->tpl_vars['create']->value)) {?>
    <div style="padding-left: 16px;">
        <form method="POST">
            <?php echo $_smarty_tpl->tpl_vars['info_msg']->value;?>

            <input type="text" name="sub_category" <?php if (isset($_smarty_tpl->tpl_vars['edit_category']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['edit_category']->value;?>
" <?php } elseif (isset($_smarty_tpl->tpl_vars['edit_subcategory']->value)) {?> value="<?php echo $_smarty_tpl->tpl_vars['edit_subcategory']->value;?>
"<?php }?>>
            <?php if (isset($_smarty_tpl->tpl_vars['edit_subcategory']->value) || isset($_smarty_tpl->tpl_vars['create']->value)) {?>
                for
                <?php if (isset($_smarty_tpl->tpl_vars['edit_subcategory']->value)) {?>
                    <?php echo $_smarty_tpl->tpl_vars['edit_subcategory_for']->value;?>

                    <?php } else { ?>
                    <select id="categories" name="for_category">
                        <option value="none">Select category</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['category'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </select>
                <?php }?>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['edit_category']->value) || isset($_smarty_tpl->tpl_vars['edit_subcategory']->value)) {?>
                <input type="submit" value="Edit">
            <?php } else { ?>
                <input type="submit" value="Create">
            <?php }?>
        </form>
    </div>
<?php }
if (!isset($_smarty_tpl->tpl_vars['edit_category']->value) && !isset($_smarty_tpl->tpl_vars['edit_subcategory']->value) && !isset($_smarty_tpl->tpl_vars['create']->value)) {?>
<div style="padding-left: 30px;">
    <form method="get" action="categories.php">
        <button type="submit" value="create" name="action" class="btn btn-default">Create new category/subcategory</button>
    </form>
    <b>Existing categories:</b>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_categories']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
        <div class="row " style="background-color: grey; padding: 2px; margin-bottom: 10px; width: 400px">
            <div class="col-md-6" style="width: 100px">
                <span class="text-left"><?php echo $_smarty_tpl->tpl_vars['row']->value['category'];?>
</span>
            </div>
            <div class="col-md-6 text-right" style="float: right">
                <form method="GET" action="categories.php" style="display: inline;">
                    <input type="hidden" name="categ_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
">
                    <input type="submit" class="btn btn-default btn-sm" value="Edit">
                </form>
                <form method="POST" style="display: inline">
                    <input type="hidden" name="delete_cat" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
">
                    <input type="submit" id="del-btn" class="btn btn-default btn-sm del-btn" value="Delete">
                </form>
            </div>
        </div>
        <div style="padding-left: 50px">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_subcategories']->value, 'row_inner');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row_inner']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['row_inner']->value['category_id'] == $_smarty_tpl->tpl_vars['row']->value['id']) {?>
                    <div class="row "
                         style="background-color: lightgrey; padding: 2px; margin-bottom: 10px; width: 350px;">
                        <div class="col-md-2" style="width: 100px">
                            <span class="text-left">&#9632;</span>
                        </div>
                        <div class="col-md-5" style="width: 100px">
                            <span><?php echo $_smarty_tpl->tpl_vars['row_inner']->value['subcategory'];?>
</span>
                        </div>
                        <div class="col-md-5 text-right" style="float: right">
                            <form method="GET" action="categories.php" style="display: inline;">
                                <input type="hidden" name="subcateg_id" value="<?php echo $_smarty_tpl->tpl_vars['row_inner']->value['id'];?>
">
                                <input type="submit"  class="btn btn-default btn-sm" value="Edit">
                            </form>
                            <form method="POST" style="display: inline">
                                <input type="hidden" name="delete_subcat" value="<?php echo $_smarty_tpl->tpl_vars['row_inner']->value['id'];?>
">
                                <input type="submit" class="btn btn-default btn-sm del-btn" value="Delete">
                            </form>
                        </div>
                    </div>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</div>
<?php }?>
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

<?php echo '<script'; ?>
>
    $(function () {
        $('.del-btn').on('click', function () {
            var r = confirm("Are you sure you want to delete this?");
            if (r == false) {
                return false;
            }
        });
    });


<?php echo '</script'; ?>
>




<?php }
}
