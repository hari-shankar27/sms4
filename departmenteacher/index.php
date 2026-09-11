<?php
// teacher-departments.php
include("../db.php");

// ----------------------------
// Handle Delete (must run BEFORE dashnav.php outputs HTML)
// ----------------------------
if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM teachersdepartments WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $delete_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: teachersdepartments.php?status=deleted");
        exit();
    } else {
        $error_msg = "Failed to delete assignment: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}


$teachers = [];

$teacherResult = mysqli_query($conn, "SELECT id, name FROM teachers ORDER BY name ASC");

if ($teacherResult) {
    while ($teacherRow = mysqli_fetch_assoc($teacherResult)) {
        $teacherId = $teacherRow['id'];

        // Get all departments assigned to this teacher
        $deptStmt = mysqli_prepare($conn, "
            SELECT d.id, d.name
            FROM teachersdepartments td
            INNER JOIN departments d ON d.id = td.department_id
            WHERE td.teacher_id = ?
            ORDER BY d.name ASC
        ");
        mysqli_stmt_bind_param($deptStmt, "i", $teacherId);
        mysqli_stmt_execute($deptStmt);
        $deptResult = mysqli_stmt_get_result($deptStmt);

        $departments = [];
        while ($deptRow = mysqli_fetch_assoc($deptResult)) {
            $departments[] = $deptRow;
        }
        mysqli_stmt_close($deptStmt);

        // Get the pivot row id of the FIRST department assignment
        // (mirrors the original Blade code's use of ->first())
        $firstAssignmentId = null;
        if (count($departments) > 0) {
            $firstStmt = mysqli_prepare($conn, "
                SELECT id FROM teachersdepartments
                WHERE teacher_id = ?
                ORDER BY id ASC
                LIMIT 1
            ");
            mysqli_stmt_bind_param($firstStmt, "i", $teacherId);
            mysqli_stmt_execute($firstStmt);
            $firstResult = mysqli_stmt_get_result($firstStmt);
            $firstRow = mysqli_fetch_assoc($firstResult);
            $firstAssignmentId = $firstRow['id'] ?? null;
            mysqli_stmt_close($firstStmt);
        }

        $teachers[] = [
            'id' => $teacherId,
            'name' => $teacherRow['name'],
            'departments' => $departments,
            'first_assignment_id' => $firstAssignmentId
        ];
    }
}


include("../dashnav.php");
?>
 <!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

     <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        
<head>     
<style>
    .department-container {
        width: calc(100% - 250px);
        margin-left: 250px;
        margin-top: 70px;
        padding: 20px;
        box-sizing: border-box;
        min-height: calc(100vh - 70px);
    }

    .department-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .department-header h2 {
        margin: 0;
        color: #333;
        font-weight: 600;
    }

    .add-btn {
        background-color: #198754;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        white-space: nowrap;
    }

    .add-btn:hover {
        background-color: #157347;
        color: white;
    }

    .table-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
        overflow-x: auto;
    }

    .department-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
    }

    .department-table thead {
        background-color: #0d6efd;
        color: white;
    }

    .department-table th,
    .department-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .department-table th {
        font-weight: 600;
    }

    .department-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .department-table td {
        color: #444;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #212529;
        padding: 7px 13px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-delete:hover {
        background-color: #bb2d3b;
    }

    .no-data {
        text-align: center !important;
        padding: 25px !important;
        color: #777;
    }

    .alert-box {
        padding: 12px 18px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #842029;
    }
</style>
<</head>
<body>


<div class="department-container">

    <div class="department-header">
        <h2>Teacher Departments</h2>
        <a href="create.php" class="add-btn">Assign Teacher</a>
    </div>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'created'): ?>
        <div class="alert-box alert-success">Teacher assigned successfully.</div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] === 'updated'): ?>
        <div class="alert-box alert-success">Assignment updated successfully.</div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
        <div class="alert-box alert-success">Assignment deleted successfully.</div>
    <?php endif; ?>

    <?php if (!empty($error_msg)): ?>
        <div class="alert-box alert-error"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>
</div>
    
    </body>
    </html>