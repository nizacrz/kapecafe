<?php

# /admin/logging.php will listen to this file.

include_once '../services/config/Database.php';
include_once '../services/models/User.php';

session_start();

class SSEHandler
{
    public function sendSSEMessage($data)
    {
        // Save the message to a shared resource
        file_put_contents('../logs.txt', $data . PHP_EOL, FILE_APPEND);
    }

    public function handleSSE()
    {
        // Function temporarily disabled
        header('HTTP/1.1 403 Forbidden');
        exit;
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        if (!$this->isValidSession()) {
            header('HTTP/1.1 501 Not Implemented');
            exit;
        }

        set_time_limit(0);

        $startTime = time();

        while (true) {
            if (connection_aborted() || (time() - $startTime) > 600) {
                exit;
            }

            $messages = file('../logs.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($messages as $message) {
                echo "data: $message\n\n";
                @ob_flush();
                @flush();
            }

            // Sleep for a short duration to avoid high CPU usage
            sleep(3);
        }
    }

    public function isValidSession()
    {
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
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

    public function getLogData($numberOfLines = 100)
    {
        // Read the first x lines of the log file
        $logFile = file('../logs.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


        // Ensure startAtLine is within the bounds of the file
        $linesToSend = array_slice(array_reverse($logFile), 0, $numberOfLines);

        // Prepare the response as a JSON object
        $response = json_encode($linesToSend);

        // Set appropriate headers for JSON response
        header('Content-Type: application/json');
        header('Cache-Control: no-cache');

        // Output the JSON response
        echo $response;
    }
}

if (isset($_GET['request'])) {
    $sse = new SSEHandler();
    $numberOfLines = isset($_GET['lines']) ? max(1, intval($_GET['lines'])) : 100;
    $sse->getLogData($numberOfLines);
}
