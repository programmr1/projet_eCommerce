<?php
include 'connect.php';
// 1. قم بتعريف المسارات كمتغيرات نصية فقط (لا تستخدم include هنا)
$tpl  = 'includes/templates/'; // مسار المجلد
$lang = 'includes/languages/'; // مسار اللغات
$func = 'includes/functions/'; // مسار اللغات
$js   = 'layout/js/';
$mem='members.php';
$css = 'layout/css/';
include $lang.'english.php';
include $func.'functions.php';
include $tpl.'header.php' ;

if (isset($_SESSION['username'])) {
    include $tpl.'navbar.php';
}else{

}


?>
