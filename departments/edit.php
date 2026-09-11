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
               header("Location: index.php");
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
    .edit-page {
    margin-left: 250px;
    padding: 80px 30px 30px;
    box-sizing: border-box;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.edit-container {
    width: 100%;
    max-width: 500px;
    padding: 25px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
}

.edit-container h1 {
    margin: 0 0 20px;
    color: #333;
    font-size: 26px;
    font-weight: 600;
}

.edit-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.edit-form label {
    color: #444;
    font-size: 14px;
    font-weight: 600;
}

.edit-form input {
    width: 100%;
    padding: 11px 14px;
    border: 1px solid #bbb;
    border-radius: 5px;
    font-size: 15px;
    outline: none;
    transition: 0.2s;
}

.edit-form input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
}
.button-group{
    display: flex;
    align-items: center;
    gap: 20px;
  
}

.update-btn {
    width: 100%;
    padding: 11px;
    margin-top: 5px;
    background-color: #0d6efd;
    color: #fff;
      font-family: inherit;
    border: none;
    border-radius: 5px;
    font-size: 15px;

    font-weight: 500;
    cursor: pointer;
    transition: 0.2s;
}

.update-btn:hover {
    background-color: #0b5ed7;
}

.cancel-btn {
    display: block;
    width: 100%;
    padding: 11px;
    margin-top: 2px;
    background-color: #6c757d;
    color: #fff;
    text-align: center;
    text-decoration: none;
    font-size: 15px;
    transition: 0.2s;
}

.cancel-btn:hover {
    background-color: #5c636a;
    color: #fff;
}

.alert-box {
    padding: 10px 15px;
    margin-bottom: 15px;
    border-radius: 6px;
    background-color: #f8d7da;
    color: #842029;
    font-size: 14px;
}

/* Mobile */
@media (max-width: 700px) {
    .edit-page {
        margin-left: 0;
        padding: 70px 15px 25px;
    }

    .edit-container {
        max-width: 100%;
        padding: 20px;
    }

    .edit-container h1 {
        font-size: 23px;
    }
}
</style>

<div class="edit-page">

    <div class="edit-container">

        <h1>Update Department</h1>

        <?php if (!empty($error_msg)): ?>
            <div class="alert-box alert-error"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>

        <form action="edit.php" method="POST" class="edit-form">

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
                <button type="submit" class="update-btn">Update Department</button>
                <a href="index.php" class="cancel-btn">Cancel</a>
            </div>

        </form>

    </div>

</div>


</body>
</html>