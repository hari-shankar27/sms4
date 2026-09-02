<?php

<<<<<<< HEAD
$conn = new mysqli('localhost', 'root', '', 'sms4_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
=======
$host = "localhost";
$username = "root";
$password = "";
$database = "sms4";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
>>>>>>> hari
