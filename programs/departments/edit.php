<?php
// department-edit.php (frontend only, no database)

// Sample data - normally this would come from a database lookup by ID
$department = [
    'id' => 1,
    'name' => 'Computer Science',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            background-color: #0d6efd;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-update:hover {
            background-color: #0b5ed7;
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
    </style>
</head>
<body>

    <div class="department-container">

        <div class="department-card">

            <h1>Edit Department</h1>

            <form action="department-edit.php" method="POST">

                <input type="hidden" name="id" value="<?= htmlspecialchars($department['id']) ?>">

                <div class="form-group">
                    <label for="name">Department Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="<?= htmlspecialchars($department['name']) ?>"
                        placeholder="Enter department name"
                        required
                    >
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-update">Update Department</button>
                    <a href="department.php" class="btn-cancel">Cancel</a>
                </div>

            </form>

        </div>

    </div>

</body>
</html>