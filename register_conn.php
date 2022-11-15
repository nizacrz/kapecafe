<?php
session_start();
include "config.php";

if (isset($_POST["createAccount"])) {

    // Set variables
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = "User";


    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);

    if (empty($username)) {
        header("Location: signup.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: signup.php?error=Password is required");
        exit();
    } else if (empty($email)) {
        header("Location: signup.php?error=Email is required");
        exit();
    } else {
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

        if (mysqli_num_rows($result) >0) {
            header("Location: signup.php?error=User already exists!");
            exit();
        } else {
            $sql2 = "INSERT INTO users(first_name, last_name, username, email, password, role) VALUES('$first_name', '$last_name', '$username', '$email','$password','$role')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: signin.php?success=Your account has been created successfully!");
                exit();
            } else {
                header("Location: signup.php?error=Unknown error occurred");
                exit();
            }
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
