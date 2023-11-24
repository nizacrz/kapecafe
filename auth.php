<?php
include_once './services/config/Database.php';
include_once './services/models/User.php';
include_once './services/utils/totp_generator.php';

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


    // If user has no auth_key..
    if ($user->auth_key !== NULL && $user->is_compromised === 0) {
        header("Location: /index.php?rekt");
        die();
    }
} else {
    header("Location: /index.php?rip");
    die();
}



$otp = new TOTPGenerator();

// Make the new IP Address Permanent
if (!($user->is_compromised && $user->auth_key !== NULL)) {
    // This is probably a new account
    // Generate OTP code
    if (isset($_SESSION['otp_key'])) {
        $user->auth_key = $_SESSION['otp_key'];
        echo $_SESSION['otp_key'];
        die();
    } else {
        $user->auth_key = $otp->generateSecretKey();
        $_SESSION['otp_key'] = $user->auth_key;
    }

    // Generate URL For authenticator
    $otp_url = $otp->generateQRCodeUrl($user->username, $user->auth_key);
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
                <?php
                if (isset($otp_url)) {
                ?>
                    <center><span class="subtitle">Please scan the QR Code using an authenticator app and then input the otp code!</span></center>

                    <img src='<?php echo $otp->generateQRCodeImage(urlencode($otp_url)); ?>' alt="Scan with Authenticator App">
                <?php } else { ?>
                    <center><span class="subtitle">New Location: Please input the code from your 2fa app!</span></center>
                <?php } ?>
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