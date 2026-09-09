
<?php
include("../db.php");
// include("../dashnav.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $code = trim($_POST["code"]);
    $credit = (int) $_POST["credit"];
    $department_id = (int) $_POST["department_id"];

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO subjects (name, code, credit, department_id)
         VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssii",
        $name,
        $code,
        $credit,
        $department_id
    );

    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}

$departments = mysqli_query(
    $conn,
    "SELECT id, name FROM departments ORDER BY name ASC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Subject</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"> 

        <link rel="stylesheet" href="../dashnav.css">
    </head>
   <style>
    body {
        background: #f4f7fc;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* Main Container */
    .subject-container {
        width: calc(100% - 250px);
        margin-left: 250px;
        margin-top: 70px;
        padding: 30px;
        box-sizing: border-box;
        min-height: calc(100vh - 70px);
    }

    /* Subject Card */
    .subject-card {
        max-width: 800px;
        margin: 0 auto;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        background: white;
    }

    /* Header */
    .subject-header {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        padding: 20px 25px;
    }

    .subject-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 22px;
    }

    /* Form Body */
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

    /* Input and Select */
    .form-control,
    .form-select {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        box-sizing: border-box;
        transition: all 0.2s ease;
    }

    /* Focus */
    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 8px rgba(37, 99, 235, 0.2);
    }

    /* Save Button */
    .btn-save {
        background: #16a34a;
        color: white;
        padding: 10px 28px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: #15803d;
        color: white;
    }

    /* Back Button */
    .btn-back {
        background: #6b7280;
        color: white;
        padding: 10px 28px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-block;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #4b5563;
        color: white;
    }

    /* Required Star */
    .required {
        color: red;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 20px;
    }

    /* Error Message */
    .error-message {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .subject-container {
            width: 100%;
            margin-left: 0;
            padding: 20px;
            margin-top: 70px;
        }

        .subject-body {
            padding: 25px;
        }

        .subject-header {
            padding: 18px 20px;
        }

        .subject-header h3 {
            font-size: 20px;
        }
    }

    @media (max-width: 480px) {

        .subject-container {
            padding: 15px;
        }

        .subject-body {
            padding: 20px;
        }

        .btn-save,
        .btn-back {
            padding: 9px 20px;
        }
    }
  
</style>


<body>


<div class="container subject-container">

    <div class="card subject-card">

        <div class="subject-header">
            <h4>Add New Subject</h4>
        </div>

        <div class="subject-body">

            <form method="POST">

                <div class="mb-4">
                    <label class="form-label">
                        Subject Name <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Enter Subject Name"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Subject Code <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="code"
                        class="form-control"
                        placeholder="Example: CS101"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Credit Hours <span class="required">*</span>
                    </label>

                    <input
                        type="number"
                        name="credit"
                        class="form-control"
                        placeholder="Enter Credit"
                        min="1"
                        required
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Department <span class="required">*</span>
                    </label>

                    <select
                        name="department_id"
                        class="form-select"
                        required
                    >
                        <option value="">Select Department</option>

                        <?php while ($department = mysqli_fetch_assoc($departments)) { ?>

                            <option value="<?= $department['id'] ?>">
                                <?= htmlspecialchars($department['name']) ?>
                            </option>

                        <?php } ?>

                    </select>
                </div>

                <button type="submit" class="btn btn-save">
                    Save Subject
                </button>

                <a href="index.php" class="btn btn-back">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>

