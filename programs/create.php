<?php

include "navbar.php";

// Handle form submission (replace with a real DB insert later)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name !== '') {
        // e.g. $pdo->prepare("INSERT INTO programs (name, created_at) VALUES (?, NOW())")->execute([$name]);
    }

    header("Location: create.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Program - School Management System</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6fb;
            margin: 0;
        }

        .program-container {
            max-width: 600px;
            margin: 60px auto;
            padding: 35px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .program-container h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .program-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .program-form input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }

        .program-form input:focus {
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

    <div class="program-container">

        <h1>Create Program</h1>

        <form action="programs/create.php" method="POST" class="program-form">

            <input
                type="text"
                name="name"
                placeholder="Enter program name"
                required
            >

            <button type="submit" class="create-btn">Create Program</button>

        </form>

    </div>

</body>
</html>