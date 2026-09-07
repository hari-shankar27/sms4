<?php
// department-add.php (frontend only, no database)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Department</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .department-container {
            max-width: 600px;
            margin: 60px auto;
            padding: 35px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .department-container h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .department-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .department-form input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }

        .department-form input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .create-btn {
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .create-btn:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="department-container">

        <h1>Create Department</h1>

        <form action="department-add.php" method="POST" class="department-form">

            <input
                type="text"
                name="name"
                placeholder="Enter department name"
                required
            >

            <button type="submit" class="create-btn">
                Create Department
            </button>

        </form>

    </div>

</body>
</html>