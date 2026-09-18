<?php
include("../db.php");

$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);
$error_msg = "";
$name = "";

if ($id <= 0) {
    header("Location:index.php");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT name FROM departments WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name);

if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location:index.php");
    exit;
}
mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");

    if ($name === "") {
        $error_msg = "Department name is required.";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "SELECT id FROM departments WHERE name = ? AND id != ?"
        );
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt)) {
            $error_msg = "A department with this name already exists.";
        } else {
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare(
                $conn,
                "UPDATE departments SET name = ?, updated_at = NOW() WHERE id = ?"
            );
            mysqli_stmt_bind_param($stmt, "si", $name, $id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location:index.php?status=updated");
                exit;
            }

            $error_msg = "Failed to update department.";
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
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Update Department</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="../dashnav.css">

<style>
.edit-page{
    margin-left:250px;
    min-height:100vh;
    padding:100px 45px 45px;
    display:flex;
    align-items:center;
    justify-content:center;
}

body.sidebar-collapsed .edit-page{margin-left:80px}

.edit-container{
    width:100%;
    max-width:520px;
    padding:35px;
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.06);
}

.form-header{
    text-align:center;
    margin-bottom:25px;
}

.form-icon{
    width:60px;
    height:60px;
    margin:0 auto 15px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    border-radius:14px;
    font-size:24px;
}

.form-header h1{
    margin:0;
    color:#183b56;
    font-size:27px;
}

.form-header p{
    margin:7px 0 0;
    color:#7b8794;
    font-size:14px;
}

.edit-form{
    display:grid;
    gap:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:#334155;
    font-size:14px;
    font-weight:600;
}

.form-input{
    width:100%;
    padding:13px 15px;
    border:1px solid #d1d5db;
    border-radius:9px;
    font:14px inherit;
    outline:0;
}

.form-input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,.12);
}

.update-btn,
.cancel-btn{
    width:100%;
    padding:13px;
    border-radius:9px;
    font-size:14px;
    font-weight:600;
    text-align:center;
}

.update-btn{
    border:0;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    cursor:pointer;
}

.update-btn:hover{
    transform:translateY(-2px);
}

.cancel-btn{
    display:block;
    margin-top:-7px;
    border:1px solid #e2e8f0;
    color:#64748b;
    text-decoration:none;
}

.cancel-btn:hover{
    background:#f8fafc;
    color:#2563eb;
}

.alert-box{
    margin-bottom:18px;
    padding:12px 15px;
    border-radius:9px;
    background:#fee2e2;
    color:#991b1b;
    font-size:14px;
}

@media(max-width:768px){
    .edit-page{
        margin-left:0;
        padding:80px 20px 30px;
    }
}

@media(max-width:500px){
    .edit-container{padding:28px 22px}
}
</style>

</head>

<body>

<main class="edit-page">
<div class="edit-container">

    <div class="form-header">
        <div class="form-icon">
            <i class="fa-solid fa-pen-to-square"></i>
        </div>

        <h1>Update Department</h1>
        <p>Update academic department information</p>
    </div>

    <?php if ($error_msg): ?>
        <div class="alert-box">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?= htmlspecialchars($error_msg) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="edit-form">

        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="form-group">
            <label for="name">Department Name</label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-input"
                value="<?= htmlspecialchars($name) ?>"
                placeholder="Enter department name"
                required
            >
        </div>

        <button class="update-btn">
            <i class="fa-solid fa-check"></i>
            Update Department
        </button>

        <a href="index.php" class="cancel-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Cancel
        </a>

    </form>

</div>
</main>

</body>
</html>
