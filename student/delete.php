<?php

session_start();
include "db.php";

$id=$_GET['id']?? '';
// Get id from the URL. If it does not exist, use an empty string.

if(empty($id)){
    die("Missing Student ID.");
}
$stmt=$conn->prepare("DELETE FROM users WHERE id=? AND role='student'");
$stmt->bind_param("i", $id);
if($stmt->execute()){
    header("Location: student.php");
}
else { 
    echo "Error deleting student: " . $conn->error;
}

?>