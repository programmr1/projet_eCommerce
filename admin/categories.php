<?php
     ob_start();
     session_start();
     $pageTitle = 'categories';
     include 'init.php';?>
<link rel="stylesheet" href="layout/css/backend.css?v=<?php echo time(); ?>">     <?php

     if (isset($_SESSION['username'])) {
          $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
          if ($do == 'manage') {
               $sort = "ASC";
               $sort_array = array('ASC', 'DESC');
               if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
                    $sort = $_GET['sort'];
               }


               $stmt = $con->prepare("SELECT * FROM categories order by orden $sort");
               $stmt->execute();
               $rows = $stmt->fetchAll();
               ?>


              <h1 class="text-center">categories Management </h1>
              <div class="container categories">
                  <div class="panel panel-default">
                      <div class="panel-heading">categories Management
                          <div class="option" style="direction: rtl;">
                              Ordering:
                              <a class="<?php echo ($sort == 'ASC') ? 'active' : ''; ?>" href="?sort=ASC">ASC</a> |
                              <a class="<?php echo ($sort == 'DESC') ? 'active' : ''; ?>" href="?sort=DESC">DESC</a>
                              View:
                              <span class="active" data-view="full">Full</span> |
                              <span data-view="classic">Classic</span>
                          </div>
                      </div>
                      <div class="card vvvv">
                           <?php
                                foreach ($rows as $cat) {
                                     echo '<div class="cat">';
                                     echo '<div class="hidden-btn">';
                                     echo '<a class="btn btn-xs btn-primary" href="categories.php?do=edit&&catID=' . $cat['categoriesID'] . '"><i class="fa fa-edit"></i> Edit</a>';
                                     echo '<a class="btn btn-xs btn-danger" href="categories.php?do=delete&&catID=' . $cat['categoriesID'] . '"><i class="fa fa-trash"></i> Delet</a>';
                                     echo '</div>';
                                     echo '<h3>' . $cat['categoriesN'] . '</h3>';
                                     echo '<p>';
                                     echo '<div class="full-view">';
                                     echo !(empty($cat['description'])) ? $cat['description'] : "not description empty";
                                     echo '</p>';
                                     if ($cat['visibility'] == 1) {
                                          echo '<span class="visibility">Hidden</span>';
                                     }
                                     if ($cat['allowComment'] == 1) {
                                          echo '<span class="comment">comment Disable</span>';
                                     }
                                     if ($cat['allowAds'] == 1) {
                                          echo '<span class="advertises">Ads Disable</span>';
                                     }
                                     echo '</div>';
                                     echo '</div>';
                                     echo '<hr>';

                                }

                           ?>
                      </div>
                  </div>
                  <a class="btn-addCat btn btn-primary" style="margin: 3px;" href="categories.php?do=add"><i class="fa fa-plus" style="padding: 10px;"></i>Add New Categories</a>
              </div>

               <?php


          } elseif ($do == 'add') { ?>
              <h1 class="text-center mb-4 fw-bold mt-5">
                  <i class="bi bi-person-gear me-2"></i>Add New categories
              </h1>
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-7 col-lg-5">
                          <div class="card shadow-sm border-0 rounded-4">
                              <div class="card-body p-4">
                                  <form class="form-horizontal" action="?do=insert" method="post">
                                      <div class="input-group input-group-sm mb-3">
                                          <input type="text" name="nameCat" id="username"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder="Enter category" autocomplete="off" required>
                                      </div>
                                      <div class="input-group input-group-sm mb-3">
                                          <input type="text" name="descipCat" id="descipCat"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder=" categories Description">
                                      </div>
                                      <div class="input-group input-group-sm mb-3">

                                          <input type="text" name="ordering" id="ordering"
                                                 class="form-control border-start-0 rounded-end-3"
                                                 placeholder="Ordering the categorise">
                                      </div>
                                      <div style="display: grid; justify-content: space-around;">
                                          <div class="form-group form-group-gl">
                                              <div>
                                                  <label>visible</label>
                                                  <div>
                                                      <input type="radio" name="visible" id="visibleY" value="0"
                                                             checked>
                                                      <label for="visibleY">YES</label>

                                                      <input type="radio" name="visible" id="visibleNo" value="1"
                                                             checked>
                                                      <label for="visibleNo">NO</label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-group-gl">
                                              <div>
                                                  <label>allowAds</label>
                                                  <div>
                                                      <input type="radio" name="allowAds" id="allowAds" value="0"
                                                             checked>
                                                      <label for="allowAds">YES</label>

                                                      <input type="radio" name="allowAds" id="allowAds" value="1"
                                                             checked>
                                                      <label for="allowAdsNO">NO</label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-group-gl">
                                              <div>
                                                  <label>Comment</label>
                                                  <div>
                                                      <input type="radio" name="CommentY" id="Comment" value="0"
                                                             checked>
                                                      <label for="CommentY">YES</label>
                                                      <input type="radio" name="CommentY" id="Comment" value="1"
                                                             checked>
                                                      <label for="commetnNO">NO</label>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="d-grid mt-4">
                                          <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                              <i class="bi bi-check-lg me-1"></i> Save category
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
                    echo '<div class="container mt-5 text-center"><h1>Insert Member</h1>';
                    $catName = $_POST['nameCat'];
                    $descCat = $_POST['descipCat'];
                    $orderingCat = !empty($_POST['ordering']) ? $_POST['ordering'] : 0;
                    $visible = $_POST['visible'];
                    $comment = $_POST['CommentY'];
                    $allowAds = $_POST['allowAds'];

                    $check = checkItem('categoriesN', 'categories', $catName);
                    if ($check == 1) {
                         $theMsg = '<div class="alert alert-danger">لا يمكنك تصفح هذه الصفحة مباشرة</div>';
                         redirectHome($theMsg, 'back');
                    } else {
                         $stmt = $con->prepare("INSERT INTO categories (categoriesN, description,visibility, allowComment,allowAds,orden) VALUES (?, ?, ?, ?,?,?)");
                         $stmt->execute(array($catName, $descCat, $visible, $comment, $allowAds, $orderingCat));
                         $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
                         redirectHome($theMsg, 'back');
                    }
               } else {
                    echo '<div class="container">';
                    $theMsg = '<div class="container mt-5 text-center"><h1>Insert categories</h1>';
                    redirectHome($theMsg, 'back');
                    echo '</div>';
               }
               echo '</div>';
               }

            elseif ($do == 'edit') {

                    // التأكد من وجود المعرف وصحته
               $catID = isset($_GET['catID']) && is_numeric($_GET['catID']) ? intval($_GET['catID']) : 0;

               // جلب البيانات بناءً على العمود categoriesID
               $stmt = $con->prepare("SELECT * FROM categories WHERE categoriesID = ?");
               $stmt->execute(array($catID));
               $raw = $stmt->fetch();
               $count = $stmt->rowCount();

               if ($count > 0) { ?>

                   <h1 class="text-center mb-4 fw-bold mt-5 text-dark">
                       <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Category
                   </h1>

                   <div class="container">
                       <div class="row justify-content-center">
                           <div class="col-md-8 col-lg-6">
                               <div class="card shadow-lg border-0 rounded-4">
                                   <div class="card-body p-5">
                                       <form action="?do=update" method="POST">
                                           <input type="hidden" name="catid" value="<?php echo $raw['categoriesID']; ?>" />

                                           <div class="mb-3">
                                               <label class="form-label fw-semibold">Category Name</label>
                                               <div class="input-group">
                                                   <span class="input-group-text bg-white border-end-0"><i class="bi bi-tag text-primary"></i></span>
                                                   <input type="text" name="nameCat"
                                                          value="<?php echo $raw['categoriesN']; ?>"
                                                          class="form-control border-start-0 ps-0" required>
                                               </div>
                                           </div>

                                           <div class="mb-3">
                                               <label class="form-label fw-semibold">Description</label>
                                               <div class="input-group">
                                                   <span class="input-group-text bg-white border-end-0"><i class="bi bi-card-text text-primary"></i></span>
                                                   <input type="text" name="descipCat"
                                                          value="<?php echo $raw['description']; ?>"
                                                          class="form-control border-start-0 ps-0" placeholder="Describe the category">
                                               </div>
                                           </div>

                                           <div class="mb-4">
                                               <label class="form-label fw-semibold">Ordering</label>
                                               <div class="input-group">
                                                   <span class="input-group-text bg-white border-end-0"><i class="bi bi-sort-numeric-down text-primary"></i></span>
                                                   <input type="number" name="ordering"
                                                          value="<?php echo $raw['orden']; ?>"
                                                          class="form-control border-start-0 ps-0" min="0">
                                               </div>
                                           </div>

                                           <hr class="my-4 opacity-25">

                                           <div class="row g-4 mb-4">

                                               <div class="col-md-4">
                                                   <div class="card h-100 border-light shadow-sm">
                                                       <div class="card-header bg-white fw-bold text-primary border-0 pb-0 pt-3">
                                                           <i class="bi bi-eye me-1"></i> Visibility
                                                       </div>
                                                       <div class="card-body">
                                                           <div class="btn-group w-100" role="group">
                                                               <input type="radio" class="btn-check" name="visibility" id="v-yes" value="1" <?php if($raw['visibility'] == 1) echo 'checked'; ?>>
                                                               <label class="btn btn-outline-success border-2 fw-bold" for="v-yes">Visible</label>

                                                               <input type="radio" class="btn-check" name="visibility" id="v-no" value="0" <?php if($raw['visibility'] == 0) echo 'checked'; ?>>
                                                               <label class="btn btn-outline-danger border-2 fw-bold" for="v-no">Hidden</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>

                                               <div class="col-md-4">
                                                   <div class="card h-100 border-light shadow-sm">
                                                       <div class="card-header bg-white fw-bold text-primary border-0 pb-0 pt-3">
                                                           <i class="bi bi-chat-dots me-1"></i> Comments
                                                       </div>
                                                       <div class="card-body">
                                                           <div class="btn-group w-100" role="group">
                                                               <input type="radio" class="btn-check" name="allowComment" id="c-yes" value="1" <?php if($raw['allowComment'] == 1) echo 'checked'; ?>>
                                                               <label class="btn btn-outline-success border-2 fw-bold" for="c-yes">Allow</label>

                                                               <input type="radio" class="btn-check" name="allowComment" id="c-no" value="0" <?php if($raw['allowComment'] == 0) echo 'checked'; ?>>
                                                               <label class="btn btn-outline-danger border-2 fw-bold" for="c-no">Deny</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>

                                               <div class="col-md-4">
                                                   <div class="card h-100 border-light shadow-sm">
                                                       <div class="card-header bg-white fw-bold text-primary border-0 pb-0 pt-3">
                                                           <i class="bi bi-megaphone me-1"></i> Advertisements
                                                       </div>
                                                       <div class="card-body">
                                                           <div class="btn-group w-100" role="group">
                                                               <input type="radio" class="btn-check" name="allowAds" id="a-yes" value="1" <?php if($raw['allowAds'] == 1) echo 'checked'; ?>>
                                                               <label class="btn btn-outline-success border-2 fw-bold" for="a-yes">On</label>

                                                               <input type="radio" class="btn-check" name="allowAds" id="a-no" value="0" <?php if($raw['allowAds'] == 0) echo 'checked'; ?>>
                                                               <label class="btn btn-outline-danger border-2 fw-bold" for="a-no">Off</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>

                                           </div>

                                           <div class="d-grid mt-4">
                                               <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold py-3 border-0">
                                                   <i class="bi bi-save2-fill me-2"></i> Update Category Details
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
                    echo "<div class='container mt-5'><div class='alert alert-danger'>Sorry, No Such ID Found.</div></div>";
               }
          }
            elseif ($do == 'update') {
              if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $catID=$_POST['catid'];
                  $catName = $_POST['nameCat'];
                  $catDescription = $_POST['descipCat'];
                  $catOrder = $_POST['ordering'];
                  $catVisibility = $_POST['visibility'];
                  $catAllowComment = $_POST['allowComment'];
                  $catAllowAds = $_POST['allowAds'];

                   $stmt = $con->prepare("update categories set categoriesN=?,description=?,visibility=?,allowComment=?,allowAds= ?,orden=? where categoriesID = ?");
                   $stmt->execute(array($catName, $catDescription, $catVisibility, $catAllowComment, $catAllowAds, $catOrder, $catID));
                   echo '<div class="container mt-5 text-center"><div class="alert alert-success">Record Updated</div></div>';
            } else {
                $theMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry you cant browse this page directly</div>';
              //  redirectHome($theMsg, 'back');
            }

         }
            elseif ($do == 'delete') {
              $catID = isset($_GET['catID']) && is_numeric( $_GET['catID'])?intval($_GET['catID']):0;
              $check=checkItem('categoriesID','categories',$catID);
              if($check > 0){
                  $stmt = $con->prepare("DELETE FROM categories WHERE categoriesID = ?");
                  $stmt->execute(array($catID));
                  $theMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$stmt->rowCount().' record(s) deleted.</div>';
                  redirectHome($theMsg);

              }
              else {
                  $theMsg= 'فشل الحذف';
                  redirectHome($theMsg);
              }


         }
          include $tpl . 'footer.php';

     } else {
          header('Location: index.php');
          exit();

     }
     ob_end_flush();

?>

