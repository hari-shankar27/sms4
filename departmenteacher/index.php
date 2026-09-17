<?php
include("../db.php");

$error_msg = "";

if (isset($_GET["delete_id"])) {
    $id = (int)$_GET["delete_id"];

    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM teachersdepartments WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location:index.php?status=deleted");
            exit;
        }

        $error_msg = "Failed to delete assignment.";
        mysqli_stmt_close($stmt);
    }
}

$assignments = [];

$result = mysqli_query($conn, "
    SELECT
        td.id,
        t.name AS teacher_name,
        d.name AS department_name
    FROM teachersdepartments td
    INNER JOIN teachers t ON t.id = td.teacher_id
    INNER JOIN departments d ON d.id = td.department_id
    ORDER BY t.name ASC, d.name ASC
");

while ($result && $row = mysqli_fetch_assoc($result)) {
    $assignments[] = $row;
}

include("../dashnav.php");
?>

<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Teacher Departments</title>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet" href="../dashnav.css">

<style>
.department-page{
    margin-left:250px;
    padding:100px 45px 45px;
    transition:.3s;
}

body.sidebar-collapsed .department-page{
    margin-left:80px;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h1{
    margin:0;
    color:#183b56;
    font-size:28px;
}

.page-header p{
    margin-top:7px;
    color:#7b8794;
    font-size:14px;
}

.add-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:11px 18px;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    text-decoration:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.add-btn:hover{
    color:#fff;
    transform:translateY(-2px);
}

.alert-box{
    padding:12px 18px;
    border-radius:9px;
    margin-bottom:20px;
    font-size:14px;
    font-weight:500;
}

.alert-success{
    background:#dcfce7;
    color:#166534;
}

.alert-error{
    background:#fee2e2;
    color:#991b1b;
}

.table-box{
    background:#fff;
    padding:25px;
    border-radius:18px;
    box-shadow:0 8px 25px rgba(0,0,0,.04);
}

.table-box h2{
    margin:0 0 20px;
    color:#183b56;
    font-size:21px;
}

.table-wrapper{
    overflow-x:auto;
}

.department-table{
    width:100%;
    min-width:650px;
    border-collapse:collapse;
}

.department-table th{
    padding:14px 12px;
    text-align:left;
    background:#f8fafc;
    color:#64748b;
    font-size:13px;
}

.department-table td{
    padding:16px 12px;
    border-bottom:1px solid #eef2f6;
    color:#475569;
    font-size:14px;
}

.department-table tbody tr:hover{
    background:#f8fafc;
}

.teacher-name,
.department-name{
    display:flex;
    align-items:center;
    gap:10px;
    color:#183b56;
    font-weight:600;
}

.icon{
    width:38px;
    height:38px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:#e8f4ff;
    color:#2563eb;
}

.btn{
    display:inline-block;
    padding:6px 12px;
    margin-right:4px;
    border-radius:8px;
    text-decoration:none;
    font-size:13px;
}

.btn-edit{
    background:#e8f4ff;
    color:#2563eb;
}

.btn-delete{
    background:#fbeaec;
    color:#dc2626;
}

.btn-edit:hover{
    background:#2563eb;
    color:#fff;
}

.btn-delete:hover{
    background:#dc2626;
    color:#fff;
}

.no-data{
    text-align:center;
    padding:45px 20px;
    color:#7b8794;
}

.no-data i{
    display:block;
    margin-bottom:15px;
    font-size:38px;
    color:#2563eb;
}

@media(max-width:768px){
    .department-page{
        margin-left:0;
        padding:80px 18px 30px;
    }

    .page-header{
        align-items:flex-start;
        flex-direction:column;
        gap:12px;
    }

    .add-btn{
        width:100%;
        justify-content:center;
    }
}
</style>

</head>

<body>

<main class="department-page">

<div class="page-header">

    <div>
        <h1>Teacher Departments</h1>
        <p>Manage teacher department assignments</p>
    </div>

    <a href="create.php" class="add-btn">
        <i class="fa-solid fa-user-plus"></i>
        Assign Teacher
    </a>

</div>

<?php if (isset($_GET["status"])): ?>

    <?php
    $messages = [
        "created" => "Teacher assigned successfully.",
        "updated" => "Assignment updated successfully.",
        "deleted" => "Assignment deleted successfully."
    ];
    ?>

    <?php if (isset($messages[$_GET["status"]])): ?>
        <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <?= $messages[$_GET["status"]] ?>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php if ($error_msg): ?>

    <div class="alert-box alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        <?= htmlspecialchars($error_msg) ?>
    </div>

<?php endif; ?>

<div class="table-box">

    <h2>Assigned Departments</h2>

    <?php if ($assignments): ?>

        <div class="table-wrapper">

            <table class="department-table">

                <thead>
                    <tr>
                        <th>S.NO.</th>
                        <th>Teacher</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($assignments as $i => $assignment): ?>

                    <tr>

                        <td><?= $i + 1 ?></td>

                        <td>
                            <div class="teacher-name">
                                <span class="icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>

                                <?= htmlspecialchars($assignment["teacher_name"]) ?>
                            </div>
                        </td>

                        <td>
                            <div class="department-name">
                                <span class="icon">
                                    <i class="fa-solid fa-building"></i>
                                </span>

                                <?= htmlspecialchars($assignment["department_name"]) ?>
                            </div>
                        </td>

                        <td>

                            <a href="edit.php?id=<?= $assignment["id"] ?>"
                               class="btn btn-edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>

                            <a href="index.php?delete_id=<?= $assignment["id"] ?>"
                               class="btn btn-delete"
                               onclick="return confirm('Are you sure you want to delete this assignment?')">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else: ?>

        <div class="no-data">
            <i class="fa-solid fa-folder-open"></i>
            <h3>No Assignments Found</h3>
            <p>No teachers have been assigned to departments yet.</p>
        </div>

    <?php endif; ?>

</div>
</main>

</body>
</html>
