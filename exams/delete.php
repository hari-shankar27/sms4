<?php

include("../db.php");

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {

    $stmt = $conn->prepare("DELETE FROM exams WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>