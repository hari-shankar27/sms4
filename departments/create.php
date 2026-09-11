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
       

</head>
<body>
    
<style>
.create-page {
    margin-left: 250px;
    padding: 100px 45px 45px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    transition: margin-left 0.3s ease;
    justify-content: center;
}
body.sidebar-collapsed .create-page{
    margin-left: 80px;
}
.department-container {
    width: 100%;
    max-width: 500px;
    padding: 30px;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.department-container h1 {
    margin: 0 0 25px;
    color: #333;
    font-size: 28px;
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
    font-family: inherit;
    border: 1px solid #bbb;
    border-radius: 5px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

.department-form input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.create-btn {
    width: 100%;
    padding: 12px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    transition: 0.3s;
}

.create-btn:hover {
    background: #1d4ed8;
}

.alert-box {
    padding: 12px 18px;
    margin-bottom: 20px;
    border-radius: 6px;
    font-weight: 500;
    background-color: #f8d7da;
    color: #842029;
}

/* Responsive */
@media (max-width: 700px) {
    .create-page {
        margin-left: 0;
        padding: 80px 20px 30px;
    }

    .department-container {
        max-width: 100%;
        padding: 25px 20px;
    }

    .department-container h1 {
        font-size: 24px;
    }
}
</style>
<main class="create-page">

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
</main>

</body>
</html>