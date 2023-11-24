<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/services/config/Database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/models/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/string.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/totp_generator.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/ip.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/utils/logger.php';

session_start();

$conn = Database::connect();
$log = Log::getinstance();

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

    $user->remote_address = isset($_SERVER['HTTP_CLIENT_IP'])
        ? $_SERVER['HTTP_CLIENT_IP']
        : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : $_SERVER['REMOTE_ADDR']);

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
            $_SESSION['id'] = $user->id;
            $log->info("User created with id: " . $user->id);

            // TODO: Send email for 2fa process

            header("Location: /auth.php");
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

        $ip = isset($_SERVER['HTTP_CLIENT_IP'])
            ? $_SERVER['HTTP_CLIENT_IP']
            : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                ? $_SERVER['HTTP_X_FORWARDED_FOR']
                : $_SERVER['REMOTE_ADDR']);
        $ip = Str::sanitizeIP($ip);

        if (isset($_SESSION['logon_time'])) {
            if (time() > $_SESSION['logon_time']) {
                unset($_SESSION['logon_time']);
                unset($_SESSION['logon_attempt']);
            } else {
                header("Location: /signin.php?error=Login Timeout. Please wait..");
                exit();
            }
        }

        if ($user->login()) {
            if (isset($_SESSION['logon_time'])) {
                unset($_SESSION['logon_time']);
            }
            if (isset($_SESSION['logon_attempt'])) {
                unset($_SESSION['logon_attempt']);
            }

            $_SESSION['id'] = $user->id;

            if ($ip !== $user->remote_address) {
                if ($user->role === "Admin") {
                    $log->critical("@AdminAddressMismatch: Admin logged in with id: " . $user->id . ", remote: " . $ip . ", recorded: " . $user->remote_address);

                    // Protocol for Potentially Compromised Account
                    $user->is_compromised = 1;
                    $user->remote_address = $ip;
                    $user->set_is_compromised();
                } else {
                    $log->warn("@AddressMismatch: User logged in with id: " . $user->id . ", remote: " . $ip . ", recorded: " . $user->remote_address);

                    // Protocol for Potentially Compromised Account
                    $user->is_compromised = 1;
                    $user->remote_address = $ip;
                    $user->set_is_compromised();
                }
                header('Location: /auth.php');
                die();
            } else {
                $log->info("User logged in the id: " . $user->id . ", Address: " . $ip);
            }
            if ($user->role === "Admin") {
                header('Location: /admin/maintenance.php');
                die();
            } else {
                if ($user->is_complete_auth === 1) {
                    header('Location: /index.php?successful');
                } else {
                    header('Location: /auth.php');
                }
                die();
            }
        } else {
            $ip = isset($_SERVER['HTTP_CLIENT_IP'])
                ? $_SERVER['HTTP_CLIENT_IP']
                : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                    ? $_SERVER['HTTP_X_FORWARDED_FOR']
                    : $_SERVER['REMOTE_ADDR']);

            if (!isset($_SESSION['logon_attempt'])) {
                $_SESSION['logon_attempt'] = 1;
                header("Location: /signin.php?error=Invalid username or password! Please try again.");
            } else {
                if ($_SESSION['logon_attempt'] > 5) {
                    if (!isset($_SESSION['logon_time'])) {
                        $_SESSION['logon_time'] = time() + 30;
                        header("Location: /signin.php?error=Login Timeout. Please wait..");
                    } else {
                        if (time() > $_SESSION['logon_time']) {
                            unset($_SESSION['logon_time']);
                            unset($_SESSION['logon_attempt']);
                            header("Location: /signin.php?error=Invalid username or password! Please try again.");
                        } else {
                            header("Location: /signin.php?error=Login Timeout. Please wait..");
                        }
                    }
                } else {
                    $_SESSION['logon_attempt']++;
                    header("Location: /signin.php?error=Invalid username or password! Please try again.");
                }
            }
            exit();
        }
    } else {
        header("Location: /signin.php?error=An unknown error has occurred.");
    }
} else if (isset($_GET['auth'])) {

    if (isset($_SESSION['id'])) {
        $user = new User(Database::connect());
        $user->id = intval($_SESSION['id']);
        $user->read_single();
    } else {
        header("Location: /index.php?rejected");
        die();
    }

    // New account
    if (isset($_SESSION['otp_key'])) {

        // Get POST
        $input = trim($_POST['code']);

        // Check if code is numeric and sized 6
        if (!is_string($input) || empty($input) || !ctype_digit($input) || strlen($input) !== 6) {
            header("Location: /auth.php?err=Input Error");
            die();
        }

        $otp = new TOTPGenerator();

        // VERIFY POST again
        $otp_key = $otp->generateTOTP($_SESSION['otp_key']);

        if ($input !== $otp_key) {
            header("Location: /auth.php?err=Wrong Code");
            die();
        }

        // TODO: STARTHERE
        $user->auth_key = $_SESSION['otp_key'];
        $user->is_complete_auth = 1;

        $user->set_is_complete_auth();

        // IF SUCCESSFUL, DELETE SESSION OTP
        unset($_SESSION['otp_key']);
        header("Location: /index.php?otpaccepted");
        die();
    } else {
        // Existing account.
        if (isset($_POST['code']) && $user->auth_key !== NULL) {

            $input = trim($_POST['code']);

            // Check if code is numeric and sized 6
            if (!is_string($input) || empty($input) || !ctype_digit($input) || strlen($input) !== 6) {
                header("Location: /auth.php?err=Input Error");
                die();
            }

            $otp = new TOTPGenerator();

            // VERIFY POST again
            $otp_key = $otp->generateTOTP($user->auth_key);

            if ($input !== $otp_key) {
                // Dead Code
                if (isset($_SESSION['new_ip'])) {
                    $user->is_compromised = 1;
                    $user->set_is_compromised();
                }
                header("Location: /auth.php?err=Wrong Code");
                die();
            }

            if ($user->is_compromised) {
                header("Location: /compromised_screen.php");
                die();
            } else {
                $ip = isset($_SERVER['HTTP_CLIENT_IP'])
                    ? $_SERVER['HTTP_CLIENT_IP']
                    : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                        ? $_SERVER['HTTP_X_FORWARDED_FOR']
                        : $_SERVER['REMOTE_ADDR']);

                $user->remote_address = $ip;
                $user->set_new_ip();
                header("Location: /index.php?ipchanged");
                die();
            }
        } else {
            header("Location: /auth.php");
            die();
        }
    }
} else if (isset($_GET['change_password'])) {
    if (isset($_SESSION['id'])) {
        $user = new User(Database::connect());
        $user->id = intval($_SESSION['id']);
        $user->read_single();
    } else {
        header("Location: /index.php?passchange");
        die();
    }

    $_SESSION['new_pass'] = Str::generatePassword();
    $user->password = $_SESSION['new_pass'];

    // Store it on database
    $user->set_password();

    $ip = isset($_SERVER['HTTP_CLIENT_IP'])
        ? $_SERVER['HTTP_CLIENT_IP']
        : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : $_SERVER['REMOTE_ADDR']);

    // Turn off is_compromised
    $user->is_compromised = 0;
    $user->remote_address = $ip;

    $user->set_is_compromised();
    $user->set_new_ip();

    header("Location: /compromised_screen.php");
    die();
} else if (isset($_GET['set_new_ip'])) {
    if (isset($_SESSION['id'])) {
        $user = new User(Database::connect());
        $user->id = intval($_SESSION['id']);
        $user->read_single();
    } else {
        header("Location: /index.php?ipnotset");
        die();
    }
    // Set new ip
    $ip = isset($_SERVER['HTTP_CLIENT_IP'])
        ? $_SERVER['HTTP_CLIENT_IP']
        : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : $_SERVER['REMOTE_ADDR']);

    // Turn off is_compromised
    $user->is_compromised = 0;
    $user->remote_address = $ip;

    $user->set_is_compromised();
    $user->set_new_ip();

    // go home
    header("location: /index.php?ipset");
    die();
} else if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location: /index.php?loggedout");
    die();
}
header("location: /index.php?unknown");
