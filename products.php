<?php
if(!defined("SHOP")){
    header("Location: logout");
}

if (isset($_POST['delete_product']) && is_numeric($_POST['delete_product'])) {
    $product_id = $mysqli->real_escape_string($_POST['delete_product']);
    $soft_delete_product_query = "UPDATE `products` SET `deleted`= 1 WHERE `id`={$product_id}";
    $delete = $mysqli->query($soft_delete_product_query);
    if ($mysqli->affected_rows == 1) {
        $message = "Product deleted successfully";
    } else {
        $er_message = "Such product doesn't exist.";
    }
}
if (isset($_POST['add_to_cart']) && is_numeric($_POST['add_to_cart'])) {
    $product_id = $mysqli->real_escape_string($_POST['add_to_cart']);
    $quantity = 1;
    $check_prod_query = "SELECT * FROM products WHERE id = {$product_id}";
    $mysqli->query($check_prod_query);
    if ($mysqli->affected_rows == 1) {
        $check_in_cart_sql = "SELECT * FROM cart_products WHERE product_id = {$product_id}";
        if (isset($_SESSION['username'])) {
            $token = $_SESSION['token'];
            $check_in_cart_sql .= " AND token = '{$token}'";
            $type = "token";
        } else {
            $token = $_COOKIE['token'];
            $check_in_cart_sql .= " AND cookie_token = '{$token}'";
            $type = "cookie_token";
        }
        $insert = "INSERT INTO cart_products ($type,product_id,quantity) 
                       VALUES('{$token}',{$product_id},{$quantity})";
        $check_in_cart = $mysqli->query($check_in_cart_sql);
        $cart_row = $check_in_cart->fetch_assoc();
        if (!empty($cart_row)) {
            $upd_quan = $cart_row['quantity'] + $quantity;
            $row_id = $cart_row['id'];
            $update_table = "UPDATE cart_products SET quantity= {$upd_quan} WHERE `id`={$row_id}";
            $update = $mysqli->query($update_table);
        } else {
            $statement = $mysqli->query($insert);
        }
        $message = "Product added to cart";
    } else {
        $er_message = "Such product doesn't exist.";
    }
}
if (isset($_GET['prod_id']) && is_numeric($_GET['prod_id'])) {
    $product_id = $mysqli->real_escape_string($_GET['prod_id']);
    $statement = $mysqli->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = $statement->fetch_assoc();
    if (!empty($product)) {
        $smarty->assign("product", $product);
        $display = "show_detailed_product";
    } else {
        $_SESSION["er_message"] = "Such product doesn't exist.";
        header("Location: " . SITE . "products");
    }
} else {
    //GET ALL CATEGORIES
    $all_categories_subcategories = get_all_categories_subcategories("");

    $sql_products_query = "SELECT products.id,name,description,quantity,price,image_name,deleted,big_image_name
                           FROM products WHERE deleted = 0 ";
    $pagination_url = "";
    $error = [];
    if (isset($_GET['category']) && $_GET['category'] != "all") {
        if (array_key_exists($_GET['category'], $all_categories_subcategories)) {

            $category_id = $mysqli->real_escape_string($_GET['category']);

            $category_search = " AND category_id = {$category_id} ";
            $sql_products_query .= $category_search;
            $pagination_url .= "category={$category_id}";

            //GET ALL SUBCATEGORIES FOR CHOSEN CATEGORY
            $subcategories = $all_categories_subcategories[$category_id]["subcategories"];

            if (isset($_GET['subcategory']) && $_GET['subcategory'] != "none") {
                if (array_key_exists($_GET['subcategory'], $subcategories)) {
                    $subcategory_id = $mysqli->real_escape_string($_GET['subcategory']);

                    $subcategory_search = " AND subcategory_id = {$subcategory_id} ";
                    $sql_products_query .= $subcategory_search;
                    $pagination_url .= "&subcategory={$subcategory_id}";
                } else {
                    $error[] = "Invalid subcategory";
                }
            }
        } else {
            $error[] = "Invalid category";
        }
    }
    if (isset($_GET["search_text"])) {
        $search_text = htmlspecialchars($_GET["search_text"]);
        $search_text = $mysqli->real_escape_string($search_text);
        $search_text_len = mb_strlen($search_text);
        if ($search_text_len > 0) {
            if ($search_text_len >= 3 && $search_text_len <= 64) {
                $text_search = "AND products.name LIKE '%{$search_text}%'";
                $sql_products_query .= $text_search;
                $pagination_url .= "&search_text={$search_text}";
            } else if ($search_text_len < 3) {
                $error[] = "Search text must be atleast 3 characters and could be max 64 characters long.";
            }
        }
    }
    if (isset($_GET['pn'])) {
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
        $pagenum = mysqli_real_escape_string($mysqli, $pagenum);
    } else {
        $pagenum = 1;
    }
    $page_rows = 10;
    if (mb_strlen($pagination_url) > 0) {
        $pagination_url .= "&";
    }
    $pagination_url = "products?" . $pagination_url;

    $pagination = pagination($sql_products_query, $pagenum, $page_rows, $pagination_url);

    $paginationCtrls = $pagination['paginationCtrls'];
    $textline1 = $pagination['rows'];
    $limit = $pagination['limit'];

    $order = " ORDER BY products.id DESC ";
    $sql_products_query .= $order . $limit;
    $products = $mysqli->query($sql_products_query);
    $all_products = array();
    while ($product = $products->fetch_array()) {
        $all_products[] = $product;
    }
    if (empty($all_products)) {
        $msg = "no results found";
        $smarty->assign('msg', $msg);
    }
    $smarty->assign('all_categories_subcategories', $all_categories_subcategories);

    if (isset($category_id)) {
        $smarty->assign('category_id', $category_id);
        $smarty->assign('subcategories', $subcategories);
    }
    if (isset($subcategory_id)) {
        $smarty->assign('subcategory_id', $subcategory_id);
    }
    if (isset($search_text)) {
        $smarty->assign('search_text', $search_text);
    }

    $smarty->assign('textline1', $textline1);
    $smarty->assign('all_products', $all_products);
    $smarty->assign('pagination_ctrls', $paginationCtrls);
    $display = "list_products";
}

?>

