<?php

include("../db.php");
include("../dashnav.php");

// Get subject ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];


// Handle Update

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $code = trim($_POST['code']);
    $credit = (int) $_POST['credit'];
    $department_id = (int) $_POST['department_id'];

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE subjects
         SET name = ?, code = ?, credit = ?, department_id = ?
         WHERE id = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssiii",
        $name,
        $code,
        $credit,
        $department_id,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php");
        exit;

    } else {

        $error = "Failed to update subject: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


// Get Subject


$stmt = mysqli_prepare(
    $conn,
    "SELECT id, name, code, credit, department_id
     FROM subjects
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$subject = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Subject doesn't exist
if (!$subject) {
    header("Location: index.php");
    exit;
}



// Get Departments


$department_query = "
    SELECT id, name
    FROM departments
    ORDER BY name ASC
";

$departments = mysqli_query($conn, $department_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Subject</title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
        <link rel="stylesheet" href="../dashnav.css">


    <style>

        body {
            background: #f4f7fc;
        }

        /* Container */

        .subject-container {
            max-width: 800px;
            margin: 50px auto;
        }

        /* Card */

        .subject-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,.15);
            transition: .3s;
        }

        .subject-card:hover {
            transform: translateY(-5px);
        }

        /* Header */

        .subject-header {
            background: linear-gradient(135deg,#f59e0b,#d97706);
            color: white;
            padding: 20px;
        }

        .subject-header h3 {
            margin: 0;
            font-weight: 700;
            letter-spacing: .5px;
        }

        /* Body */

        .subject-body {
            background: white;
            padding: 35px;
        }

        /* Labels */

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        /* Inputs */

        .form-control,
        .form-select {

            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 12px;
            transition: .3s;
            box-shadow: none;

        }

        .form-control:focus,
        .form-select:focus {

            border-color: #f59e0b;
            box-shadow: 0 0 10px rgba(245,158,11,.30);

        }

        /* Buttons */

        .btn-update {

            background: #f59e0b;
            color: white;
            padding: 10px 28px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: .3s;

        }

        .btn-update:hover {

            background: #d97706;
            color: white;
            transform: translateY(-3px);

        }

        .btn-cancel {

            background: #6b7280;
            color: white;
            padding: 10px 28px;
            border-radius: 10px;
            text-decoration: none;
            transition: .3s;

        }

        .btn-cancel:hover {

            background: #4b5563;
            color: white;
            transform: translateY(-3px);

        }

        .required {
            color: red;
        }

    </style>

</head>


<body>


<?php


 include("../navbar.php");

?>


<div class="container subject-container">

    <div class="card subject-card">


        <!-- Header -->

        <div class="subject-header">

            <h3>✏️ Edit Subject</h3>

        </div>


        <!-- Body -->

        <div class="subject-body">


            <?php if (isset($error)): ?>

                <div class="alert alert-danger">

                    <?php echo htmlspecialchars($error); ?>

                </div>

            <?php endif; ?>


            <form action="" method="POST">


                <!-- Subject Name -->

                <div class="mb-4">

                    <label class="form-label">

                        Subject Name
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo htmlspecialchars($subject['name']); ?>"
                        required
                    >

                </div>


                <!-- Subject Code -->

                <div class="mb-4">

                    <label class="form-label">

                        Subject Code
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="code"
                        class="form-control"
                        value="<?php echo htmlspecialchars($subject['code']); ?>"
                        required
                    >

                </div>


                <!-- Credit -->

                <div class="mb-4">

                    <label class="form-label">

                        Credit Hours
                        <span class="required">*</span>

                    </label>

                    <input
                        type="number"
                        name="credit"
                        class="form-control"
                        value="<?php echo htmlspecialchars($subject['credit']); ?>"
                        min="1"
                        required
                    >

                </div>


                <!-- Department -->

                <div class="mb-4">

                    <label class="form-label">

                        Department
                        <span class="required">*</span>

                    </label>


                    <select
                        name="department_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Select Department
                        </option>


                        <?php while ($department = mysqli_fetch_assoc($departments)): ?>

                            <option
                                value="<?php echo $department['id']; ?>"
                                <?php
                                if ($subject['department_id'] == $department['id']) {
                                    echo "selected";
                                }
                                ?>
                            >

                                <?php echo htmlspecialchars($department['name']); ?>

                            </option>

                        <?php endwhile; ?>


                    </select>

                </div>


                <!-- Buttons -->

                <button
                    type="submit"
                    class="btn btn-update"
                >
                    💾 Update Subject
                </button>


                <a
                    href="index.php"
                    class="btn btn-cancel"
                >
                    ✖ Cancel
                </a>


            </form>

        </div>

    </div>

</div>


</body>

</html>