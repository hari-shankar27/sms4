<?php
// department.php (frontend only, no database)
include("programnavbar.php");

$departments = [
    ['id' => 1, 'name' => 'Computer Science', 'created_at' => '2024-01-15'],
    ['id' => 2, 'name' => 'Business Administration', 'created_at' => '2024-02-10'],
    ['id' => 3, 'name' => 'Electrical Engineering', 'created_at' => '2024-03-05'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .department-container {
            width: 90%;
            margin: 50px auto;
        }

        .department-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
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

        .department-table {
            width: 100%;
            border-collapse: collapse;
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

    <div class="department-container">

        <!-- Header -->
        <div class="department-header">
            <h2>Department List</h2>
            <a href="create.php" class="add-btn">Add Department</a>
        </div>

        <!-- Table -->
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
                                <td><?= htmlspecialchars($department['id']) ?></td>
                                <td><?= htmlspecialchars($department['name']) ?></td>
                                <td><?= date('d M Y', strtotime($department['created_at'])) ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $department['id'] ?>" class="btn-edit">Edit</a>

                                    <button type="button" class="btn-delete" onclick="return confirm('Are you sure you want to delete this department?')">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="no-data">No departments found.</td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>

</body>
</html>