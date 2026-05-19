<?php
    ob_start();
    session_start();

    if (isset($_SESSION['username'])) {
        $pageTitle = 'Members';
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
        if ($do == 'manage') {
            $query = "";
            if (isset($_GET['page']) && $_GET['page'] == 'pending') {
                $query = 'where regStatus=0';

            }
            $stmt = $con->prepare("SELECT * FROM users $query");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            ?>
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-dark shadow-sm rounded-4 border-start border-4 border-warning">
                    <h2 class="h4 mb-0 text-white fw-bold">
                        <i class="bi bi-shield-lock-fill me-2 text-warning"></i>
                        Member Management <span class="badge bg-warning text-dark ms-2 fs-6">Admin Panel</span>
                    </h2>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <a href="members.php?do=add" class="btn btn-warning btn-sm px-4 fw-bold rounded-pill shadow-sm">
                        <i class="bi bi-person-plus-fill me-1"></i> Add New
                    </a>
                </div>

                <div class="card bg-secondary bg-opacity-10 border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle mb-0 text-center">
                            <thead class="table-warning">
                            <tr>
                                <th class="py-3 fw-bold border-0 text-dark">ID</th>
                                <th class="py-3 fw-bold border-0 text-dark">User Name</th>
                                <th class="py-3 fw-bold border-0 text-dark">password</th>
                                <th class="py-3 fw-bold border-0 text-dark">Email Address</th>
                                <th class="py-3 fw-bold border-0 text-dark">Full Name</th>
                                <th class="py-3 fw-bold border-0 text-dark">Date</th>
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
                                                        class="text-warning"></span><?php echo $raw['userID']; ?></td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-2"
                                                         style="width: 30px; height: 30px;">
                                                        <i class="bi bi-person-fill"></i>
                                                    </div>
                                                    <span class="fw-semibold"><?php echo $raw['userName']; ?></span>
                                                </div>
                                            </td>
                                            <td class="text-info"><?php echo $raw['password']; ?></td>
                                            <td class="text-info"><?php echo $raw['gmail']; ?></td>
                                            <td class="text-light opacity-100"><?php echo $raw['fullname']; ?></td>
                                            <td class="text-light opacity-25"><?php echo $raw['Date']; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="members.php?do=edit&userID=<?php echo $raw['userID']; ?>"
                                                       class="btn btn-info btn-sm text-white fw-bold rounded-3 shadow-sm px-3">
                                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                                    </a>
                                                    <a href="members.php?do=delete&userID=<?php echo $raw['userID']; ?>"
                                                       class="btn btn-danger btn-sm fw-bold rounded-3 shadow-sm px-3 confirm">
                                                        <i class="bi bi-trash3-fill me-1"></i>delete
                                                    </a>
                                                    <a>
                                                        <?php
                                                            if (!($raw['regStatus'] === 1)) {
                                                                echo "<a 
                                                                    href='members.php?do=activate&userID=" . $raw['userID'] . "' 
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
                                    echo "<tr><td colspan='6' class='p-4 text-white'>No Members Found</td></tr>";
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
                <i class="bi bi-person-gear me-2"></i>Add Member
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
                                        <input type="text" name="username" id="username"
                                               class="form-control border-start-0 rounded-end-3"
                                               placeholder="Enter username" autocomplete="off" >
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                    class="bi bi-lock-fill"></i></span>
                                        <input type="password" name="password" id="password"
                                               class="form-control border-start-0 rounded-end-3"
                                               placeholder="Enter password" autocomplete="new-password" >
                                        <button class="btn btn-outline-secondary border-start-0 rounded-end-3"
                                                type="button" id="togglePass">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                    class="bi bi-envelope-fill"></i></span>
                                        <input type="email" name="gmail" id="email"
                                               class="form-control border-start-0 rounded-end-3"
                                               placeholder="name@example.com" >
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                    class="bi bi-person-badge-fill"></i></span>
                                        <input type="text" name="full" id="full"
                                               class="form-control border-start-0 rounded-end-3"
                                               placeholder="Enter full name" >
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                            <i class="bi bi-check-lg me-1"></i> Save Member
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('togglePass').addEventListener('click', function () {
                    const passInput = document.getElementById('password');
                    const icon = this.querySelector('i');
                    if (passInput.type === 'password') {
                        passInput.type = 'text';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                    } else {
                        passInput.type = 'password';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                    }
                });
            </script>
            <?php
        } // --- صفحة الإدخال في القاعدة ---
        elseif ($do == 'insert') {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo '<div class="container mt-5 text-center"><h1>Insert Member</h1>';

                $user = $_POST['username'];
                $pass = $_POST['password'];
                $mail = $_POST['gmail'];
                $full = $_POST['full'];

                $formErrors = array();

                // 1. التحقق من الحقول الفارغة
                if (strlen($user) < 4) {
                    $formErrors[] = "Username is too short";
                }
                if (strlen($user) > 20) {
                    $formErrors[] = "Username is bag short";
                }
                if (empty($user)) {
                    $formErrors[] = "<strong>empty</strong>";
                }
                if (empty($pass)) {
                    $formErrors[] = "Password empty short";
                }
                if (empty($mail)) {
                    $formErrors[] = "Email empty short";
                }
                if (empty($full)) {
                    $formErrors[] = "Full name is too short";
                }
                $check = checkItem('userName', 'users', $user);

                // فحص اسم المستخدم
                if ($check == 1) {
                    $formErrors[] = 'عذراً، <strong>اسم المستخدم</strong> هذا موجود بالفعل.';
                }


                foreach ($formErrors as $error) {
                    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                }

                if (empty($formErrors)) {

                    $stmt = $con->prepare("INSERT INTO users (userName, password, gmail, fullname,regStatus, Date) VALUES (?, ?, ?, ?,1, NOW())");
                    $stmt->execute(array($user, $pass, $mail, $full,));
                    echo '<div class="alert alert-success mt-3">' . $stmt->rowCount() . ' Record Inserted</div>';

                }


            } else {
                $theMsg = '<div class="alert alert-danger">لا يمكنك تصفح هذه الصفحة مباشرة</div>';
                redirectHome($theMsg);
            }
        } // --- صفحة التعديل ---
        elseif ($do == 'edit') {
            $userID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;
            $stmt = $con->prepare("SELECT * FROM users WHERE userID = ? LIMIT 1");
            $stmt->execute(array($userID));
            $rowUser = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($stmt->rowCount() > 0) { ?>
                <h1 class="text-center mb-4 fw-bold mt-5"><i class="bi bi-person-gear me-2"></i>Edit Member</h1>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7 col-lg-5">
                            <div class="card shadow-sm border-0 rounded-4">
                                <div class="card-body p-4">
                                    <form class="form-horizontal" action="?do=Update" method="post">
                                        <input type="hidden" name="userid" value="<?php echo $rowUser['userID']; ?>">
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                        class="bi bi-at"></i></span>
                                            <input type="text" name="username" id="username"
                                                   class="form-control border-start-0 rounded-end-3"
                                                   value="<?php echo $rowUser['userName'] ?>"
                                                   placeholder="Enter  username" autocomplete="off" required>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                        class="bi bi-lock-fill"></i></span>
                                            <input type="password" name="password" id="password"
                                                   value="<?php echo $rowUser['password'] ?>"
                                                   class="form-control border-start-0 rounded-end-3"
                                                   placeholder="Enter password" autocomplete="new-password" required">
                                            <button class="btn btn-outline-secondary border-start-0 rounded-end-3"
                                                    type="button" id="togglePass">
                                                <i class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                        class="bi bi-envelope-fill"></i></span>
                                            <input type="email" name="gmail" id="email"
                                                   value="<?php echo $rowUser['gmail'] ?>"
                                                   class="form-control border-start-0 rounded-end-3"
                                                   placeholder="name@example.com" required>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <span class="input-group-text bg-body-secondary border-end-0 rounded-start-3"><i
                                                        class="bi bi-person-badge-fill"></i></span>
                                            <input type="text" name="full" id="full"
                                                   value="<?php echo $rowUser['fullname'] ?>"
                                                   class="form-control border-start-0 rounded-end-3"
                                                   placeholder="Enter full name" required>
                                        </div>
                                        <div class="d-grid mt-4">
                                            <button type="submit" class="btn btn-primary btn-sm rounded-3 py-2">
                                                <i class="bi bi-check-lg me-1"></i> Save Member
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById('togglePass').addEventListener('click', function () {
                        const passInput = document.getElementById('password');
                        const icon = this.querySelector('i');
                        if (passInput.type === 'password') {
                            passInput.type = 'text';
                            icon.classList.replace('bi-eye-slash', 'bi-eye');
                        } else {
                            passInput.type = 'password';
                            icon.classList.replace('bi-eye', 'bi-eye-slash');
                        }
                    });
                </script>
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

                $id = $_POST['userid'];
                $user = $_POST['username'];
                $pass = $_POST['password'];
                $mail = $_POST['gmail'];
                $full = $_POST['full'];
                $stmt = $con->prepare("UPDATE users SET userName = ?,password=?, gmail = ?, fullname = ? WHERE userID = ?");
                $stmt->execute(array($user, $pass, $mail, $full, $id));
                echo '<div class="container mt-5 text-center"><div class="alert alert-success">Record Updated</div></div>';
            } else {
                $theMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"> sorry you cant browse this page directly</div>';
                redirectHome($theMsg, 'back');
            }
        } // --- تنفيذ الحذف ---
        elseif ($do == 'delete') {
            $userID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;
            $check=checkItem('userID','users',$userID);
           if($check >0){
               $stmt = $con->prepare("DELETE FROM users WHERE userID=?");
               $stmt->bindParam('user', $userID);
               $stmt->execute(array($userID));
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
            $userID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;
            $check=checkItem('userID','users',$userID);
           if($check >0){
               $stmt = $con->prepare("update users set regStatus  = 1  WHERE userID=?");
               $stmt->execute(array($userID));
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