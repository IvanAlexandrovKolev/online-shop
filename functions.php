<?php
include_once ('phpmailer/PHPMailerAutoload.php');

function send_ver($email,$subject,$message,$body)
{
    global $smarty, $SMTP;
    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $SMTP['HOST'];  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $SMTP['USERNAME'];                 // SMTP username
    $mail->Password = $SMTP['PASSWORD'];                           // SMTP password
    $mail->SMTPSecure = $SMTP['SECURE'];
    $mail->SMTPDebug = 1;
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($mail->Username);
    $mail->addAddress($email);     // Add a recipient

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;
    if (!$mail->send()) {
        echo 'Something went wrong.';
    } else {
        $smarty->assign('message', $message);
    }
}
function pagination($query,$pagenum,$p_rows,$pagination_get) {
    global $mysqli;
    $mysqli->query($query);
    $rows = $mysqli->affected_rows;
    $page_rows = $p_rows;
    $last = ceil($rows / $page_rows);
    if ($last < 1) {
        $last = 1;
    }
    if ($pagenum < 1) {
        $pagenum = 1;
    } else if ($pagenum > $last) {
        $pagenum = $last;
    }
    $limit = ' LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
    $paginationCtrls = '';
    if ($last != 1) {
        if ($pagenum > 1) {
            $previous = $pagenum - 1;
            $paginationCtrls .= '<a href="' . $pagination_get . 'pn=' . $previous . '">Previous</a> &nbsp; &nbsp; ';
            for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                if ($i > 0) {
                    $paginationCtrls .= '<a href="' . $pagination_get . 'pn=' . $i . '">' . $i . '</a> &nbsp; ';
                }
            }
        }
        $paginationCtrls .= '' . $pagenum . ' &nbsp; ';
        for ($i = $pagenum + 1; $i <= $last; $i++) {
            $paginationCtrls .= '<a href="' . $pagination_get . 'pn=' . $i . '">' . $i . '</a> &nbsp; ';
            if ($i >= $pagenum + 4) {
                break;
            }
        }
        if ($pagenum != $last) {
            $next = $pagenum + 1;
            $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $pagination_get . 'pn=' . $next . '">Next</a> ';
        }
    }
    $result = array();
    $result["limit"] = $limit;
    $result["rows"] = $rows;
    $result["paginationCtrls"] = $paginationCtrls;
    return $result;
}
function getToken($length)
{
    function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }


    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }
    return $token;
}

function check_subcategory($subcategory, $array)
{
    foreach ($array as $key => $item) {
        $subcategories_array = $item['subcategories'];
        $data = [];
        if (is_numeric($subcategory)) {
            if (array_key_exists($subcategory, $subcategories_array)) {
                $data["subcategory_name"] = $subcategories_array[$subcategory];
                $data["category_name"] = $item["category_name"];
                $data["category_id"] = $key;
                return $data;
            }
        }
    }
    return false;
}

function check_subcategory_name_in_category($subcategory_text, $category_id, $array)
{
    if (array_key_exists($category_id, $array)) {
        $subcategories_for_category = $array["$category_id"]["subcategories"];
        if (in_array($subcategory_text, $subcategories_for_category)) {
            //if same name exists
            return false;
        }
        //if category exists and there is not such subcat assigned to it
        return true;
    }
    //if such category doesnt exist
    return false;
}

function check_category_name($category_text, $array)
{
    foreach ($array as $item) {
        $category_name = $item["category_name"];
        if ($category_text === $category_name) {
            return false;
        }
    }
    return true;
}

function get_all_categories_subcategories($query)
{
    global $mysqli;
    $get_categories_query = "SELECT * FROM categories WHERE deleted = 0 ".$query;
    $categories = $mysqli->query($get_categories_query);
    $all_categories_subcategories = [];
    while ($category = $categories->fetch_assoc()) {

        $category_subcategories = [];
        $category_subcategories["category_name"] = $category["category"];

        $get_subcategories_query = "SELECT * FROM subcategories WHERE category_id = {$category["id"]} AND deleted = 0";
        $subcategories = $mysqli->query($get_subcategories_query);
        $subcategories_for_category = [];
        while ($subcategory = $subcategories->fetch_assoc()) {
            $subcategories_for_category[$subcategory["id"]] = $subcategory["subcategory"];
        }

        $category_subcategories["subcategories"] = $subcategories_for_category;
        $all_categories_subcategories[$category["id"]] = $category_subcategories;
    }
    return $all_categories_subcategories;
}
function user_status () {
    $user_status = [];
    $user_status["is_logged_in"] = 0;
    $user_status["is_admin"] = 0;
    if(isset($_SESSION["username"])) {
            $user_status["is_logged_in"] = 1;
        if ($_SESSION["admin"] == 1) {
            $user_status["is_admin"] = 1;
        }
    }
    return $user_status;
}

function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}