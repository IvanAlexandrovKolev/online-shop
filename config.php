<?php
require_once('libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir= 'views';

define('SITE', "http://ivan.urandeals.eu/");
define('SHOP', "http://localhost/Register/");

$SMTP = array('HOST'=> "ivan.urandeals.eu",
              'USERNAME'=>"mail4e@ivan.urandeals.eu",
              'PASSWORD' => 'S#}y4=b=f&Jn',
              'SECURE' => 'tls');
$parola = "S#}y4=b=f&Jn";

?>