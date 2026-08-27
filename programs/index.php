<?php

include "navbar.php";

$programs = [
    ["id" => 1, "name" => "Computer Science",  "created_at" => "2024-01-12"],
    ["id" => 2, "name" => "Business Studies",  "created_at" => "2024-02-03"],
    ["id" => 3, "name" => "Civil Engineering",  "created_at" => "2024-03-21"],
    ["id" => 4, "name" => "Electronics",        "created_at" => "2024-04-15"],
];

// Handle delete request (replace with real DB delete later)
if (isset($_GET['delete'])) {
    $deleteId = (int) $_GET['delete'];
    foreach ($programs as $key => $program) {
        if ($program['id'] === $deleteId) {
            unset($programs[$key]);
        }
    }
    // e.g. $pdo->prepare("DELETE FROM programs WHERE id = ?")->execute([$deleteId]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs - School Management System</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
        }

        .program-container {
            width: 90%;
            margin: 50px auto;
        }

        .program-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .program-header h2 {
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
        }

        .add-btn:hover {
            background-color: #157347;
            color: white;
        }

        .table-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.10);
            overflow: hidden;
        }

        .program-table {
            width: 100%;
            border-collapse: collapse;
        }

        .program-table thead {
            background-color: #0d6efd;
            color: white;
        }

        .program-table th,
        .program-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .program-table th {
            font-weight: 600;
        }

        .program-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .program-table td {
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
        }

        .btn-edit:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
        }

        .no-data {
            text-align: center !important;
            padding: 25px !important;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="program-container">

        <!-- Header -->
        <div class="program-header">
            <h2>Program List</h2>
            <a href="program-add.php" class="add-btn">Add Program</a>
        </div>

        <!-- Table -->
        <div class="table-box">
            <table class="program-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Program Name</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($programs)): ?>

                        <tr>
                            <td colspan="4" class="no-data">No programs found.</td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($programs as $program): ?>
                            <tr>
                                <td><?= $program['id'] ?></td>
                                <td><?= htmlspecialchars($program['name']) ?></td>
                                <td><?= date('d M Y', strtotime($program['created_at'])) ?></td>
                                <td>
                                    <a href="programs/edit.php?id=<?= $program['id'] ?>" class="btn-edit">Edit</a>

                                    <a href="?delete=<?= $program['id'] ?>" class="btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this program?')"
                                       style="display:inline-block; text-decoration:none;">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

</body>
</html>