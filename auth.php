<?php
include_once './services/config/Database.php';
include_once './services/models/User.php';

/**
 * WARN: This uses HTML4 Tags 🚩
 */

session_start();

$user;

/**
 * If session ID exists then the user is signed in and the application
 * will reroute to index.php
 */
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
    <title>Sign in | kapecafé</title>
    <link rel="icon" href="/assets/logo/kapecafé-logo.png">
    <link rel="stylesheet" href="/assets/styles/account-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <center><img src="/assets/logo/Icon.png" </center>

            <form action="/services/handler.php?auth" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Two-factor Authentication</p>
                <center><span class="subtitle">Please input the 2fa code we emailed you!</span></center>
                <br>
                <div class="input-group">
                    <input type="text" required placeholder="code" name="code">
                </div>

                <div class="input-group">
                    <button name="submit" class="btn" value="register now">Confirm</button>
                </div>
            </form>
    </div>

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/assets/scripts/account.js"></script>

</body>

</html>