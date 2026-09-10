<?php
// department-add.php
include("../db.php");


$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $error_msg = "Department name is required.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO departments (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
        mysqli_stmt_bind_param($stmt, "s", $name);

        if (mysqli_stmt_execute($stmt)) {
            header("Location:index.php");
            exit();
        } else {
            $error_msg = "Failed to add department: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

include("../dashnav.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
          <link rel="stylesheet" href="../dashnav.css">

</head>
<body>
    
<style>
    .department-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 35px;
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .department-container h1 {
        text-align: center;
        color: #333;
        font-size: 28px;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .department-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .department-form input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #bbb;
        border-radius: 5px;
        font-size: 16px;
        outline: none;
        transition: 0.3s;
        box-sizing: border-box;
    }

    .department-form input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .create-btn {
        padding: 12px;
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.3s;
    }

    .create-btn:hover {
        background: #1d4ed8;
    }

    .alert-box {
        padding: 12px 18px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-weight: 500;
        background-color: #f8d7da;
        color: #842029;
    }
</style>

<div class="department-container">

    <h1>Create Department</h1>

    <?php if (!empty($error_msg)): ?>
        <div class="alert-box"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="department-form">

        <input
            type="text"
            name="name"
            placeholder="Enter department name"
            value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
            required
        >

        <button type="submit" class="create-btn">
            Create Department
        </button>

    </form>

</div>


</body>
</html>