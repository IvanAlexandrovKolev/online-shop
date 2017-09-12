<?php
$product = [];

if (isset($_GET['prod_id']) && is_numeric($_GET['prod_id'])) {
    $product_id = $mysqli->real_escape_string($_GET['prod_id']);
    $get_product_info_query = "SELECT * FROM products WHERE id = {$product_id}";
    $get_product_data = $mysqli->query($get_product_info_query);
    $product = $get_product_data->fetch_assoc();
    if (!empty($product)) {
        $product['description'] = htmlspecialchars_decode($product['description']);
    } else {
        $_SESSION['er_message'] = "Product with such id doesn't exist.";
    }
}
//GET ALL CATEGORIES AND SUBCATEGORIES
$all_categories_subcategories = get_all_categories_subcategories("");

if (isset($product['category_id'])) {
    $category_id = $product['category_id'];
} else {
    $category_id = key($all_categories_subcategories);
}
$subcategories = $all_categories_subcategories[$category_id]["subcategories"];

if (isset($_POST['create_product']) || isset($_POST['edit_product'])) {
    $error = [];
    $category_id = $mysqli->real_escape_string($_POST['category']);
    $subcategory_id = $mysqli->real_escape_string($_POST['subcategory']);

    $check_subcat_and_category = "SELECT * FROM subcategories WHERE id = {$subcategory_id} AND category_id = '{$category_id}'";
    $mysqli->query($check_subcat_and_category);
    if ($mysqli->affected_rows == 1) {
        $product['category_id'] = $category_id;
        $product['subcategory_id'] = $subcategory_id;
    } else {
        $error[] = "Such category/subcategory doesn't exist.";
    }

    $name = htmlspecialchars($_POST["name"]);
    $name = $mysqli->real_escape_string($name);
    if (mb_strlen($name) >= 3 && mb_strlen($name) <= 32) {
        $product['name'] = $name;
    } else if (mb_strlen($name) > 32) {
        $error[] = "Name can be 32 cahracters long!";
    } else {
        $error[] = "Name must be atleast 3 cahracters long!";
    }
    $description = htmlspecialchars($_POST["description"]);
    $description = $mysqli->real_escape_string($description);
    if (mb_strlen($description) >= 10) {
        $product['description'] = $description;
    } else {
        $error[] = "Description must be atleast 10 cahracters long!";
    }
    $price = $mysqli->real_escape_string($_POST['price']);
    if (is_numeric($price) && $price >= 0) {
        $price = floatval($_POST['price']);
        $product['price'] = $price;
    } else {
        $error[] = "Price must be a positive number!";
    }
    $quantity = $mysqli->real_escape_string($_POST['quantity']);
    if (is_numeric($quantity) && $quantity >= 0) {
        $quantity = intval($_POST['quantity']);
        $product["quantity"] = $quantity;
    } else {
        $error[] = "Quantity must be a positive number!";
    }
    if ($_FILES['new_image_field']['size'] > 0 && $_FILES['new_image_field']['size'] <= 5000000) {
        $handle = new upload($_FILES['new_image_field']);
        if ($handle->uploaded) {
            $handle->file_new_name_body = $name . time();
            $handle->image_resize = true;
            $handle->image_x = 100;
            $handle->image_y = 100;
            $handle->process('images/products');
            if ($handle->processed) {
                $image_name = $handle->file_dst_name;
            } else {
                $error[] = "Something went wrong with uploading the picture.";
            }
            $handle->file_new_name_body = "big" . $name . time();
            $handle->image_resize = true;
            $handle->image_x = 250;
            $handle->image_y = 250;
            $handle->process('images/products');
            if ($handle->processed) {
                $big_image_name = $handle->file_dst_name;
            } else {
                $error[] = "Something went wrong with uploading the picture.";
            }
            $handle->clean();
        }
    } else if ($_FILES['new_image_field']['size'] > 5000000) {
        $error[] = "Can't upload pictures bigger than 5 MB!";
    } else if (isset($_POST['create_product'])) {
        $error[] = "You must choose a picture!";
    }
    if (isset($image_name) && isset($big_image_name)) {
        $product["image_name"] = $image_name;
        $product["big_image_name"] = $big_image_name;
    }
    if (empty($error)) {
        if (isset($_POST['edit_product'])) {
            $old_image_name = $product['image_name'];
            $path_image = "C:/xampp/htdocs/Register/images/products/{$old_image_name}";

            $old_big_image_name = "big" . $old_image_name;
            $path_big_image = "C:/xampp/htdocs/Register/images/products/{$old_big_image_name}";

            $update_product_query = "UPDATE products 
                                     SET `name`  = '{$product['name']}',
                                     description ='{$product['description']}',
                                     quantity = {$product['quantity']},
                                     price = {$product['price']},
                                     category_id = {$product['category_id']},
                                     subcategory_id = {$product['subcategory_id']},
                                     image_name = '{$product['image_name']}',
                                     big_image_name = '{$product['big_image_name']}'
                                     WHERE id = {$product['id']}";

            if ($product["image_name"] != $old_image_name && $product["big_image_name"] != $old_big_image_name) {
                unlink($path_image);
                unlink($path_big_image);
            }
            $mysqli->query($update_product_query);
            if ($mysqli->affected_rows == 1) {
                $_SESSION['message'] = "Product editted.";
            }
        } else if (isset($_POST['create_product'])) {
            $insert_new_product_query = "INSERT INTO products(name,description,quantity,price,image_name,big_image_name,category_id,subcategory_id) 
                                         VALUES('{$product['name']}',
                                         '{$product['description']}',
                                         {$product['quantity']},
                                         {$product['price']},
                                         '{$product['image_name']}',
                                         '{$product['big_image_name']}',
                                         {$product['category_id']},
                                         {$product['subcategory_id']})";

            $mysqli->query($insert_new_product_query);
            $_SESSION['message'] = "Product created successfully.";
        }
    } else {
        $smarty->assign('error', $error);
    }
}
$smarty->assign('all_categories', $all_categories_subcategories);
$smarty->assign('subcategories', $subcategories);
$smarty->assign("product", $product);
$display = "create_edit_product_form";



