<?php
include_once './services/config/Database.php';
include_once './services/models/User.php';


session_start();

$user;

if (isset($_SESSION['id'])) {
    $user = new User(Database::connect());
    $user->id = intval($_SESSION['id']);
    $user->read_single();

    if (isset($user->username)) {
        header("Location: /index.php");
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
         initial-scale=1.0">
    <title>Create an Account | kapecafé</title>
    <link rel="icon" href="/assets/logo/kapecafé-logo.png">
    <link rel="stylesheet" href="/assets/styles/account-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>

    <div class="container">


        <center><img src="assets/logo/Icon.png" </center>

            <form action="/services/handler.php" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 750;">Create a kapecafé account</p>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="fail"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                <div class="input-group">
                    <input type="text" required placeholder="first name" name="first_name">
                </div>
                <div class="input-group">
                    <input type="text" required placeholder="last name" name="last_name">
                </div>
                <div class="input-group">
                    <input type="text" required placeholder="username" name="username">
                </div>
                <div class="input-group">
                    <input type="email" required placeholder="email" name="email">
                </div>
                <div class="input-group">
                    <input type="password" id="password" required placeholder="password" name="password" pattern="(?=.*\d)(?=.*[\W_]).{7,}" title="Minimum of 7 characters. Should have at least one special character and one number.">
                    <i class="fa-regular fa-eye-slash" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                </div>

                <div class="input-group">
                    <button name="createAccount" class="btn">Create Account</button>
                </div>
                <center><span class="subtitle"> Already have an account? <a href="signin.php">Log In</a> </span> </center>

            </form>
    </div>
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/assets/scripts/account.js"></script>

</body>

</html>