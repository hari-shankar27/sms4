<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.html");
    exit;
}



$name = trim($_POST["name"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$email = trim($_POST["email"] ?? "");
$role = $_POST["role"] ?? "";
$teacher_id = trim($_POST["teacher_id"] ?? "");
$password = $_POST["password"] ?? "";
$conpass = $_POST["conpass"] ?? "";



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



$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("This email is already registered.");
}

$stmt->close();



if ($role === "student") {

   
    $stmt = $conn->prepare("SELECT id FROM students WHERE email = ? LIMIT 1");

    $stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("This student email is already registered.");
    }

    $stmt->close();


    $stmt = $conn->prepare("INSERT INTO students (name, phone, email)VALUES (?, ?, ?)");

    $stmt->bind_param("sss",$name,$phone,$email);

    if (!$stmt->execute()) {
        die("Student registration failed: " . $stmt->error);
    }

    $stmt->close();

    $hashedPassword = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role, teacher_id, status) VALUES (?, ?, ?, ?, 'student', NULL, 'pending')");

    $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);

    if ($stmt->execute()) {

    $student_id = $conn->insert_id;
    
    $title="New Student Registration";
    $messages = "$name has registered as a new student. Please check their details and approve this registration.";

    $notify=$conn->prepare("INSERT INTO notifications (user_id, title, message) VALUES (?,?,?)");
    $notify->bind_param("iss", $student_id, $title, $messages);
    if(!$notify->execute()){
        die("Notification creation failed:" .$notify->error);
    }
    $notify->close();
    
    echo "<script>
            alert('Registration successful! Please wait for admin approval.');
            window.location.href='login.html';
        </script>";

    } else {

        echo "Account creation failed: " . $stmt->error;
    }

    $stmt->close();
}




elseif ($role === "teacher") {

    if ($teacher_id === "") {
        die("Teacher ID is required.");
    }


    $stmt = $conn->prepare("SELECT id, name, phone, email FROM teachers WHERE teacher_id = ? LIMIT 1");

    $stmt->bind_param("s", $teacher_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Invalid Teacher ID. Please contact the school administrator.");
    }

    $teacher = $result->fetch_assoc();

    $stmt->close();


  
    $stmt = $conn->prepare("SELECT id FROM users WHERE teacher_id = ? LIMIT 1");

    $stmt->bind_param("s", $teacher_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("This Teacher ID is already registered.");
    }

    $stmt->close();



    if (strcasecmp($name, $teacher["name"]) !== 0) {
        die("Name does not match the Teacher ID.");
    }


    $hashedPassword = password_hash($password,PASSWORD_DEFAULT
    );



    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role, teacher_id, status) VALUES (?, ?, ?, ?, 'teacher', ?, 'pending')");

    $stmt->bind_param("sssss", $name, $phone, $email, $hashedPassword, $teacher_id );


    if ($stmt->execute()) {

        echo "<script>
            alert('Registration successful! Please wait for admin approval.');
            window.location.href='login.html';
        </script>";

    } else {

        echo "Teacher registration failed: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();

?>