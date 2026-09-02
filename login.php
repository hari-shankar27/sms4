<?php

session_start();

include "db.php";


// ==========================================
// CHECK LOGIN FORM
// ==========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";


    // ======================================
    // VALIDATION
    // ======================================

    if ($email === "" || $password === "") {
        die("Please enter your email and password.");
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address.");
    }


    // ======================================
    // FIND USER
    // ======================================

    $stmt = $conn->prepare(
        "SELECT id,name, email, password, role, teacher_id, profile
         FROM users
         WHERE email = ?
         LIMIT 1"
    );

    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();


    // ======================================
    // USER NOT FOUND
    // ======================================

    if ($result->num_rows === 0) {

        $stmt->close();
        $conn->close();

        die("Invalid email or password.");
    }


    $user = $result->fetch_assoc();

    $stmt->close();


    // ======================================
    // VERIFY PASSWORD
    // ======================================

    if (!password_verify($password, $user["password"])) {

        $conn->close();

        die("Invalid email or password.");
    }


    // ======================================
    // LOGIN SUCCESS
    // ======================================

    session_regenerate_id(true);


    $_SESSION["user_id"] = $user["id"];
$_SESSION["name"] = $user["name"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];
$_SESSION["profile"]= $user["profile"];


    // Teacher ID only exists for teachers

    if ($user["role"] === "teacher") {

        $_SESSION["teacher_id"] = $user["teacher_id"];
    }


    // ======================================
    // REDIRECT ACCORDING TO ROLE
    // ======================================

    if ($user["role"] === "admin") {

        header("Location: admin_dashboard.php");
        exit;

    } elseif ($user["role"] === "teacher") {

        header("Location: teacher.php");
        exit;

    } elseif ($user["role"] === "student") {

        header("Location: dashboard1.php");
        exit;

    } else {

        die("Invalid user role.");
    }
}


$conn->close();

?>