<?php
include("../db.php");
include("../dashnav.php");

// Delete subject
if (isset($_GET['delete_id'])) {
    $id = (int) $_GET['delete_id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM subjects WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

   
    exit;
}

// Get subjects
$sql = "SELECT 
            subjects.id,
            subjects.name,
            subjects.code,
            subjects.credit,
            departments.name AS department_name
        FROM subjects
        LEFT JOIN departments
        ON subjects.department_id = departments.id
        ORDER BY subjects.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
          <link rel="stylesheet" href="../dashnav.css">

  
</head>
<style>
/* ==============================
   Subjects Container
================================= */

.container {
    width: calc(100% - 250px);
    margin-left: 250px;
    margin-top: 70px;
    padding: 20px;
    box-sizing: border-box;
    min-height: calc(100vh - 70px);
}


/* ==============================
   Header
================================= */

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}

.header h2 {
    margin: 0;
    color: #333;
    font-weight: 600;
}


/* ==============================
   Add Subject Button
================================= */

.add-btn {
    background-color: #198754;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    white-space: nowrap;
    display: inline-block;
}

.add-btn:hover {
    background-color: #157347;
    color: white;
}


/* ==============================
   Table Box
================================= */

.table-box {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
    overflow-x: auto;
}


/* ==============================
   Subject Table
================================= */

.table-box table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
}


/* Table Header */

.table-box thead {
    background-color: #0d6efd;
    color: white;
}


/* Table Cells */

.table-box th,
.table-box td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table-box th {
    font-weight: 600;
}

.table-box td {
    color: #444;
}


/* Row Hover */

.table-box tbody tr:hover {
    background-color: #f8f9fa;
}


/* ==============================
   Action Buttons
================================= */

.actions {
    display: flex;
    align-items: center;
    gap: 5px;
}


/* Edit Button */

.edit-btn {
    background-color: #ffc107;
    color: #212529;
    padding: 7px 13px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    display: inline-block;
}

.edit-btn:hover {
    background-color: #e0a800;
    color: #212529;
}


/* Delete Button */

.delete-btn {
    background-color: #dc3545;
    color: white;
    padding: 7px 13px;
    border-radius: 5px;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
}

.delete-btn:hover {
    background-color: #bb2d3b;
    color: white;
}


/* ==============================
   Responsive Design
================================= */

@media (max-width: 768px) {

    .container {
        width: 100%;
        margin-left: 0;
        margin-top: 70px;
        padding: 15px;
    }

    .header {
        flex-direction: column;
        align-items: flex-start;
    }

    .add-btn {
        width: fit-content;
    }

    .table-box table {
        min-width: 700px;
    }
}
</style>
<body>

<div class="container">

    <div class="header">
        <h2>Subjects</h2>

        <a href="create.php" class="add-btn">
            Add Subject
        </a>
    </div>

    <div class="table-box">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Credit</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php while ($subject = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?= $subject['id'] ?></td>

                    <td>
                        <?= htmlspecialchars($subject['name']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($subject['code']) ?>
                    </td>

                    <td>
                        <?= $subject['credit'] ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($subject['department_name'] ?? 'No Department') ?>
                    </td>

                    <td>
                        <div class="actions">

                            <a href="edit.php?id=<?= $subject['id'] ?>"
                               class="edit-btn">
                                Edit
                            </a>

                            <a href="index.php?delete_id=<?= $subject['id'] ?>"
                               class="delete-btn"
                               onclick="return confirm('Are you sure you want to delete this subject?');">
                                Delete
                            </a>

                        </div>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>

    </div>

</div>

</body>
</html>