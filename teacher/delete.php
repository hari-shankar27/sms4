<?php
session_start();
include "db.php";

$id=$_GET["id"] ?? '';

if(empty($id)){
    die("Missing Teacher ID");
}

$stmt=$conn->prepare("DELETE FROM users WHERE id=? AND role='teacher'");
$stmt->bind_param("i", $id);
if($stmt->execute()){
header("Location: teachers.php");

}
else{
    echo "Error detecting teacher" .$conn->error;

}

?>