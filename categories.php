<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//GET ALL CATEGORIES AND THEIR SUBCATEGORIES
$all_categories_subcategories = get_all_categories_subcategories("");

if (isset($_POST['delete_cat']) && is_numeric($_POST['delete_cat'])) {
    $categ_id = $mysqli->real_escape_string($_POST['delete_cat']);
    if (array_key_exists($categ_id, $all_categories_subcategories)) {
        if (empty($all_categories_subcategories[$categ_id]['subcategories'])) {
            $delete_category_query = "UPDATE categories SET deleted = 1 WHERE id = {$categ_id}";
            $mysqli->query($delete_category_query);
            $message = "Category deleted successfully";
        } else {
            $er_message = "You cant delete categories with existing subcategories";
        }
    } else {
        $er_message = "Such category doesn't exist.";
    }
}
if (isset($_POST['delete_subcat']) && is_numeric($_POST['delete_subcat'])) {
    $subcateg_id = $mysqli->real_escape_string($_POST['delete_subcat']);
    $exist = check_subcategory($subcateg_id, $all_categories_subcategories);
    if ($exist) {
        $check_for_products_query = "SELECT * FROM products WHERE subcategory_id = {$subcateg_id}";
        $mysqli->query($check_for_products_query);
        if ($mysqli->affected_rows == 0) {
            $delete_subcat_query = "UPDATE subcategories SET deleted = 1 WHERE id = {$subcateg_id}";
            $mysqli->query($delete_subcat_query);
            $message = "Subcategory deleted successfully";
        } else {
            $er_message = "You can't delete this subcategory.Some products are assigned to it";
        }
    } else {
        $er_message = "Such subcategory doesn't exist.";
    }
}
if (isset($_GET['page']) && (isset($_SESSION['message']) || isset($_SESSION['er_message']))) {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['er_message'])) {
        $er_message = $_SESSION['er_message'];
        unset($_SESSION['er_message']);
    }
}
if ((isset($_GET['action']) && $_GET['action'] == "create") || isset($_GET['subcateg_id']) || isset($_GET['categ_id'])) {
    if (isset($_GET['action']) && $_GET['action'] == "create") {
        $create = true;
        $info_msg = "Create category/subcategory";
        $unassigned_message = "Category/Subcategory created successfully";

        $smarty->assign('all_categories_subcategories', $all_categories_subcategories);
        $smarty->assign("create", true);
    } else if (isset($_GET['subcateg_id']) && is_numeric($_GET['subcateg_id'])) {
        $edit_subcat_bool = true;
        $info_msg = "Edit subcategory";
        $unassigned_message = "Subcategory edited successfully";
        $subcateg_id = $mysqli->real_escape_string($_GET['subcateg_id']);
        $category_subcategory_data = check_subcategory($subcateg_id, $all_categories_subcategories);

        if ($category_subcategory_data) {
            $smarty->assign('edit_subcategory', $category_subcategory_data['subcategory_name']);
            $smarty->assign('category_id', $category_subcategory_data['category_id']);
            $smarty->assign('edit_subcategory_for', $category_subcategory_data['category_name']);
            $smarty->assign('subcategory_id', $subcateg_id);
        } else {
            $_SESSION['er_message'] = "Subcategory with such ID doesn't exist.";
        }
    } else if (isset($_GET['categ_id']) && is_numeric($_GET['categ_id'])) {
        $info_msg = "Edit category";
        $unassigned_message = "Category edited successfully";
        $edit_cat_bool = true;
        $category_id = $mysqli->real_escape_string($_GET['categ_id']);

        if (array_key_exists($category_id, $all_categories_subcategories)) {
            $category_name = $all_categories_subcategories[$category_id]["category_name"];
            $smarty->assign('edit_category', $category_name);
            $smarty->assign('category_id', $category_id);
        } else {
            $_SESSION['er_message'] = "Category with such ID doesn't exist.";
        }
    }
    $smarty->assign('info_msg', $info_msg);

    if (!isset($_SESSION['er_message']) && isset($_POST['new_category/subcategory'])) {
        $categ_subcateg_text = $mysqli->real_escape_string($_POST['new_category/subcategory']);
        $categ_subcateg_text = htmlspecialchars($categ_subcateg_text);
        $new_category_len = mb_strlen($categ_subcateg_text);
        if ($new_category_len > 0) {
            if ($new_category_len >= 2 && $new_category_len <= 32) {
                if (isset($_POST['for_category']) && $_POST['for_category'] != "none") { //CREATE EDIT SUBCATEGORY
                    $category_id = $mysqli->real_escape_string($_POST['for_category']);
                    $check_subcategory_category = check_subcategory_name_in_category($categ_subcateg_text, $category_id, $all_categories_subcategories);
                    if ($check_subcategory_category == true) {
                        if (isset($edit_subcat_bool)) {
                            $subcat_query = "UPDATE subcategories SET subcategory = '{$categ_subcateg_text}' WHERE id= {$subcateg_id}";
                            $smarty->assign('edit_subcategory', $categ_subcateg_text);
                        } else {
                            $subcat_query = "INSERT INTO subcategories(category_id,subcategory) VALUES($category_id,'{$categ_subcateg_text}')";
                        }
                        $mysqli->query($subcat_query);
                        $_SESSION["message"] = $unassigned_message;
                    } else {
                        $er_message = "Such category doesn't exist or there is such subcategory name for this category.";
                    }
                } else { //CREATE EDIT CATEGORY
                    $check_category_new_name = check_category_name($categ_subcateg_text, $all_categories_subcategories);
                    if ($check_category_new_name == true) {
                        if (isset($edit_cat_bool)) {
                            $category_query = "UPDATE categories SET category = '{$categ_subcateg_text}' WHERE id= {$category_id}";
                            $smarty->assign('edit_category', $categ_subcateg_text);
                        } else {
                            $category_query = "INSERT INTO categories(category) VALUES('{$categ_subcateg_text}')";
                        }
                        $mysqli->query($category_query);
                        $_SESSION["message"] = $unassigned_message;
                    } else {
                        $er_message = "Category with such name already exists";
                    }
                }
            } else {
                $error[] = "Category/subcategory must be between 2 and 32 characters.";
            }
        } else {
            $error[] = "All fields must be filled";
        }
    }
    if(isset($_SESSION["message"]) || isset($_SESSION["er_message"])){
        header("Location: " . SITE . "categories");
    }

} else { //if edit or create is not set
    if (isset($_GET['pn'])) {
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
        $pagenum = mysqli_real_escape_string($mysqli, $pagenum);
    } else {
        $pagenum = 1;
    }
    $get_categories_query = "SELECT * FROM categories WHERE deleted = 0 ";
    $page_rows = 5;
    $pagination_url = "categories?";
    $pagination = pagination($get_categories_query, $pagenum, $page_rows, $pagination_url);

    $paginationCtrls = $pagination['paginationCtrls'];
    $textline1 = $pagination['rows'];
    $limit = $pagination['limit'];
    $order_by = "ORDER BY id DESC";

    $all_categories_subcategories = get_all_categories_subcategories($order_by . $limit);

    $smarty->assign('all_categories_subcategories', $all_categories_subcategories);
    $smarty->assign('pagination_ctrls', $paginationCtrls);
    $smarty->assign('textline1', $textline1);
}
$display = "list_categories";






