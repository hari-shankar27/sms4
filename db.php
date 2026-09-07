<?php

$conn = new mysqli('localhost', 'root', '', 'sms4');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}