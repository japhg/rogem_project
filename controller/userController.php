<?php
session_start();
require_once '../model/connect.php';
require_once '../model/User.php';
require_once '../Helpers/checker.php';


$database = new Database();
$connect = $database->connect();
$User = new User($connect);
$Check = new Check($connect);

/*
|--------------------------------------------------------------------------
| USER LOGIN
|--------------------------------------------------------------------------
| Here is where you can process the user's credentials to login 
| into their account. 
|--------------------------------------------------------------------------
*/
if (isset($_POST['login-submit'])) {
    $User->username = $_POST['username'];
    $password = $_POST['password'];
    $count = $_POST['count'];

    $stmt = $User->login();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            switch ($row['user_type']) {
                case "USER":
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['email'] = $row['email_address'];
                    $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];

                    // Save the logs
                    $logs = $User->logs($_SESSION['username'], $name, $_SESSION['user_type'], $count);
                    header("Location: ../views/training/index.php");
                    $_SESSION['successMessage'] = "Welcome, " . $row['firstname'];
                    break;

                case "SUPER ADMIN":
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['email'] = $row['email_address'];

                    $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    // Save the logs
                    $logs = $User->logs($_SESSION['username'], $name, $_SESSION['user_type'], $count);

                    $_SESSION['successMessage'] = "Welcome, Admin " . $row['firstname'];
                    header("Location: ../views/admin/index.php");
                    break;


                case "ADMIN":
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['email'] = $row['email_address'];

                    $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    // Save the logs
                    $logs = $User->logs($_SESSION['username'], $name, $_SESSION['user_type'], $count);

                    $_SESSION['successMessage'] = "Welcome, Admin " . $row['firstname'];
                    header("Location: ../views/admin/index.php");
                    break;

                case "STAFF":
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['email'] = $row['email_address'];

                    $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    // Save the logs
                    $logs = $User->logs($_SESSION['username'], $name, $_SESSION['user_type'], $count);

                    $_SESSION['successMessage'] = "Welcome, " . $row['firstname'];
                    header("Location: ../views/admin/index.php");
                    break;
                default:
                    $_SESSION['errorMessage'] = "Wrong username or password";
                    header("Location: ../index.php");
                    break;
            }
        } else {
            $_SESSION['errorMessage'] = "Wrong username or password";
            header("Location: ../index.php");
            exit(0);
        }
    } else {
        $_SESSION['errorMessage'] = "No user found";
        header("Location: ../index.php");
        exit(0);
    }
}


/*
|--------------------------------------------------------------------------
| USER REGISTRATION
|--------------------------------------------------------------------------
| Here is where the users can register their account. 
|--------------------------------------------------------------------------
*/

if (isset($_POST['register_btn'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email_address = $_POST['email_address'];

    $data = [
        'username' => $username,
        'password' => $password,
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'email_address' => $email_address,
    ];

    if ($Check->username($username) === true) {
        if ($Check->email($email_address) === true) {
            $insert = $User->register($data);

            if ($insert) {
                $_SESSION['successMessage'] = "Successfully Registered";
            } else {
                $_SESSION['errorMessage'] = "Error";
            }
        } else {
            $_SESSION['errorMessage'] = "Email is already exist";
        }
    } else {
        $_SESSION['errorMessage'] = "Username is already exist";
    }

    header('location: ../index.php');
    exit(0);
}


/*
|--------------------------------------------------------------------------
| USER REGISTRATION - SUPER ADMIN PART
|--------------------------------------------------------------------------
| Here is where the Super Admin can add users for their accounts. 
|--------------------------------------------------------------------------
*/

if (isset($_POST['add_users_btn'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email_address = $_POST['email_address'];
    $user_type = $_POST['user_type'];

    $data = [
        'username' => $username,
        'password' => $password,
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'email_address' => $email_address,
        'user_type' => $user_type,
    ];

    if ($Check->username($username) === true) {
        if ($Check->email($email_address) === true) {
            $insert = $User->addUsers($data);

            if ($insert) {
                $_SESSION['successMessage'] = "Successfully Added";
            } else {
                $_SESSION['errorMessage'] = "Error";
            }
        } else {
            $_SESSION['errorMessage'] = "Email is already exist";
        }
    } else {
        $_SESSION['errorMessage'] = "Username is already exist";
    }

    header('location: ../views/admin/users.php');
    exit(0);
}

/*
|--------------------------------------------------------------------------
| USER UPDATE - SUPER ADMIN PART
|--------------------------------------------------------------------------
| Here is where the Super Admin can update users. 
|--------------------------------------------------------------------------
*/

if (isset($_POST['update_users_btn'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email_address = $_POST['email_address'];
    $user_type = $_POST['user_type'];

    $data = [
        'user_id' => $user_id,
        'username' => $username,
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'email_address' => $email_address,
        'user_type' => $user_type,
    ];

    $insert = $User->updateUser($data);

    if ($insert) {
        $_SESSION['successMessage'] = "Successfully Updated";
    } else {
        $_SESSION['errorMessage'] = "Error";
    }

    header('location: ../views/admin/users.php');
    exit(0);
}