<?php

session_start();

include "db.php";



if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.html");
    exit;
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    die("Please enter your email and password.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Please enter a valid email address.");
}



$stmt = $conn->prepare(
    "SELECT id, name, email, password, role, teacher_id, profile, status
     FROM users
     WHERE email = ?
     LIMIT 1"
);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows === 0) {

    $stmt->close();
    $conn->close();

    die("Invalid email or password.");
}

$user = $result->fetch_assoc();

$stmt->close();


if (!password_verify($password, $user["password"])) {

    $conn->close();

    die("Invalid email or password.");
}

// if ($user["status"] === "pending") {

//     $conn->close();

//     die("Your account is waiting for admin approval.");

// }

// if ($user["status"] === "rejected") {

//     $conn->close();

//     die("Your registration has been rejected. Please contact the school.");

// }


// session_regenerate_id(true);


$_SESSION["user_id"] = $user["id"];
$_SESSION["name"] = $user["name"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];
$_SESSION["profile"] = $user["profile"];


if ($user["role"] === "teacher") {

    $_SESSION["teacher_id"] = $user["teacher_id"];

}



if ($user["role"] === "admin") {

    header("Location: dashboard1.php");
    exit;

} elseif ($user["role"] === "teacher") {

    header("Location: teacher.php");
    exit;

} elseif ($user["role"] === "student") {

    header("Location: dashboard1.php");
    exit;

} else {

    $conn->close();

    die("Invalid user role.");
}


$conn->close();

?>