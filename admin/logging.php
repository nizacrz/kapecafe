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
$log->info("User " . $_SESSION['id'] . " connected to Console!")
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
            scroll-behavior: smooth;

            display: flex;
            flex-direction: column-reverse;
        }

        .console>h1 {
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

        .log-log {
            color: #b8b8b8;
        }

        .log-warn {
            color: #bfb349;
        }

        .log-info {
            color: #54a9d1;
        }

        .log-error {
            color: #ad2f2f;
        }

        .log-critical {
            color: #9d1dab;
        }

        .console.light-mode {
            background-color: #ededed;
        }


        .console.light-mode .log-log {
            color: #1f1f1f;
        }

        .console.light-mode .log-warn {
            color: #cf9117;
        }

        .console.light-mode .log-info {
            color: #1653e0;
        }

        .console.light-mode .log-error {
            color: #bf0404;
        }

        .console.light-mode .log-critical {
            color: #ff00bf;
        }

        .display-none {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="/assets/logo/Icon.png" style="display:block; margin-right: auto; margin-left: auto;">
        <p>Kapecafe console v1.0.0</p>
        <div class="console-control">
            <input type="checkbox" id="lightMode" onclick="switchMode()" />
            <p>Light Mode</p>
        </div>
        <div class="console" id="console">
            <?php
            ?>
        </div>
    </div>
    <script>
        setInterval(() => updateConsoleData(), 500);

        function filterData() {
            // Check which of the 4 is checked
            const radioButtons = document.querySelectorAll("inputy[type=radio]");

            radioButtons.forEach((btn) => console.log(btn.value));

            // Get the list of things
            // Filter them
            // Apply those unfiltered with display: none;
        }

        function switchMode() {
            const consoleContainer = document.getElementById("console");
            if (document.getElementById("lightMode").checked) {
                consoleContainer.classList.add("light-mode");
            } else {
                consoleContainer.classList.remove("light-mode");
            }
        }

        function updateConsoleData() {
            fetch('/services/logs.php?request').then(res => res.text()).then(data => {
                const consoleContainer = document.getElementById("console");

                const outputStream = JSON.parse(data)

                // Remove children
                while (consoleContainer.firstChild) {
                    consoleContainer.removeChild(consoleContainer.firstChild);
                }

                // Append new elements
                outputStream.forEach(value => {
                    const outputValue = document.createElement('h1');
                    outputValue.textContent = value;

                    const type = value.split(" ")[0].replace(/[\[\]]/g, '');

                    switch (type) {
                        case "CRITICAL":
                            outputValue.classList.add("log-critical");
                            break;
                        case "ERROR":
                            outputValue.classList.add("log-error");
                            break;
                        case "WARN":
                            outputValue.classList.add("log-warn");
                            break;
                        case "INFO":
                            outputValue.classList.add("log-info");
                            break;
                        default:
                            outputValue.classList.add("log-log");
                            break;
                    }

                    consoleContainer.appendChild(outputValue);
                });
            }).catch(error => {
                console.error("Error fetching log data: ", error);
            });
        }
    </script>
</body>

</html>