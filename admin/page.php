<?php
$do=isset($_GET['do'])?$_GET['do']:'manage';

if ($do=='manage') {
    echo 'hi you are in manage page category';
    echo '<a href="? do=insert">add new category</a> hi you are in manage page category';
}else if ($do=='add') {
    echo 'hi you are in add page category';
}
else if ($do=='insert') {
    echo 'hi you are in add page category';
}
else {
    echo 'error  hi you are in add page category';
}

try {
    include $tpl . 'header.php';
} catch (Exception $e) {

}
