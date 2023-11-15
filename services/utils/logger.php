<?php

# 1. Implement the singleton Design principle..
# 2. Implement the various levels for Logging (INFO, WARN, ERROR, CRITICAL)
# 3. Propagate usage to all codes that use SSE.

class LogStatus
{
    const LOG = 'LOG';
    const WARN = 'WARN';
    const ERROR = "ERROR";
    const CRITICAL = "CRITICAL";
}

class Log
{

    private static $instance;

    /**
     * The outloader sets the type of logging semantics performed by this class
     * 
     * LOG means that the log will occur at text level without any formatting.
     * HTML means that the log will output an HTML element based on the $wrapper's value
     */
    private $outloader = "LOG";

    /**
     * Checks whether the logs should be written to a file or echoed instead.
     * 
     * This will most likely not get implemented since echo logging will require a
     * subimplementation of SSE, Websockets, or anything that requires an established
     * or sustained connection to the server.
     */
    private $logToFile = true;

    /**
     * The wrapper serves as the wrapping element for the implementation of the HTML logging semantics.
     * 
     * The $ will be replaced by the data.
     */
    private $wrapper = "<h1>$</h1>";

    protected function __construct()
    {
    }

    function __clone()
    {
    }

    function __wakeup()
    {
        throw new Exception("This class is a singleton");
    }

    public static function getinstance(): Log
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    function changeOutloader()
    {
        $this->outloader = $this->outloader === "LOG" ? "HTML" : "LOG";
    }

    function changeWrapper($input)
    {
        $wrapper = $input;
    }

    function log($message, $type = LogStatus::LOG): string
    {
        $output = "[" . $type . "] " . date("m-d-Y H:i:s") . ": " . $message;

        if ($this->logToFile && $this->outloader == "LOG") {
            // Save the message
            file_put_contents('../logs.txt', $output . PHP_EOL, FILE_APPEND);
        }

        return $this->outloader === "LOG" ? $output : str_replace("$", $output, $this->wrapper);
    }

    function warn($message): string
    {
        return log($message, LogStatus::WARN);
    }

    function err($message): string
    {
        return log($message, LogStatus::ERROR);
    }

    function critical($message): string
    {
        return log($message, LogStatus::CRITICAL);
    }
}
