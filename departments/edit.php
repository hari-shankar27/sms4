<?php


include("../db.php");

$error_msg = "";
$name = "";

// ----------------------------
// Handle Form Submission
// ----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $error_msg = "Department name is required.";
    } else {

        // Check for duplicate department name
        $check_stmt = mysqli_prepare($conn, "SELECT id FROM departments WHERE name = ?");
        mysqli_stmt_bind_param($check_stmt, "s", $name);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $error_msg = "A department with this name already exists.";
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO departments (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
            mysqli_stmt_bind_param($stmt, "s", $name);

            if (mysqli_stmt_execute($stmt)) {
               
                exit();
            } else {
                $error_msg = "Failed to add department: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check_stmt);
    }
}
include("../dashnav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
          <link rel="stylesheet" href="../dashnav.css">

</head>
<body>
    

<style>
    .department-container {
        width: 90%;
        max-width: 700px;
        margin: 50px auto;
    }

    .department-card {
        background: white;
        padding: 35px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
    }

    .department-card h1 {
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #444;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        box-sizing: border-box;
        outline: none;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.15);
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-update {
        background-color: #198754;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }

    .btn-update:hover {
        background-color: #157347;
    }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-cancel:hover {
        background-color: #5c636a;
        color: white;
    }

    .alert-box {
        padding: 12px 18px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #842029;
    }
</style>

<div class="department-container">

    <div class="department-card">

        <h1>Update Department</h1>

        <?php if (!empty($error_msg)): ?>
            <div class="alert-box alert-error"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>

        <form action="edit.php" method="POST">

            <div class="form-group">
                <label for="name">Department Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="<?= htmlspecialchars($name) ?>"
                    placeholder="Enter department name"
                    required
                >
            </div>

            <div class="button-group">
                <button type="submit" class="btn-update">Update Department</button>
                <a href="index.php" class="btn-cancel">Cancel</a>
            </div>

        </form>

    </div>

</div>


</body>
</html>