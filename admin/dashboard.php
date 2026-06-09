<?php
     ob_start();
     session_start();

     if (isset($_SESSION['username'])) {
          $pageTitle = 'dashboard';
          include 'init.php';
          $latestUser = 5;
          $theLatest = getlatest('*', 'users', 'userID', $latestUser);; /* التغير الخاص بعدد العناصر التي سون تظهر*/
          $latesItem=5;
          $theLatestItem = getlatest('*', 'items', 'itemsID', $latesItem);
          $lastComment=5;
                       $stmt = $con->prepare("SELECT comments.*, users.userName 
                       FROM comments 
                       INNER JOIN users ON users.userID = comments.user_id 
                       ORDER BY c_id DESC LIMIT 5");
                       $stmt->execute();
                       $theLatestComment = $stmt->fetchAll();
          ?>
         <!--/*start dashboard page */-->

         <link rel="stylesheet" href="layout/css/backend.css">
         <div class="home-stats">
             <div class="container text-center">
                 <h1>Dashboard</h1>
                 <div class="row">
                     <div class="col-md-3">
                <span><a style="text-decoration: none" href="members.php?do=manage">
                <div class="stat st-member">Total Members
                    <p class="font"><?php echo '<br>' . countItems("userID", "users") ?></p>

                </div>
                    </a> </span>
                     </div>
                     <div class="col-md-3">
                         <div class="stat st-pending">Pending Members
                             <span><a href="members.php?page=pending"><?php echo checkItem("regStatus", "users", 0) ?></a> </span>
                         </div>
                     </div>
                     <div class="col-md-3">
                         <div class="stat st-member">Total Items
                             <p class="font"><?php echo '<br>' . countItems("itemsID", "items") ?></p>
                         </div>
                     </div>

                     <div class="col-md-3">
                         <div class="stat st-comments">Total Comments
                             <span><a href="comments.php?do=manage"><?php echo countItems("c_id","comments")?></a> </span>
                         </div>
                     </div>
                 </div>
             </div>

             <div class=" container latest">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="panel panel-default">
                             <div class="panel-heading">
                                 <i class="fa fa-users"></i> latest <?php echo $latestUser ?> registered users
                                 <span class="toggle-info pull-right">
                                    <i class="bi bi-plus-lg"></i>
                                 </span>
                             </div>
                             <div class="card" style="width: 533px">
                                 <ul class="list-unstyled latest-user">
                                      <?php
                                           foreach ($theLatest as $user) {
                                                echo '<li>' . $user['userName'] . '<span class="btn btn-success ">
                                      <a style="color: #eee;text-decoration: none"  href="members.php?do=edit&userID=' . $user['userID'] . '">Edite</a> </span></li>';

                                           }
                                      ?>
                                 </ul>
                             </div>
                         </div>
                     </div>

<!--                     items-->
                     <div class="col-md-6">
                         <div class="panel panel-default">

                             <div class="panel-heading">
                                 <i class="fa fa-tags"></i>
                                 Latest <?php echo $lastComment; ?> Comment

                                 <span class="toggle-info pull-right">
                                        <i class="bi bi-plus-lg"></i>
                                 </span>
                             </div>

                             <div class="panel-body border border-top-0 p-3" style="width:533px">
                                 <ul class="list-unstyled latest-user mb-0">
                                      <?php
                                           foreach ($theLatestComment as $comm) {
                                                echo '<li class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">';

                                                // 1. حاوية الاسم والتعليق (تأخذ أغلب المساحة)
                                                echo '<div class="d-flex align-items-center" style="width: 80%;">';

                                                // 2. اسم المستخدم (عرض ثابت 90px لوزن جميع التعليقات على خط واحد)
                                                echo '<span class="text-primary fw-bold text-truncate" style="min-width: 90px;">' . $comm['userName'] . '</span>';

                                                // 3. مربع التعليق
                                                echo '<div class="comment-box text-truncate">' . $comm['comment'] . '</div>';

                                                echo '</div>';

                                                // 4. زر التعديل (في أقصى اليمين ثابت لا يتأثر بطول التعليق)
                                                echo '<a class="btn btn-success btn-sm text-nowrap" href="comments.php?do=edit&c_id=' . $comm['c_id'] . '">Edit</a>';

                                                echo '</li>';
                                           }
                                      ?>
                                 </ul>
                             </div>

                         </div>
                     </div>

<!--                     comment last and user -->


                 </div>
                 <div class="col-md-6">
                     <div class="panel panel-default">

                         <div class="panel-heading">
                             <i class="fa fa-tags"></i>
                             Latest <?php echo $latesItem; ?> Items

                             <span class="toggle-info pull-right">
                                        <i class="bi bi-plus-lg"></i>
                                 </span>
                         </div>

                         <div class="card" style="width:533px">
                             <ul class="list-unstyled latest-user">
                                  <?php
                                       foreach ($theLatestItem as $item)
                                       {
                                            echo
                                               '<li>' .
                                               $item['itemName'] .
                                               '<span class="btn btn-success">
                                                           <a style="color:#eee;text-decoration:none"
                                                               href="items.php?do=edit&itemsID=' . $item['itemsID'] . '">
                                                                Edit
                                                             </a>
                                                           </span>
                                                      </li>';
                                       }
                                  ?>
                             </ul>
                         </div>

                     </div>
                 </div>
            </div>




         <!--/*end dashboard page */-->
          <?php

          include $tpl . 'footer.php';
          ?>
          <script src="layout/js/backend.js"></script>

          <?php
     } else {
          header('Location: index.php');
          exit();
     }
     ob_end_flush();
?>



