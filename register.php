<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.html");
    exit;
}


// ======================================
// GET FORM DATA
// ======================================

$name = trim($_POST["name"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$email = trim($_POST["email"] ?? "");
$role = $_POST["role"] ?? "";
$teacher_id = trim($_POST["teacher_id"] ?? "");
$password = $_POST["password"] ?? "";
$conpass = $_POST["conpass"] ?? "";


// ======================================
// VALIDATION
// ======================================

if ($name === "" || $email === "" || $password === "") {
    die("Please fill all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

if ($password !== $conpass) {
    die("Passwords do not match.");
}

if (!in_array($role, ["student", "teacher"])) {
    die("Invalid registration role.");
}


// ======================================
// CHECK EMAIL
// ======================================

$stmt = $conn->prepare(
    "SELECT id FROM users WHERE email = ? LIMIT 1"
);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("This email is already registered.");
}

$stmt->close();


// ======================================
// STUDENT REGISTRATION
// ======================================

if ($role === "student") {

    // Check student email
    $stmt = $conn->prepare(
        "SELECT id FROM students WHERE email = ? LIMIT 1"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("This student email is already registered.");
    }

    $stmt->close();


    // Insert student
    $stmt = $conn->prepare(
        "INSERT INTO students (name, phone, email)
         VALUES (?, ?, ?)"
    );

    $stmt->bind_param(
        "sss",
        $name,
        $phone,
        $email
    );

    if (!$stmt->execute()) {
        die("Student registration failed: " . $stmt->error);
    }

    $stmt->close();


    // Password hashing
    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    // Insert login account
    $stmt = $conn->prepare(
        "INSERT INTO users
        (name, phone, email, password, role, teacher_id)
        VALUES (?, ?, ?, ?, 'student', NULL)"
    );

    $stmt->bind_param(
        "ssss",
        $name,
        $phone,
        $email,
        $hashedPassword
    );

    if ($stmt->execute()) {

        echo "<script>
            alert('Student registration successful!');
            window.location.href='login.html';
        </script>";

    } else {

        echo "Account creation failed: " . $stmt->error;
    }

    $stmt->close();
}


// ======================================
// TEACHER REGISTRATION
// ======================================

elseif ($role === "teacher") {

    if ($teacher_id === "") {
        die("Teacher ID is required.");
    }


    // Check Teacher ID
    $stmt = $conn->prepare(
        "SELECT id, name, phone, email
         FROM teachers
         WHERE teacher_id = ?
         LIMIT 1"
    );

    $stmt->bind_param("s", $teacher_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Invalid Teacher ID. Please contact the school administrator.");
    }

    $teacher = $result->fetch_assoc();

    $stmt->close();


    // Check if Teacher ID already has account
    $stmt = $conn->prepare(
        "SELECT id FROM users
         WHERE teacher_id = ?
         LIMIT 1"
    );

    $stmt->bind_param("s", $teacher_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("This Teacher ID is already registered.");
    }

    $stmt->close();


    // Check name
    if (strcasecmp($name, $teacher["name"]) !== 0) {
        die("Name does not match the Teacher ID.");
    }


    // Password hash
    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    // Create teacher login account
    $stmt = $conn->prepare(
        "INSERT INTO users
        (name, phone, email, password, role, teacher_id)
        VALUES (?, ?, ?, ?, 'teacher', ?)"
    );

    $stmt->bind_param(
        "sssss",
        $name,
        $phone,
        $email,
        $hashedPassword,
        $teacher_id
    );


    if ($stmt->execute()) {

        echo "<script>
            alert('Teacher registration successful!');
            window.location.href='login.html';
        </script>";

    } else {

        echo "Teacher registration failed: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();

?>