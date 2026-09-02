<?php

session_start();

include "db.php";

// Check login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_FILES["profile"]) && $_FILES["profile"]["error"] === 0) {

    $user_id = $_SESSION["user_id"];

    // Allowed image types
    $allowedTypes = [
        "image/jpeg",
        "image/png",
        "image/webp"
    ];

    $fileType = mime_content_type($_FILES["profile"]["tmp_name"]);

    if (!in_array($fileType, $allowedTypes)) {
        die("Only JPG, PNG and WEBP images are allowed.");
    }

    // Maximum size: 2MB
    if ($_FILES["profile"]["size"] > 2 * 1024 * 1024) {
        die("Image must be less than 2MB.");
    }

    // Create uploads folder if it doesn't exist
    $uploadDir = "uploads/profile/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate unique filename
    $extension = pathinfo(
        $_FILES["profile"]["name"],
        PATHINFO_EXTENSION
    );

    $fileName = "user_" . $user_id . "_" . time() . "." . $extension;

    $filePath = $uploadDir . $fileName;

    // Move image
    if (move_uploaded_file(
        $_FILES["profile"]["tmp_name"],
        $filePath
    )) {

        // Save path in database
        $stmt = $conn->prepare(
            "UPDATE users SET profile = ? WHERE id = ?"
        );

        $stmt->bind_param(
            "si",
            $filePath,
            $user_id
        );

        $stmt->execute();

        $stmt->close();

        // Save in session
        $_SESSION["profile"] = $filePath;

        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;

    } else {

        die("Failed to upload image.");
    }
}

$conn->close();

?>