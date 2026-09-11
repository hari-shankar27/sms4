<?php

session_start();
include "../db.php";

$stmt = $conn->prepare("UPDATE notifications SET is_read=1 WHERE is_read=0");

$stmt->execute();

header("Location: notifications.php");
exit;

?>