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
                                    <h4 class="text-center">USERS</h4>
                                    <hr>

                                    <div class="container mb-4">
                                        <butt class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addUserModal">Add User</button>
                                    </div>

                                    <table class="table table-sm" id="example">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Role</th>
                                                <th>Date Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $users = $User->getAllUsers();
                                            while ($row = $users->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                    <td><?= $row['username'] ?></td>
                                                    <td><?= $row['firstname'] . " " . $row['lastname'] ?></td>
                                                    <td><?= $row['email_address'] ?></td>
                                                    <td><?= $row['user_type'] ?></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td>
                                                        <a href="update_users.php?id=<?php echo $row['id']?>" class="btn btn-success btn-sm">Edit</a>
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <!-- Modal for Adding Users -->
                                    <div class="modal fade" id="addUserModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <form action="../../controller/userController.php" method="POST"
                                                            class="form-group">

                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Username</label>
                                                                <input type="text" name="username" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Password</label>
                                                                <input type="password" name="password" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Firstname</label>
                                                                <input type="text" name="firstname" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Middlename</label>
                                                                <input type="text" name="middlename" class="form-control">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Lastname</label>
                                                                <input type="text" name="lastname" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Email Address</label>
                                                                <input type="email" name="email_address"
                                                                    class="form-control" required>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Email Address</label>
                                                                <select name="user_type" id="user_type" class="form-select" required>
                                                                    <option value="" selected disabled>Select User Type</option>
                                                                    <option value="SUPER ADMIN">SUPER ADMIN</option>
                                                                    <option value="ADMIN">ADMIN</option>
                                                                    <option value="STAFF">STAFF</option>
                                                                    <option value="USER">USER</option>
                                                                </select>
                                                            </div>


                                                            <div class="col-md-12 mt-5 mb-3 text-center">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="add_users_btn"
                                                                    class="btn btn-primary">Add</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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