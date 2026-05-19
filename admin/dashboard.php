
<?php
ob_start();
session_start();

if (isset($_SESSION['username'])) {
     $pageTitle='dashboard';
    include 'init.php';
         $theLatest=getlatest('*','users','userID','3');
         $latestUser=5; /* التغير الخاص بعدد العناصر التي سون تظهر*/


?>
<!--/*start dashboard page */-->
     <link rel="stylesheet" href="layout/css/backend.css">
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">-->
<!--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">-->
<div class="home-stats">
    <div class="container text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <span><a style="text-decoration: none" href="members.php?do=manage">
                <div class="stat st-member">Total Members
                    <p class="font"><?php echo '<br>'.countItems("userID","users")  ?></p>

                </div>
                    </a> </span>
            </div>
            <div class="col-md-3">
                <div class="stat st-pending">Pending Members
                    <span><a href="members.php?page=pending"><?php echo checkItem("regStatus","users",0)  ?></a> </span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat st-member">Total Items
                    <p class="font"><?php echo '<br>'.countItems("itemsID","items")  ?></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat st-comments">Total Comments
                    <span>2000</span>
                </div>
            </div>
        </div>
    </div>

    <div class=" container latest">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> latest <?php echo $latestUser?> registered users

                    </div>
                    <div class="card" style="width: 533px">
                        <ul class="list-unstyled latest-user" >
                            <?php
                                foreach ($theLatest as $user) {
                                    echo '<li>'.$user['userName'].'<span class="btn btn-success ">
                                      <a style="color: #eee;text-decoration: none"  href="members.php?do=edit&userID='.$user['userID'].'">Edite</a> </span></li>';
//                                    echo '<i class="fa fa-edit"</i>';
//                                    if (!($user['regStatus'] === 1)) {
//                                        echo "<a
//                                                                       href='members.php?do=activate&userID=" . $user['userID'] . "'
//                                                                            class='btn btn-info activate'>
//                                                                        <i class='fa fa-check'></i> Activate</a>";
//
//                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> latest registerd users
                    </div>
                    <div class="card">
                        tast
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<!--/*end dashboard page */-->
<?php

     include $tpl . 'footer.php';
}
else{
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>



