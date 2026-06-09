<?php
     session_start(); // ضروري جداً قبل التحقق من الجلسة
     include 'admin/connect.php';

// توجيه المسارات إلى المجلدات المليئة داخل admin
     $tpl  = 'admin/includes/templates/';
     $lang = 'admin/includes/languages/';
     $func = 'admin/includes/functions/';
     $css  = 'layout/css/';
     $js   = 'layout/js/';

// الاستدعاء الصحيح بدون رموز غريبة
     include $lang . 'english.php';
     include $func . 'functions.php';
     include $tpl  . 'header.php';

//     if (isset($_SESSION['username'])) {
//          include $tpl . 'navbar.php';
//     }
?>