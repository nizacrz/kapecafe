<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/services/config/Database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/models/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/string.php';

session_start();

$db = new Database();
$conn = $db->connect();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = new User($conn);
}

if (isset($_POST["createAccount"])) {
    // Set variables
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->role = "User";

    // Server side validation
    /**
     * TODO: Add a function that validates the data again based on the frontend validation.
     */


    // Check for duplicates
    if ($user->find_by_username()) {
        header("Location: /signup.php?error=User already exists!");
        die();
    } else {
        $result = $user->create();

        if ($result) {
            $_SESSION['user'] = $user;
            header("Location: /signup.php?success=Your account has been created successfully!");
            die();
        } else {
            header("Location: /signup.php?error=An Unknown error occured!");
            die();
        }
    }
} else if (isset($_GET['login'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Server side validation
        /**
         * TODO: Add a function that validates the data again based on the frontend validation.
         */

        $user->username = $_POST['username'];
        $user->password = $_POST['password'];

        if ($user->login()) {
            $_SESSION['user'] = $user;
            if ($user->role === "Admin") {
                header('Location: /admin/product_maintenance.php');
                die();
            } else {
                header('Location: /index.php');
                die();
            }
        } else {
            header("Location: /signin.php?error=Invalid username or password! Please try again.");
            exit();
        }
    } else {
        header("Location: /signin.php?error=An unknown error has occurred.");
    }
} else if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location: /index.php");
    die();
}
header("location: /index.php");
