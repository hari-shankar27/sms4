<?php

session_start();
include "db.php";

$stmt= $conn->prepare("SELECT id, user_id, title, message, is_read, created_at FROM notifications ORDER BY created_at DISC");
$stmt->execute();
$notifications = $stmt->get_result();

?>