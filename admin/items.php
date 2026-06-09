<?php
     ob_start();
     session_start();
     $pageTitle = 'Items';

     if (isset($_SESSION['username'])) {

          $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
          include 'init.php';
          if ($do == 'manage') {
               $stmt = $con->prepare("SELECT 
                            i.itemsID,
                                i.itemName,
                                i.descriptionItem,
                                i.priceItem,
                                    i.approve,
                                i.countryMade,
                               u.userName,
                                c.categoriesN
                                
                            FROM items i 
                            INNER JOIN categories c ON i.catID = c.categoriesID
                            INNER JOIN users u ON i.memberID = u.userID");
                  $stmt->execute();
                  $rows = $stmt->fetchAll();
               ?>
              <div class="container mt-5">
                  <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-dark shadow-sm rounded-4 border-start border-4 border-warning">
                      <h2 class="h4 mb-0 text-white fw-bold">
                          <i class="bi bi-shield-lock-fill me-2 text-warning"></i>
                          Item Management <span class="badge bg-warning text-dark ms-2 fs-6">Admin Panel</span>
                      </h2>
                      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                      <a href="items.php?do=add" class="btn btn-warning btn-sm px-4 fw-bold rounded-pill shadow-sm">
                          <i class="bi bi-person-plus-fill me-1"></i> Add New item
                      </a>
                  </div>

                  <div class="card bg-secondary bg-opacity-10 border-0 shadow-lg rounded-4 overflow-hidden">
                      <div class="table-responsive">
                          <table class="table table-dark table-hover align-middle mb-0 text-center">
                              <thead class="table-warning">
                              <tr>
                                  <th class="py-3 fw-bold border-0 text-dark">ID</th>
                                  <th class="py-3 fw-bold border-0 text-dark">item Name</th>
                                  <th class="py-3 fw-bold border-0 text-dark">Description</th>
                                  <th class="py-3 fw-bold border-0 text-dark">prise</th>
                                  <th class="py-3 fw-bold border-0 text-dark">country</th>
                                  <th class="py-3 fw-bold border-0 text-dark">user_name</th>
                                  <th class="py-3 fw-bold border-0 text-dark">category_name</th>

                                  <th class="py-3 fw-bold border-0 text-dark text-nowrap">Control Actions</th>
                              </tr>
                              </thead>
                              <tbody class="border-top-0">
                              <?php
                                   if (!empty($rows)) {
                                        foreach ( $rows as $raw) {
                                             ?>
                                            <tr class="border-bottom border-dark">
                                                <td class="fw-bold"><span
                                                            class="text-warning"></span><?php echo $raw['itemsID']; ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div
                                                             style="width: 30px; height: 30px;">
                                                        </div>
                                                        <span class="fw-semibold"><?php echo $raw['itemName']; ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-info"><?php echo $raw['descriptionItem']; ?></td>
                                                <td class="text-info"><?php echo $raw['priceItem']; ?></td>
                                                <td class="text-light opacity-100"><?php echo $raw['countryMade']; ?></td>
                                                <td class="text-light opacity-100"><?php echo $raw['userName']; ?></td>
                                                <td class="text-light opacity-100"><?php echo $raw['categoriesN']; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="items.php?do=edit&itemsID=<?php echo $raw['itemsID']; ?>"
                                                           class="btn btn-info btn-sm text-white fw-bold rounded-3 shadow-sm px-3">
                                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                                        </a>
                                                        <a href="items.php?do=delete&itemsID=<?php echo $raw['itemsID']; ?>"
                                                           class="btn btn-danger btn-sm fw-bold rounded-3 shadow-sm px-3 confirm">
                                                            <i class="bi bi-trash3-fill me-1"></i>Delete
                                                        </a>
                                                         <?php

                                                              if($raw['approve']===0){
                                                                   echo '<a href="items.php?do=approve&itemsID='.$raw['itemsID'].'"
                                                                        class="btn btn-info btn-sm fw-bold rounded-3 shadow-sm px-3">
                                                                            <i class="fa fa-check"></i>approve </a>';

                                                              }else{
                                                                  echo '';
                                                              }
                                                         ?>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php }
                                   } else {
                                        echo "<tr><td colspan='6' class='p-4 text-white'>No items Found</td></tr>";
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
          } elseif ($do == 'add') { ?>
              <h1 class="text-center mb-4 fw-bold mt-5">
                  <i class="bi bi-person-gear me-2"></i>Add New Items
              </h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-7 col-lg-5">
                          <div class="card shadow-sm border-0 rounded-4">
                              <div class="card-body p-4">
                                  <form class="form-horizontal"
                                        action="?do=insert"
                                        method="post">
                                      <div class="input-group input-group-sm mb-3">
                                          <input type="text"
                                                 name="nameItem"
                                                 id="nameItem"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder="Enter Name Items"
                                                 autocomplete="off"
                                          >
                                      </div>
                                      <div class="input-group input-group-sm mb-3">
                                          <input type="text"
                                                 name="descripItem"
                                                 id="descripItem"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 autocomplete="off"
                                                 placeholder=" Items Description">
                                      </div>
                                      <div class="input-group input-group-sm mb-3">

                                          <input type="text"
                                                 name="priceItem"
                                                 id="priceItem"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 autocomplete="off"
                                                 placeholder="Price the Items">
                                      </div>

                                      <div class="input-group input-group-sm mb-3">

                                          <input type="text"
                                                 name="countryItem"
                                                 id="countryItem"
                                                 autocomplete="off"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder="country the item">
                                      </div>



                                      <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-tag-fill text-primary status-icon"></i>
                                            </span>
                                          <div class="col-sm-10 col-sm-6">
                                              <select class="form-select border-start-0 fw-bold status-select"
                                                      name="status"
                                                      id="itemStatus">
                                                  <option value='0'>............</option>
                                                  <option value='1'>New</option>
                                                  <option value='2'>Like New</option>
                                                  <option value='3'>Used</option>
                                                  <option value='4'>Very Old</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-tag-fill text-primary status-icon"></i>
                                            </span>
                                          <div class="col-sm-10 col-sm-6">
                                              <select class="form-select border-start-0 fw-bold status-select"
                                                      name="member"
                                                      id="member">
                                                  <option value='0'>............</option>
                                                   <?php
                                                        $stmt=$con->prepare("SELECT * FROM users");
                                                        $stmt->execute();
                                                        $users = $stmt->fetchAll();
                                                        foreach ($users as $hi) {
                                                             echo '<option value="'.$hi['userID'].'">'.$hi['userName'].'</option>';
                                                        }

                                                   ?>
                                              </select>
                                          </div>
                                      </div>


                                      <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-tag-fill text-primary status-icon"></i>
                                            </span>
                                          <div class="col-sm-10 col-sm-6">
                                              <select class="form-select border-start-0 fw-bold status-select"
                                                      name="categorie"
                                                      id="member">
                                                  <option value='0'>............</option>
                                                   <?php
                                                        $stmt=$con->prepare("SELECT * FROM categories");
                                                        $stmt->execute();
                                                        $cat = $stmt->fetchAll();
                                                        foreach ($cat as $hi) {
                                                             echo '<option value="'.$hi['categoriesID'].'">'.$hi['categoriesN'].'</option>';
                                                        }

                                                   ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="d-grid mt-4">
                                          <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                              <i class="bi bi-check-lg me-1"></i> Add item
                                          </button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
               <?php

          } elseif ($do == 'insert') {
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    echo '<h1 class="text-center">insert Item</h1>';
                    echo '<div class="container">';

                    $namIt = $_POST['nameItem'];
                    $descIt = $_POST['descripItem'];
                    $pricIt = $_POST['priceItem'];
                    $countIt = $_POST['countryItem'];
                    $member = $_POST['member'];
                    $categorie = $_POST['categorie'];
                    $statusIt = !empty($_POST['status']) ? $_POST['status'] : 0;
                    $formErrors = array();

                    if (empty($namIt)) {
                         $formErrors [] = 'Name Item is required<strong> Empty </strong>';
                    }
                    if (empty($descIt)) {
                         $formErrors[] = 'Description Item is required<strong> Empty </strong>';
                    }
                    if (empty($pricIt)) {
                         $formErrors[] = 'Price Item is required<strong> Empty </strong>';
                    }
                    if (empty($countIt)) {
                         $formErrors[] = 'Country Item is required<strong> Empty </strong>';
                    }
                    if ($statusIt === 0) {
                         $formErrors[] = 'Status Item is required<strong> Empty </strong>';
                    }

                    if ($member == 0) {
                         $formErrors[] = 'member  is required<strong> Empty member </strong>';
                    }
                    if ($categorie == 0) {
                         $formErrors[] = 'categorie  is required<strong> Empty categorie </strong>';
                    }

                    foreach ($formErrors as $error) {
                         echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';

                    }
                    if (empty($formErrors)) {
                         $check = checkItem('itemName', 'items', $namIt);
                         if ($check == 1) {
                              $theMsg = '<div class="alert alert-success" role="alert">sorry this user exist</div>';
                              //  redirectHome($theMsg,'back');
                         } else {
                              $stmt = $con->prepare('insert into items(itemName,descriptionItem,priceItem,addDate,countryMade,statusItem,catID,memberID) values(?,?,?,now(),?,?,?,?)');
                              $stmt->execute(array($namIt, $descIt, $pricIt, $countIt, $statusIt,$categorie,$member));
                              $theMsg="<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                              echo 'تمت الاضافة بنجاح';
                              redirectHome($theMsg,'back');
                         }

                    }

                    echo '</div>';
               } else {
                    echo '<h1 class="text-center"></h1>';
                    echo '<h1 class="text-center"> لايمكن الاضافة</h1>';
                    $theMsg = '<div class="alrt alrt-danger">لايمكن الاضافة سيتم تحويلك الى الصفحة الرئيسية</div>';
                    // redirectHome($theMsg,'back');
               }


          } elseif ($do == 'edit') {

              $itemId =isset($_GET['itemsID'])&&is_numeric($_GET['itemsID']) ? $_GET['itemsID'] : 0;
              $stmt=$con->prepare("SELECT * FROM items WHERE itemsID= ? LIMIT 1");
               $stmt->execute(array($itemId));
               $rowItem = $stmt->fetch();
               $count = $stmt->rowCount();

                if($stmt->rowCount() > 0){?>
               <h1 class="text-center mb-4 fw-bold mt-5">
                  <i class="bi bi-person-gear me-2"></i>Edite New Items
              </h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-7 col-lg-5">
                          <div class="card shadow-sm border-0 rounded-4">
                              <div class="card-body p-4">
                                  <form class="form-horizontal"
                                        action="?do=Update"
                                        method="post">
                                      <div class="input-group input-group-sm mb-3">
                                          <input type="hidden" value="<?php echo $rowItem['itemsID'];?>" name="itemsID">
                                          <input type="text"
                                                 name="nameItem"
                                                 value="<?php echo $rowItem['itemName']; ?>"
                                                 id="nameItem"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder="Enter Name Items"
                                                 autocomplete="off"
                                          >
                                      </div>
                                      <div class="input-group input-group-sm mb-3">
                                          <input type="text"
                                                 name="descripItem"
                                                 id="descripItem"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 autocomplete="off"
                                                 value="<?php echo $rowItem['descriptionItem'];?>"
                                                 placeholder=" Items Description">
                                      </div>
                                      <div class="input-group input-group-sm mb-3">

                                          <input type="text"
                                                 name="priceItem"
                                                 id="priceItem"
                                                 value="<?php echo $rowItem['priceItem']; ?>"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 autocomplete="off"
                                                 placeholder="Price the Items">
                                      </div>

                                      <div class="input-group input-group-sm mb-3">

                                          <input type="text"
                                                 name="countryItem"
                                                 id="countryItem"
                                                 value="<?php echo $rowItem['countryMade']; ?>"
                                                 autocomplete="off"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder="country the item">
                                      </div>



                                      <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-tag-fill text-primary status-icon"></i>
                                            </span>
                                          <div class="col-sm-10 col-sm-6">
                                              <select class="form-select border-start-0 fw-bold status-select"
                                                      name="status"
                                                      id="itemStatus">
                                                  <option value='0'>............</option>
                                                  <option value='1'<?=$rowItem['statusItem']==1?' selected':''?>>New</option>
                                                  <option value='2'<?=$rowItem['statusItem']==2?' selected':''?>>Like New</option>
                                                  <option value='3'<?=$rowItem['statusItem']==3?' selected':''?>>Used</option>
                                                  <option value='4'<?=$rowItem['statusItem']==4?' selected':''?>>Very Old</option>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-tag-fill text-primary status-icon"></i>
                                            </span>
                                          <div class="col-sm-10 col-sm-6">
                                              <select class="form-select border-start-0 fw-bold status-select"
                                                      name="member"
                                                      id="member">
                                                  <option value='0'>............</option>
                                                   <?php
                                                        $stmt=$con->prepare("SELECT * FROM items");
                                                        $stmt->execute();
                                                        $users = $stmt->fetchAll();
                                                        foreach ($users as $hi) {
                                                             echo '<option value="'.$hi['itemsID'].'">'.$hi['itemName'].'</option>';
                                                        }

                                                   ?>
                                              </select>
                                          </div>
                                      </div>



                                      <div class="input-group mb-3 shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-tag-fill text-primary status-icon"></i>
                                            </span>
                                          <div class="col-sm-10 col-sm-6">
                                              <select class="form-select border-start-0 fw-bold status-select"
                                                      name="categorie"
                                                      id="member">
                                                  <option value='0'>............</option>
                                                   <?php
                                                        $stmt=$con->prepare("SELECT * FROM categories");
                                                        $stmt->execute();
                                                        $cat = $stmt->fetchAll();
                                                        foreach ($cat as $hi) {
                                                             echo '<option value="'.$hi['categoriesID'].'">'.$hi['categoriesN'].'</option>';
                                                        }

                                                   ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="d-grid mt-4">
                                          <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                              <i class="bi bi-check-lg me-1"></i> edit item
                                          </button>
                                      </div>
                                  </form>
                              </div>
                              </div>
                          <h1>manage comment  : the <?php echo $rowItem['itemName']; ?></h1>

                      </div>

                                  <?php
                                    $stmt = $con->prepare("SELECT
                                    c.c_id,
                                    c.comment,
                                    c.comment_date,
                                    c.status,
                                    u.userName,
                                    i.itemName
                                    FROM comments c
                                    INNER JOIN users u ON c.user_id = u.userID
                                    INNER JOIN items i ON c.item_id = i.itemsID WHERE c.item_id = ? ");
                                    $stmt->execute(array($rowItem['itemsID']));
                                    $rows = $stmt->fetchAll();
                                  ?>
                                  <div class="container mt-5">


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


                              </div>
                          </div>
               <?php
                }



          } elseif ($do == 'Update') {


               if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $id = $_POST['itemsID'];
                    $user = $_POST['nameItem'];
                    $pass = $_POST['descripItem'];
                    $mail = $_POST['priceItem'];
                    $full = $_POST['countryItem'];
                    $selected = $_POST['status'];
                    $stmt = $con->prepare("UPDATE items SET itemName = ?,descriptionItem=?, priceItem = ?, countryMade = ?,statusItem=? WHERE itemsID = ?");
                    $stmt->execute(array($user, $pass, $mail, $full,$selected,$id));
                    echo '<div class="container mt-5 text-center"><div class="alert alert-success">Record Updated</div></div>';
               } else {
                  echo  $theMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry you cant browse this page directly</div>';
                    redirectHome($theMsg, 'back');
               }



          } elseif ($do == 'delete') {
               $item =isset($_GET['itemsID'])&&is_numeric($_GET['itemsID']) ? $_GET['itemsID'] : 0;
              $check=checkItem('itemsID','items',$item);
              if($check >0){
                  $stmt = $con->prepare("DELETE FROM items WHERE  itemsID = ?");
                  $stmt->execute([$item]);
                  echo '<div class="container mt-5 text-center"><div class="alert alert-success">Record Deleted</div></div>';


               }
              else{
                  echo'لم يتم الحذف يرجى التحقق من العنصر ';
              }




          } elseif ($do == 'approve') {

              $itemId=isset($_GET['itemsID']) && is_numeric($_GET['itemsID']) ? intval($_GET['itemsID']):0;
              $check=checkItem('itemsID','items',$itemId);
              if($check >0){
                  $stmt = $con->prepare("UPDATE items SET approve = 1 WHERE itemsID = ?");
                  $stmt->execute(array($itemId));
                   echo '<div class="container mt-5 text-center"><div class="alert alert-success">Record Approved</div></div>';
              }
              else{
                  echo 'erorrrrrrrrrrrrrrrrrr';
              }
          }

          include $tpl . 'footer.php';

     } else {
         echo 'لايمكنك الدخول الى هذه الصفحة مباشرة ';
//          header('Location: index.php');
//          exit();
     }
     ob_end_flush();
?>