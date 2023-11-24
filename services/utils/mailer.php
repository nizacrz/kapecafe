<?php

class Mailer
{
    private static $instance;

    private $subject = "KapeCafe: Two-factor Authentication";
    private $headers = "From: host@kapecafe.com\r\nReply-To: no-reply@kapecafe.com";

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

    public static function getinstance(): Mailer
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    function sendOTPTo($target, $otp)
    {
        $message = 'Hello! Your OTP is ' . $otp;
        mail($target, $this->subject, $message, $this->headers);
    }
}
