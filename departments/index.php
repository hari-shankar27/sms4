
<?php

include("../db.php");

$error_msg = "";

// ------------------------------------
// Handle Delete
// ------------------------------------
if (isset($_GET['delete_id'])) {

    $delete_id = (int) $_GET['delete_id'];

    if ($delete_id <= 0) {
        $error_msg = "Invalid department ID.";
    } else {

        // Start transaction
        mysqli_begin_transaction($conn);

        try {

            // ------------------------------------
            // 1. Delete teacher-department
            // relationship records first
            // ------------------------------------
            $stmt1 = mysqli_prepare(
                $conn,
                "DELETE FROM teachersdepartments WHERE department_id = ?"
            );

            mysqli_stmt_bind_param(
                $stmt1,
                "i",
                $delete_id
            );

            if (!mysqli_stmt_execute($stmt1)) {
                throw new Exception(
                    "Failed to remove teacher assignments."
                );
            }

            mysqli_stmt_close($stmt1);


            // ------------------------------------
            // 2. Delete Department
            // ------------------------------------
            $stmt2 = mysqli_prepare(
                $conn,
                "DELETE FROM departments WHERE id = ?"
            );

            mysqli_stmt_bind_param(
                $stmt2,
                "i",
                $delete_id
            );

            if (!mysqli_stmt_execute($stmt2)) {
                throw new Exception(
                    "Failed to delete department."
                );
            }

            mysqli_stmt_close($stmt2);


            // ------------------------------------
            // Commit transaction
            // ------------------------------------
            mysqli_commit($conn);

            header("Location: index.php?status=deleted");
            exit();

        } catch (Exception $e) {

            // Undo all changes if something fails
            mysqli_rollback($conn);

            $error_msg = $e->getMessage();
        }
    }
}


// ------------------------------------
// Dashboard Navigation
// ------------------------------------
include("../dashnav.php");


// ------------------------------------
// Fetch All Departments
// ------------------------------------
$departments = [];

$result = mysqli_query(
    $conn,
    "SELECT id, name, created_at, updated_at
     FROM departments
     ORDER BY id ASC"
);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Department List</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet"
          href="../dashnav.css">

</head>

<body>

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


    .header-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
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
        white-space: nowrap;
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
        background-color: #0d6efd;
        color: white;
        padding: 7px 13px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        margin-right: 5px;
        display: inline-block;
    }


    .btn-edit:hover {
        background-color: #0b5ed7;
        color: white;
    }


    .btn-delete {
        background-color: #dc3545;
        color: white;
        padding: 7px 13px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }


    .btn-delete:hover {
        background-color: #bb2d3b;
        color: white;
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


<div class="department-container">


    <!-- Header -->
    <div class="department-header">

        <h2>
            <i class="fa-solid fa-building"></i>
            Department List
        </h2>


        <div class="header-buttons">

            <a href="../departmenteacher/create.php"
               class="add-btn">

                <i class="fa-solid fa-user-plus"></i>
                Assign Teacher

            </a>


            <a href="create.php"
               class="add-btn">

                <i class="fa-solid fa-plus"></i>
                Add Department

            </a>

        </div>

    </div>


    <!-- Success Messages -->

    <?php if (
        isset($_GET['status']) &&
        $_GET['status'] === 'created'
    ): ?>

        <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check"></i>
            Department added successfully.
        </div>


    <?php elseif (
        isset($_GET['status']) &&
        $_GET['status'] === 'updated'
    ): ?>

        <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check"></i>
            Department updated successfully.
        </div>


    <?php elseif (
        isset($_GET['status']) &&
        $_GET['status'] === 'deleted'
    ): ?>

        <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check"></i>
            Department deleted successfully.
        </div>

    <?php endif; ?>


    <!-- Error Message -->

    <?php if (!empty($error_msg)): ?>

        <div class="alert-box alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <?= htmlspecialchars($error_msg) ?>

        </div>

    <?php endif; ?>


    <!-- Department Table -->

    <div class="table-box">

        <table class="department-table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Department Name</th>

                    <th>Created Date</th>

                    <th>Actions</th>

                </tr>

            </thead>


            <tbody>


            <?php if (count($departments) > 0): ?>


                <?php foreach ($departments as $department): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars(
                                $department['id']
                            ) ?>
                        </td>


                        <td>
                            <?= htmlspecialchars(
                                $department['name']
                            ) ?>
                        </td>


                        <td>

                            <?= date(
                                'd M Y',
                                strtotime(
                                    $department['created_at']
                                )
                            ) ?>

                        </td>


                        <td>

                            <!-- Edit -->

                            <a
                                href="edit.php?id=<?= $department['id'] ?>"
                                class="btn-edit"
                            >

                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit

                            </a>


                            <!-- Delete -->

                            <a
                                href="index.php?delete_id=<?= $department['id'] ?>"
                                class="btn-delete"
                                onclick="return confirm(
                                    'Are you sure you want to delete this department? All teacher assignments for this department will also be removed.'
                                );"
                            >

                                <i class="fa-solid fa-trash"></i>
                                Delete

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>


            <?php else: ?>


                <tr>

                    <td
                        colspan="4"
                        class="no-data"
                    >

                        <i class="fa-solid fa-folder-open"></i>
                        No departments found.

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>

        </table>

    </div>


</div>


</body>
</html>

