<?php

if (isset($_POST['delete_user']) || isset($_POST['make_admin']) || isset($_POST['make_user'])) {
    if (isset($_POST['delete_user'])) {
        $user_token = $mysqli->real_escape_string($_POST['delete_user']);
        $update = " `deleted`= 1";
        $message = "User deleted successfully";
    } else if (isset($_POST['make_admin'])) {
        $user_token = $mysqli->real_escape_string($_POST['make_admin']);
        $update = " `admin`= 1";
        $message = "Success";
    } else if (isset($_POST['make_user'])) {
        $user_token = $mysqli->real_escape_string($_POST['make_user']);
        $update = " `admin`= 0";
        $message = "Success";
    }
    $update_query = "UPDATE `users` SET " . $update . " WHERE `token`='{$user_token}'";
    $mysqli->query($update_query);
}
if (isset($_GET['edit_user'])) {
    $user_token = $mysqli->real_escape_string($_GET['edit_user']);
    $check_user_query = "SELECT * FROM users WHERE token = '{$user_token}'";
    $get_user_data = $mysqli->query($check_user_query);
    $user = $get_user_data->fetch_assoc();
    if (!empty($user)) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $mysqli->real_escape_string($_POST["username"]);
            $password = $mysqli->real_escape_string($_POST["password"]);
            $error = [];
            $update_info = "";

            if (preg_match('/^[A-Za-z0-9]{5,32}$/', $username)) {
                $check_username_query = "SELECT * FROM users WHERE username = '{$username}' AND username != '{$user['username']}'";
                $get_username = $mysqli->query($check_username_query);
                if (empty($get_username->fetch_assoc())) {
                    $user['username'] = $username;
                } else {
                    $error[] = "Username already taken.";
                }
            } else {
                $error[] = "Username must be between 5 and 32 characters long and contain only letters and numbers.";
            }
            if (mb_strlen($password) > 0) {
                if (preg_match('/^[A-Za-z0-9]{5,20}$/', $password)) {
                    $user['password'] = hash('sha512', $password);
                } else {
                    $error[] = 'Password must be between 5 and 20 characters long and contain only letters and numbers.';
                }
            }

            if (empty($error)) {
                $update_user_query = "UPDATE `users` 
                                      SET `username` = '{$user['username']}',`password` = '{$user['password']}' 
                                      WHERE `id`={$user['id']}";

                $mysqli->query($update_user_query);
                $_SESSION['message'] = "Username editted successfully";
                if (isset($_SESSION['prev'])) {
                    header("Location:" . $_SESSION['prev']);
                } else {
                    header("http:" . SITE . "users");
                }
                die;
            } else {
                $smarty->assign("error", $error);
            }
        }
        $smarty->assign("user", $user);
        $display = "edit_user_form";
    } else {
        $er_message = "Invalid user";
        $_SESSION['er_message'] = $er_message;
        header("Location: users");
        die;
    }
} else {
    $_SESSION['prev'] = "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    $current_user = $_SESSION['username'];
    $pagination_url = "";
    $users_query = "SELECT * FROM users WHERE activated=1 AND deleted = 0 AND username != '{$current_user}'";
    if (isset($_GET['search_by']) && isset($_GET['search_text'])) {
        $error = [];
        $search_text = htmlspecialchars($_GET["search_text"]);
        $search_text = mysqli_real_escape_string($mysqli, $search_text);
        $search_text_len = mb_strlen($search_text);
        $search_by = mysqli_real_escape_string($mysqli, $_GET["search_by"]);
        $targets = array("username", "email");
        if (!in_array($search_by, $targets)) {
            $error[]= "Invalid 'search by' clause";
        }
        if ($search_text_len > 0) {
            if ($search_text_len < 3 || $search_text_len > 64) {
                $error[] = "Search text must be atleast 3 characters and no longer than 64.";
            }
        } else {
            $error[] = "All fields must be filled.";
        }

        if (empty($error)) {
            $users_query .= "AND {$search_by} LIKE '%{$search_text}%'";
            $pagination_url .= "search_by={$search_by}&search_text={$search_text}";
        }
    }

    if (isset($_GET['pn'])) {
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
        $pagenum = mysqli_real_escape_string($mysqli, $pagenum);
    } else {
        $pagenum = 1;
    }

    $page_rows = 10;
    $pagination_url_len = strlen($pagination_url);
    $pagination_url = "users?" . $pagination_url;
    if ($pagination_url_len > 0) {
        $pagination_url .= "&";
    }
    $pagination = pagination($users_query, $pagenum, $page_rows, $pagination_url);

    $paginationCtrls = $pagination['paginationCtrls'];
    $textline1 = $pagination['rows'];
    $limit = $pagination['limit'];
    $order_by = " ORDER BY users.id DESC ";
    $users_query .= $order_by . $limit;
    $users = $mysqli->query($users_query);
    $all_users = array();
    while ($user = $users->fetch_array()) {
        array_push($all_users, $user);
    }
    if (empty($all_users)) {
        $msg = "no results found";
        $smarty->assign('msg', $msg);
    }

    if (isset($search_text) && isset($search_by)) {
        $smarty->assign('search_text', $search_text);
        $smarty->assign('search_by', $search_by);
    }

    $smarty->assign('textline1', $textline1);
    $smarty->assign('pagination_ctrls', $paginationCtrls);
    $smarty->assign('all_users', $all_users);
    $display = "list_users";
}
?>

