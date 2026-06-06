<?php
     ob_start();
     session_start();

     if (isset($_SESSION['username'])) {
          $pageTitle = 'Comment';
          include 'init.php';
          $do = isset($_GET['do']) ? $_GET['do'] : 'cmment';
          if ($do == 'manage') {
               $query = "";
//               if (isset($_GET['page']) && $_GET['page'] == 'pending') {
//                    $query = 'where regStatus=0';
//
//               }
               $stmt = $con->prepare("SELECT 
                                                c.c_id,      
                                                c.comment, 
                                                c.comment_date  ,
                                                c.status,
                                                u.userName,         
                                                i.itemName        
                                            FROM comments c
                                            INNER JOIN users u ON c.user_id = u.userID
                                            INNER JOIN items i ON c.item_id = i.itemsID; ");
               $stmt->execute();
               $rows = $stmt->fetchAll();
               ?>
               <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-dark shadow-sm rounded-4 border-start border-4 border-warning">
                         <h2 class="h4 mb-0 text-white fw-bold">
                              <i class="bi bi-shield-lock-fill me-2 text-warning"></i>
                              comment Management <span class="badge bg-warning text-dark ms-2 fs-6">Admin Panel</span>
                         </h2>
                         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                         <a href="comments.php?do=add" class="btn btn-warning btn-sm px-4 fw-bold rounded-pill shadow-sm">
                              <i class="bi bi-person-plus-fill me-1"></i> Add New
                         </a>
                    </div>

                    <div class="card bg-secondary bg-opacity-10 border-0 shadow-lg rounded-4 overflow-hidden">
                         <div class="table-responsive">
                              <table class="table table-dark table-hover align-middle mb-0 text-center">
                                   <thead class="table-warning">
                                   <tr>
                                        <th class="py-3 fw-bold border-0 text-dark">ID</th>
                                        <th class="py-3 fw-bold border-0 text-dark">comment </th>
                                        <th class="py-3 fw-bold border-0 text-dark">Item Name</th>
                                        <th class="py-3 fw-bold border-0 text-dark">user Name</th>
                                        <th class="py-3 fw-bold border-0 text-dark">Added comment_data</th>
                                        <th class="py-3 fw-bold border-0 text-dark text-nowrap">Control Actions</th>
                                   </tr>
                                   </thead>
                                   <tbody class="border-top-0">
                                   <?php
                                        if (!empty($rows)) {
                                             foreach ( $rows as $raw) {
                                                 // $raw[$i]['c_id']
                                                  ?>
                                                  <tr class="border-bottom border-dark">
                                                       <td class="fw-bold"><span
                                                               class="text-warning"></span><?php echo $raw['c_id']; ?></td>
                                                       <td>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                 <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-2"
                                                                      style="width: 30px; height: 30px;">
                                                                      <i class="bi bi-person-fill"></i>
                                                                 </div>
                                                                 <span class="fw-semibold"><?php echo $raw['comment']; ?></span>
                                                            </div>
                                                       </td>
                                                      <td class="text-info"><?php echo $raw['itemName']; ?></td>
                                                      <td class="text-info"><?php echo $raw['userName']; ?></td>
<!--                                                       <td class="text-light opacity-100">--><?php //echo $raw['fullname']; ?><!--</td>-->
                                                       <td class="text-light opacity-25"><?php echo $raw['comment_date']; ?></td>
                                                       <td>
                                                            <div class="d-flex justify-content-center gap-2">
                                                                 <a href="comments.php?do=edit&c_id=<?php echo $raw['c_id']; ?>"
                                                                    class="btn btn-info btn-sm text-white fw-bold rounded-3 shadow-sm px-3">
                                                                      <i class="bi bi-pencil-square me-1"></i>Edit
                                                                 </a>
                                                                 <a href="comments.php?do=delete&c_id=<?php echo $raw['c_id']; ?>"
                                                                    class="btn btn-danger btn-sm fw-bold rounded-3 shadow-sm px-3 confirm">
                                                                      <i class="bi bi-trash3-fill me-1"></i>delete
                                                                 </a>
                                                                 <a>
                                                                      <?php
                                                                           if (!($raw['status'] === 1)) {
                                                                                echo "<a 
                                                                    href='comments.php?do=activate&c_id=" . $raw['c_id'] . "' 
                                                                        class='btn btn-info activate'>
                                                                    <i class='fa fa-check'></i> Activate</a>";

                                                                           }
                                                                      ?>
                                                                 </a>
                                                            </div>
                                                       </td>
                                                  </tr>
                                             <?php }
                                        } else {
                                             echo "<tr><td colspan='6' class='p-4 text-white'>No Comment Found</td></tr>";
                                        }
                                   ?>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
               <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
               <script src="layout/js/backend.js"></script>
               <?php
          }
          elseif ($do == 'add') { ?>
              <h1 class="text-center mb-4 fw-bold mt-5">
                  <i class="bi bi-chat-left-text-fill me-2 text-primary"></i>Add comment
              </h1>
               <div class="container">
                    <div class="row justify-content-center">
                         <div class="col-md-7 col-lg-5">
                              <div class="card shadow-sm border-0 rounded-4">
                                   <div class="card-body p-4">
                                        <form class="form-horizontal" action="?do=insert" method="post">
                                             <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                class="bi bi-at"></i></span>
                                                  <input type="text" name="comment" id="comment"
                                                         class="form-control border-start-0 rounded-end-3"
                                                         placeholder="Enter comment" autocomplete="off" >
                                             </div>


                                            <div class="input-group input-group-sm mb-3">
                                                 <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3">
                                                      <i class="bi bi-box-seam-fill"></i>
                                                 </span>
                                                <select name="item_id" id="item_id" class="form-select border-start-0 rounded-end-3" required>
                                                    <option value="" selected disabled>اختر المنتج...</option>
                                                     <?php
                                                          // جلب المنتجات من جدول المنتجات
                                                          $stmtItems = $con->prepare("SELECT categoriesID, categoriesN FROM categories");
                                                          $stmtItems->execute();
                                                          $items = $stmtItems->fetchAll();

                                                          foreach ($items as $item) {
                                                               echo "<option value='" . $item['categoriesID'] . "'>" . $item['categoriesN'] . "</option>";
                                                          }
                                                     ?>
                                                </select>
                                            </div>


                                            <div class="input-group input-group-sm mb-3">
                                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                <select name="user_com" class="form-select" required>
                                                    <option value="" selected disabled>اختر المستخدم...</option>
                                                     <?php
                                                          $stmt = $con->prepare("SELECT userID, userName FROM users");
                                                          $stmt->execute();
                                                          foreach ($stmt->fetchAll() as $user) {
                                                               echo "<option value='" . $user['userID'] . "'>" . $user['userName'] . "</option>";
                                                          }
                                                     ?>
                                                </select>
                                            </div>


                                             <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                class="bi bi-person-badge-fill"></i></span>
                                                  <input type="date" name="com_data" id="com_data"
                                                         class="form-control border-start-0 rounded-end-3"
                                                         placeholder="Enter data comment" >
                                             </div>


                                             <div class="d-grid mt-4">
                                                  <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                                       <i class="bi bi-check-lg me-1"></i> Save comment
                                                  </button>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <?php
          } // --- صفحة الإدخال في القاعدة ---
          elseif ($do == 'insert') {

               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    echo '<div class="container mt-5 text-center"><h1>Insert comment</h1>';

                    $comment = $_POST['comment'];
                    $user_com = $_POST['user_com'];
                    $item_com = $_POST['item_id'];
                    $com_data = $_POST['com_data'];

                    $formErrors = array();

                    // 1. التحقق من الحقول الفارغة
                    if (strlen($comment) < 4) {
                         $formErrors[] = "comment is too short";
                    }
                    if (strlen($comment) > 20) {
                         $formErrors[] = "Username is bag short";
                    }
                    if (empty($comment)) {
                         $formErrors[] = "<strong>empty</strong>";
                    }
                    if (empty($user_com)) {
                         $formErrors[] = "Password empty short";
                    }
                    if (empty($item_com)) {
                         $formErrors[] = "item empty ";
                    }
                    if (empty($com_data)) {
                         $formErrors[] = "date time add comment empty";
                    }



                    foreach ($formErrors as $error) {
                         echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                    }

                    if (empty($formErrors)) {

                         $stmt = $con->prepare("INSERT INTO comments (comment, status, comment_date, item_id,user_id) VALUES (?, 1,NOW(), ?,?)");
                         $stmt->execute(array($comment, $item_com, $user_com));
                         echo '<div class="alert alert-success mt-3">' . $stmt->rowCount() . ' Record Inserted</div>';

                    }


               } else {
                    $theMsg = '<div class="alert alert-danger">لا يمكنك تصفح هذه الصفحة مباشرة</div>';
                    redirectHome($theMsg);
               }
          } // --- صفحة التعديل ---
          elseif ($do == 'edit') {
               $c_id = isset($_GET['c_id']) && is_numeric($_GET['c_id']) ? intval($_GET['c_id']) : 0;
               $stmt = $con->prepare("SELECT * FROM comments WHERE c_id = ? LIMIT 1");
               $stmt->execute(array($c_id));
               $rowUser = $stmt->fetch();
               $count = $stmt->rowCount();

               if ($stmt->rowCount() > 0) { ?>
                    <h1 class="text-center mb-4 fw-bold mt-5"><i class="bi bi-person-gear me-2"></i>Edit comment</h1>

                   <div class="container">
                       <div class="row justify-content-center">
                           <div class="col-md-7 col-lg-5">
                               <div class="card shadow-sm border-0 rounded-4">
                                   <div class="card-body p-4">
                                       <form class="form-horizontal" action="?do=Update" method="post">
                                           <input type="hidden" name="c_id" value="<?php echo $rowUser['c_id']; ?>">

                                           <!-- أيقونة التعليق -->
                                           <div class="input-group input-group-sm mb-3">
                                   <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3">
                                        <i class="bi bi-chat-text-fill"></i>
                                   </span>
                                               <input type="text" name="comment" id="comment"
                                                      class="form-control border-start-0 rounded-end-3"
                                                      value="<?php echo $rowUser['comment'] ?>"
                                                      placeholder="Enter comment " autocomplete="off" required>
                                           </div>

                                           <!-- أيقونة العنصر (المنتج) -->
                                           <div class="input-group input-group-sm mb-3">
                                       <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3">
                                        <i class="bi bi-box-seam-fill"></i>
                                      </span>
                                               <select name="com_id" id="com_id" class="form-select border-start-0 rounded-end-3">

                                                    <?php
                                                         $commCat=$con->prepare("select categoriesID , categoriesN from categories");
                                                         $commCat->execute();
                                                         $commCateg = $commCat->fetchAll();
                                                         foreach ($commCateg as $cat) {
                                                             $selectedCat=($rowUser['categoriesID']==$cat['categoriesID'])?'selected':'';
                                                              echo "<option value='" . $cat['categoriesID'] . "' $selectedCat>" . $cat['categoriesN'] . "</option>";
                                                         }

                                                    ?>

                                                </select>
                                               <input type="text" name="com_id" id="com_id"
                                                      value="<?php echo $rowUser['item_id'] ?>"
                                                      class="form-control border-start-0 rounded-end-3">
                                           </div>

                                           <!-- أيقونة المستخدم -->
                                           <div class="input-group input-group-sm mb-3">
                                             <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3">
                                                  <i class="bi bi-person-fill"></i>
                                             </span>
                                               <select name="user_com" id="user_com" class="form-select border-start-0 rounded-end-3">
                                                    <?php
                                                         // جلب جميع المستخدمين من جدول المستخدمين
                                                         $stmtUsers = $con->prepare("SELECT userID, userName FROM users");
                                                         $stmtUsers->execute();
                                                         $users = $stmtUsers->fetchAll();

                                                         foreach ($users as $user) {
                                                              // التحقق مما إذا كان المستخدم هو صاحب التعليق الحالي لتحديده كقيمة افتراضية
                                                              $selected = ($rowUser['user_id'] == $user['userID']) ? 'selected' : '';
                                                              echo "<option value='" . $user['userID'] . "' $selected>" . $user['userName'] . "</option>";
                                                         }
                                                    ?>
                                               </select>
                                           </div>

                                           <!-- أيقونة التاريخ -->
                                           <div class="input-group input-group-sm mb-3">
                                      <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3">
                                        <i class="bi bi-calendar-date-fill"></i>
                                      </span>
                                               <input type="date" name="com_data" id="com_data"
                                                      value="<?php echo $rowUser['comment_date'] ?>"
                                                      class="form-control border-start-0 rounded-end-3">
                                           </div>

                                           <div class="d-grid mt-4">
                                               <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                                   <i class="bi bi-check-lg me-1"></i> Save comment
                                               </button>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>



                    <?php

               } else {
                    echo '<div class="container">';
                    $theMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">theres no such ID </div>';
                    redirectHome($theMsg);
                    echo '</div>';
               }
          } // --- تنفيذ التحديث ---
          elseif ($do == 'Update') {
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $id = $_POST['c_id'];
                    $comment = $_POST['comment'];
                    $comm_data = $_POST['com_data'];
                    $item_com = $_POST['com_id'];
                    $user_com = $_POST['user_com'];
                    $stmt = $con->prepare("UPDATE comments SET comment = ?, item_id = ?, user_id = ? WHERE c_id = ?");
                    $stmt->execute(array($comment, $item_com, $user_com, $id));
                    echo '<div class="container mt-5 text-center"><div class="alert alert-success">Record Updated</div></div>';
               } else {
                    $theMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry you cant browse this page directly</div>';
                    redirectHome($theMsg, 'back');
               }
          } // --- تنفيذ الحذف ---
          elseif ($do == 'delete') {
               $c_id = isset($_GET['c_id']) && is_numeric($_GET['c_id']) ? intval($_GET['c_id']) : 0;
               $check=checkItem('c_id','comments',$c_id);
               if($check >0){
                    $stmt = $con->prepare("DELETE FROM comments WHERE c_id=?");
                    $stmt->bindParam('user', $c_id);
                    $stmt->execute(array($c_id));
                    $theMsg= '<div class="container mt-5 text-center"><div class="alert alert-success">'.$stmt->rowCount().'Record Deleted</div></div>' ;
                    redirectHome($theMsg);
               }
               else{
                    $theMsg="<div class='alert alert-danger alert-dismissible fade show' role='alert'> This ID is not Exist</div>";
                    redirectHome($theMsg);
               }

          }
          /*start page activate*/
          elseif ($do === 'activate') {
               $c_id = isset($_GET['c_id']) && is_numeric($_GET['c_id']) ? intval($_GET['c_id']) : 0;
               $check=checkItem('c_id','comments',$c_id);
               if($check >0){
                    $stmt = $con->prepare("update comments set status  = 1  WHERE c_id=?");
                    $stmt->execute(array($c_id));
                    echo $theMsg= '<div class="container mt-5 text-center"><div class="alert alert-success">'.$stmt->rowCount().'Record activated</div></div>' ;
                    redirectHome($theMsg);
               }
               else{
                    $theMsg="<div class='alert alert-danger alert-dismissible fade show' role='alert'> This ID is not Exist</div>";
                    redirectHome($theMsg);
               }

          }
          /*End page activate*/


          include $tpl . 'footer.php';
     } else {
          header('Location: index.php');
          exit();
     }
     ob_end_flush();
?>