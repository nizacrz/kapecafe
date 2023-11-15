<?php
# SSE powered console which means 1 way and stuff..

# Logging will also be divided into various types
# 1. Information - I logged on. I logged off.
# 2. Warning - Oi, m8, something doesn't seem correct.
# 3. Error - thats rough, buddy.
# 4. Critical - ENNN ENNN EN NN ENNN, UR ACCOUNT NOW LOCKED GRRR

include_once '../shared/general.php';
include_once '../services/config/Database.php';
include_once '../services/models/User.php';
include_once '../services/models/Product.php';
include_once "../services/utils/logger.php";

session_start();

/**
 * Get ID from session data. This proves user authentication
 */
if (isset($_SESSION['id'])) {
    // Resolve User Information
    $user = new User(Database::connect());
    $user->id = intval($_SESSION['id']);
    $user->read_single();

    // In case user is not an admin
    if ($user->role !== "Admin") {
        http_response_code(401); // Unauthorized
        include_once('../services/utils/error.php');
        exit();
    }
} else {
    http_response_code(401); // Unauthorized
    include_once('../services/utils/error.php');
    die();
}

// Initialize Singleton and Change outloader to HTML
$log = Log::getinstance();
$log->log("User " . $_SESSION['id'] . " connected to Console!")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
	 initial-scale=1.0">
    <title>Logging | kapecafé</title>
    <link rel="icon" href="/assets/logo/kapecafé-logo.png">
    <link rel="stylesheet" href="/assets/styles/account-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap');

        .container {
            width: 80%;
        }

        .console {
            background-color: black;
            width: 100%;
            height: 500px;
            overflow-y: scroll;
        }

        .console>h1 {
            color: rgb(200, 200, 200);
            display: block;
            font-size: 20px;
            font-weight: 500;
            font-family: 'Roboto Mono', monospace;
        }

        .console-control {
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .console-control input {
            margin-right: 5px;
            width: 17px;
            height: 17px;

            justify-self: center;
            align-self: center;
        }

        .console-control p {
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="/assets/logo/Icon.png" style="display:block; margin-right: auto; margin-left: auto;">
        <p>Kapecafe console v1.0.0</p>
        <div class="console-control">
            <input type="checkbox" />
            <p>Scroll on new line</p>
            <input type="checkbox" />
            <p>Green</p>
            <input type="radio" name="listen" value="log" checked>
            <p>Log</p>
            <input type="radio" name="listen" value="warn">
            <p>Warn</p>
            <input type="radio" name="listen" value="error">
            <p>Error</p>
            <input type="radio" name="listen" value="critical">
            <p>Critical</p>
        </div>
        <div class="console" id="console">
            <?php
            ?>
        </div>
    </div>
    <script>
        // setInterval(updateConsoleData, 500);

        function updateConsoleData() {
            fetch('/services/logs.php?request&lines=50').then(res => res.text()).then(data => {
                const consoleContainer = document.getElementById("console");

                const outputStream = JSON.parse(data)

                for (dataValue in outputStream) {
                    const outputValue = document.createElement('h1');
                    outputValue.textContent = outputStream[dataValue];

                    consoleContainer.appendChild(outputValue);
                }
                console.log(data);
            }).catch(error => {
                console.error("Error fetching log data: ", error);
            });
        }
    </script>
</body>

</html>