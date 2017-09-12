<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ivanurandeals_database');
define('DB_USER', 'ivanurandeals_ivan');
define('DB_PASSWORD', '@parolata123');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$mysqli->set_charset("utf8");
?>