<?php
if (isset($_POST["name"]) && isset($_POST["mobile"]) && isset($_POST["email"]) && isset($_POST["quantity"])) {
    $new_order = new NikiApi("pilaten", "secret");
    $data = [];
    if (mb_strlen($_POST["name"])) {
        $full_name = explode(" ", $_POST["name"]);
        if (sizeof($full_name) == 2) {
            $data["name"] = $mysqli->real_escape_string($_POST["name"]);
        } else {
            $error[] = "Неправилно въведени 2 имена.  (Пример: Иван Колев)";
        }
    } else {
        $error[] = "Моля въведете 2 имена.";
    }

    if (is_numeric($_POST["mobile"]) && preg_match("/^[0][8][0-9]{8}$/", $_POST["mobile"])) {
        $data["mobile"] = $_POST["mobile"];
    } else {
        $error[] = "Неправилно въведен телефонен номер(10 символа).  (Пример: 08********)";
    }
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $data['email'] = $mysqli->real_escape_string($_POST["email"]);
    } else {
        $error[] = "Неправилно въведен имейл.";
    }
    if (is_numeric($_POST["quantity"])) {
        $data["quantity"] = $_POST["quantity"];
    } else {
        $error[] = "Правиш се на хакер.";
    }
    if (empty($error)) {
        $response = $new_order->addOrder($data["name"], $data["email"], $data["mobile"], $data["quantity"]);
        $response = json_decode($response, 1);
        if (isset($response["success"])) {
            $insert_user_query = "INSERT INTO users(username,email,c_token) VALUES('{$data['name']}','{$data['email']}','{$data['mobile']}')";
            $mysqli->query($insert_user_query);
            $user_id = $mysqli->insert_id;
            $insert_order_query = "INSERT INTO pilaten_orders(user_id,quantity) VALUES($user_id,{$data['quantity']})";
            $mysqli->query($insert_order_query);
            print_r("Успешна покупка!");
            die;
        } else if (isset($response["fail"])) {
            $error = $response["fail"];
        }
    }
    $smarty->assign("data", $data);
}
$display = "pilaten";