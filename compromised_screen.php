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

    // if user is not compromised OR newpass value is not set

    if (!($user->is_compromised == 1 || isset($_SESSION['new_pass']))) {
        header("Location: /index.php");
        die();
    }
} else {
    header("Location: /index.php?err");
    die();
}

if (isset($_SESSION['new_pass'])) {
    $pass = $_SESSION['new_pass'];
    unset($_SESSION['new_pass']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
	 initial-scale=1.0">
    <title>Account Compromised | kapecafé</title>
    <link rel="icon" href="/assets/logo/kapecafé-logo.png">
    <link rel="stylesheet" href="/assets/styles/account-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        .container .button-row {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .container .button-row .btn {
            width: 48%;
            padding: 15px 20px;
            text-align: center;
            border: none;
            background: #6e3d0f;
            outline: none;
            border-radius: 30px;
            font-size: 1.2rem;
            color: #fff;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .container .button-row .btn:hover {
            transform: translateY(-5px);
            background: #6e3d0f;
            text-decoration: none;
        }

        body {
            background-color: #B33A3A;
        }

        .attention {
            color: #B33A3A;
            font-size: 2rem;
            font-weight: 800;
        }
    </style>
</head>

<body>

    <div class="container">
        <center><img src="/assets/logo/Icon.png" </center>

            <div class="alert-container">
                <?php if (isset($pass)) {
                ?>
                    <p class="attention">PASSWORD CHANGED!</p>
                    <center><span class="subtitle">Please take note of your password, this will only appear once.</span></center>
                    <h2><?php echo $pass ?></h2>
                    <div class="button-row" style="display: flex; justify-content: center; align-items:center;">
                        <a href="/index.php" class="btn">Home</a>
                    </div>

                <?php
                } else { ?>
                    <p class="attention">ATTENTION!</p>
                    <center><span class="subtitle">Your account has been compromised. Click the 'Generate New Password' button to receive guidance on creating a secure new password.</span></center>
                    <br>

                    <div class="button-row">
                        <a href="/services/handler.php?set_new_ip" class="btn">Home</a>
                        <a href="/services/handler.php?change_password" class="btn warning">Generate New Password</a>
                    </div>
                <?php } ?>

            </div>

    </div>

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="/assets/scripts/account.js"></script>

</body>

</html>