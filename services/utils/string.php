<?php
class Str
{


    // Turns strings into uppercase (used in genres and authors)
    public static function toUpperCamelCase($raw)
    {
        $str = ucwords(strtolower($raw), " \t\r\n\f\v.:,");
        return $str;
    }

    // Sanitize strings
    public static function sanitizeString($raw)
    {
        return htmlspecialchars(strip_tags($raw));
    }

    public static function sanitizeIP($raw)
    {
        return filter_var($raw, FILTER_VALIDATE_IP);
    }

    public static function sanitizeEmail($raw)
    {
        return filter_var($raw, FILTER_SANITIZE_EMAIL);
    }

    public static function sanitizeInt($raw)
    {
        return filter_var($raw, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function sanitizeDouble($raw)
    {
        return filter_var($raw, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public static function generatePassword()
    {
        // Define character sets
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()-_+=<>?';

        // Combine character sets
        $allChars = $lowercase . $uppercase . $numbers . $specialChars;

        // Ensure at least one character from each set
        $password = $lowercase[rand(0, 25)] .         // Lowercase
            $uppercase[rand(0, 25)] .         // Uppercase
            $numbers[rand(0, 9)] .            // Number
            $specialChars[rand(0, strlen($specialChars) - 1)];  // Special character

        // Fill the rest of the password with random characters
        $password .= substr(str_shuffle($allChars), 0, 3);

        // Shuffle the password to ensure randomness
        $password = str_shuffle($password);

        return $password;
    }
}
