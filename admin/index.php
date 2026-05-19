<?php
ob_start();
session_start();
$pageTitle='login';
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
}
include 'init.php';
//include $tpl.'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];
//   echo $hashpass = sha1($password);

    $stmt = $con->prepare("select
                                     userID,userName,password 
                                      from 
                                        users 
                                      where 
                                        userName=?
                                      and
                                        password=?
                                      and
                                      gropID=1
                                        limit 1");

    $stmt->execute(array($username, $password));

    $row = $stmt->fetch();

    $count = $stmt->rowCount();

    if ($count > 0) {

      $_SESSION['username'] = $username;
      $_SESSION['userID'] = $row['userID'];
        header('Location: dashboard.php');
        exit();
    }

}

?>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<form class="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <link rel="stylesheet" href="layout/css/backend.css">
    <h4 class="text-center"> Admin login </h4>
    <input class="form-control" type="text" name="user" placeholder="ادخل كلمة الاسم الخاصة بك ">
    <input class="form-control" type="password" name="pass" placeholder="ادخل كلمة المرور الخاصة بك ">
    <input class="btn btn-primary w-100" type="submit" value="Login">

</form>


    <?php

    include $tpl . 'footer.php';

    ?>



