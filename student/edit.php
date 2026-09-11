<?php
session_start();


include "../db.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: student.php");
    exit;
}

$id = (int) $_GET["id"];

$stmt = $conn->prepare(" SELECT id, name, email, phone, status FROM users WHERE id = ? AND role = 'student'");

$stmt->bind_param("i", $id);
$stmt->execute();

$student = $stmt->get_result()->fetch_assoc();

if (!$student) {
    header("Location: student.php");
    exit;
}

$message = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $status = $_POST["status"] ?? "pending";

    if ($name === "" || $email === "") {
        $message = "Name and email are required.";
    } else {

        $update = $conn->prepare(" UPDATE users SET name = ?, email = ?, phone = ?, status = ? WHERE id = ? AND role = 'student'");

        $update->bind_param( "ssssi", $name, $email, $phone, $status, $id);

        if ($update->execute()) {
            header("Location: student.php");
            exit;
        } else {
            $message = "Failed to update student.";
        }
    }
}
include "../dashnav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <style>
  
.edit-student{
    margin-left:300px;
    padding: 95px 45px 45px;
    min-height: 100vh;
    transition: 0.3s ease;
}

body.sidebar-collapsed .edit-student {
    margin-left: 120px;
}

.edithead {
    margin-bottom: 28px;
}

.edithead h1 {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #183b56;
    letter-spacing: -0.5px;
}

.edithead p {
    margin: 8px 0 0;
    font-size: 14px;
    color: #7b8794;
}

.edit-card {
    max-width: 760px;
    background: #ffffff;
    padding: 32px;
    border: 1px solid #eef2f7;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.04);
}



.fg {
 margin-bottom: 22px;
}

.fg label {
  display: block;
 margin-bottom: 9px;
 font-size: 14px;
  font-weight: 600;
    color: #334e68;
}

.fg input,
.fg select {
width: 100%;
 height: 46px;
    box-sizing: border-box;

    padding: 0 14px;
border: 1px solid #dbe4ec;
    border-radius: 8px;
    outline: none;
    background: #ffffff;
    color: #334e68;
    font-size: 14px;
    font-family: inherit;
    transition: 0.25s ease;
}

.fg input::placeholder {
    color: #a0aec0;
}


.fg input:focus,
.fg select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
}


.fg select {
    cursor: pointer;
    appearance: auto;
}

.actions {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 30px;
    padding-top: 24px;
    border-top: 1px solid #eef2f7;
}

.btn1 {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: 0.25s ease;
}

.bu {
    background: #2563eb;
    color: #ffffff;
}

.bu:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(37, 99, 235, 0.18);
}


.bc {
    background: #f1f5f9;
    color: #475569;
}

.bc:hover {
    background: #e2e8f0;
    color: #334155;
}


.error {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
    padding: 13px 15px;
    border: 1px solid #fecaca;
    border-radius: 8px;
    background: #fef2f2;
    color: #b91c1c;
    font-size: 14px;
}



@media (max-width: 1024px) {

    .edit-student {
        margin-left: 220px;
        padding: 90px 30px 35px;
    }

    body.sidebar-collapsed .edit-student {
        margin-left: 80px;
    }

    .edit-card {
        max-width: 100%;
    }

}

@media (max-width: 768px) {

    .edit-student,
    body.sidebar-collapsed .edit-student {
        margin-left: 0;
        padding: 85px 20px 30px;
    }

    .edithead h1 {
        font-size: 25px;
    }

    .edit-card {
        padding: 24px;
        border-radius: 12px;
    }

    .actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn {
        width: 100%;
    }

}

@media (max-width: 480px) {

    .edit-student {
        padding: 80px 15px 25px;
    }

    .edit-card {
        padding: 20px;
    }

    .edithead h1 {
        font-size: 23px;
    }

}


    </style>
</head>

<body>

<div class="edit-student">

    <div class="edithead">
        <h1>Edit Student</h1>
        <p>Update student information</p>
    </div>

    <div class="edit-card">

        <?php if($message !==""): ?>
       <div class="error">
        <?= htmlspecialchars($message) ?>
       </div>
       <?php endif; ?>


        <form method="POST">

            <div class="fg">
                <label for="name">Student Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($student["name"]) ?>" required>
            </div>

            
           <div class="fg">
            <label for="email">Email Address</label>
            <input type="text" name="email" value="<?= htmlspecialchars($student["email"]) ?>" required>
           </div>

            
           <div class="fg">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" value="<?= htmlspecialchars($student["phone"]) ?>" required>
           </div>

           <div class="fg">
            <label for="status">Student Status</label>
            <select id="status" name="status">
                <option value="pending" <?= $student["status"] === "pending" ? "selected" : "" ?>>Pending</option>
                <option value="approved" <?= $student["status"] === "approved" ? "selected" : "" ?>>Approved</option>
                <option value="rejected" <?= $student["status"] === "rejected"? "selected" : "" ?>>Rejected</option>
            </select>
           </div>
            
            <div class="actions">
                <button type="submit" class="btn1 bu">
                    Update Student
                </button>

                <a href="student.php" class="btn1 bc">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>