<?php
/* Smarty version 3.1.30, created on 2017-03-10 13:53:00
  from "C:\xampp\htdocs\Register\views\list_categories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2a1ac346850_28288379',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6cf460725876d6639fe4ebc4293535755ab649f6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Register\\views\\list_categories.tpl',
      1 => 1489149574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_58c2a1ac346850_28288379 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container" style="border:1px solid black;margin-top: 5px">
    <?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
        <div style="padding-left: 20px;color: red"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['edit_category']->value) || isset($_smarty_tpl->tpl_vars['edit_subcategory']->value) || isset($_smarty_tpl->tpl_vars['create']->value)) {?>
    <div style="padding-left: 16px;margin: 10px;padding-bottom: 4%">
        <div style="width: 250px;padding-left: 20px"><?php echo $_smarty_tpl->tpl_vars['info_msg']->value;?>
</div>
        <form method="POST">
            <div class="form-group" style="width: 51%;padding: 3px">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input class="form-control" type="text" name="new_category/subcategory"
                               <?php if (isset($_smarty_tpl->tpl_vars['edit_category']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['edit_category']->value;?>
" <?php } elseif (isset($_smarty_tpl->tpl_vars['edit_subcategory']->value)) {?>
                               value="<?php echo $_smarty_tpl->tpl_vars['edit_subcategory']->value;?>
"<?php }?> style="width: 250px">
                        <?php if (isset($_smarty_tpl->tpl_vars['edit_subcategory']->value)) {?>
                            <span class="input-group-btn">
                                    <select class="form-control" id="categories" name="for_category"
                                            style="width: 180px">
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['edit_subcategory_for']->value;?>
</option>
                                    </select>
                                    </span>
                        <?php } elseif (isset($_smarty_tpl->tpl_vars['create']->value)) {?>
                            <span class="input-group-btn">
                                    <select class="form-control" id="categories" name="for_category"
                                            style="width: 180px">
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
                                    </span>
                        <?php }?>
                        <span class="input-group-btn">
                            <?php if (isset($_smarty_tpl->tpl_vars['edit_category']->value) || isset($_smarty_tpl->tpl_vars['edit_subcategory']->value)) {?>
                                <input class="btn btn-default" type="submit" value="Edit">

                                    <?php } else { ?>

                                <input class="btn btn-default" type="submit" value="Create">
                            <?php }?>
                            </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php } else { ?>
    <div style="padding-left: 30px;">
        <form method="get" action="categories">
            <button type="submit" value="create" name="action" class="btn btn-default" style="margin-top: 5px">Create
                new category/subcategory
            </button>
        </form>
        <p>Existing categories: <b><?php echo $_smarty_tpl->tpl_vars['textline1']->value;?>
</b></p>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_categories_subcategories']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
            <div class="row " style="background-color: grey; padding: 2px; margin-bottom: 10px; width: 400px">
                <div class="col-md-6" style="width: 100px">
                    <span class="text-left"><?php echo $_smarty_tpl->tpl_vars['row']->value[0]['category'];?>
</span>
                </div>
                <div class="col-md-6 text-right" style="float: right">
                    <form method="GET" action="categories" style="display: inline;">
                        <input type="hidden" name="categ_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0]['id'];?>
">
                        <input type="submit" class="btn btn-default btn-sm" value="Edit">
                    </form>
                    <form method="POST" style="display: inline">
                        <input type="hidden" name="delete_cat" value="<?php echo $_smarty_tpl->tpl_vars['row']->value[0]['id'];?>
">
                        <input type="submit" id="del-btn" class="btn btn-default btn-sm del-btn" value="Delete">
                    </form>
                </div>
            </div>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value[1], 'inner_row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inner_row']->value) {
?>
                <div style="padding-left: 50px">
                    <div class="row "
                         style="background-color: lightgrey; padding: 2px; margin-bottom: 10px; width: 350px;">
                        <div class="col-md-2" style="width: 100px">
                            <span class="text-left">&#9632;</span>
                        </div>
                        <div class="col-md-5" style="width: 100px">
                            <span><?php echo $_smarty_tpl->tpl_vars['inner_row']->value['subcategory'];?>
</span>
                        </div>
                        <div class="col-md-5 text-right" style="float: right">
                            <form method="GET" action="categories" style="display: inline;">
                                <input type="hidden" name="subcateg_id" value="<?php echo $_smarty_tpl->tpl_vars['inner_row']->value['id'];?>
">
                                <input type="submit" class="btn btn-default btn-sm" value="Edit">
                            </form>
                            <form method="POST" style="display: inline">
                                <input type="hidden" name="delete_subcat" value="<?php echo $_smarty_tpl->tpl_vars['inner_row']->value['id'];?>
">
                                <input type="submit" class="btn btn-default btn-sm del-btn" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
    <div id="pagination_controls"
    "><?php echo $_smarty_tpl->tpl_vars['pagination_ctrls']->value;?>
</div>
    </div>
<?php }?>

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
