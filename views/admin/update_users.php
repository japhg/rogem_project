<?php
session_start();
require_once '../../model/connect.php';
require_once '../../model/User.php';

$database = new Database();
$connect = $database->connect();

$User = new User($connect);

if (isset($_SESSION['username'], $_SESSION['password'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../../components/header.php'; ?>
        <title>Training Request</title>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php include '../../components/sidebar.php'; ?>

                <!-- Main page -->
                <div class="layout-page">
                    <?php include '../../components/navbar.php'; ?>

                    <!-- Content -->
                    <div class="content-wrapper">
                        <div class="container">
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <h4 class="text-center">UPDATE USERS</h4>
                                    <hr>

                                    <?php 
                                        $id = $_GET['id'];
                                        $user = $User->getUser($id);
                                        $row = $user->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <form action="../../controller/userController.php" method="POST" class="form-group">
                                        <input type="hidden" name="user_id" value="<?= $row['id']?>">
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" value="<?= $row['username']?>" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" value="<?= $row['firstname']?>" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Middlename</label>
                                            <input type="text" name="middlename" class="form-control" value="<?= $row['middlename']?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" value="<?= $row['lastname']?>" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Email Address</label>
                                            <input type="email" name="email_address" class="form-control" value="<?= $row['email_address']?>" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="" class="form-label">User Type</label>
                                            <select name="user_type" id="user_type" class="form-select" required>
                                                <option value="<?= $row['user_type']?>" selected ><?= $row['user_type']?></option>
                                                <option value="SUPER ADMIN">SUPER ADMIN</option>
                                                <option value="ADMIN">ADMIN</option>
                                                <option value="STAFF">STAFF</option>
                                                <option value="USER">USER</option>
                                            </select>
                                        </div>


                                        <div class="col-md-12 mt-5 mb-3 text-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="update_users_btn" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../../components/footer.php'; ?>

    </body>

    </html>
<?php } else {

    header("Location: ../../index.php");
    exit(0);
} ?>