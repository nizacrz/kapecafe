<?php

// Database configuration
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'kapecafe';

// Connect to the database
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS) or die(mysqli_error($conn));
mysqli_select_db($conn, $DATABASE_NAME) or die(mysqli_error($conn));

if (!$conn) {
    echo "Failed to select Database!";
}
