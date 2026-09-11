<?php

include("../db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $department_id = (int) $_POST["department_id"];
    $teacher_id = (int) $_POST["teacher_id"];

    // Validation
    if ($department_id == 0 || $teacher_id == 0) {

        echo "<script>
                alert('Please select both department and teacher.');
              </script>";

    } else {

        // Check if teacher is already assigned to this department
        $check = mysqli_prepare(
            $conn,
            "SELECT * FROM teachersdepartments
             WHERE department_id = ? AND teacher_id = ?"
        );

        mysqli_stmt_bind_param(
            $check,
            "ii",
            $department_id,
            $teacher_id
        );

        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {

            echo "<script>
                    alert('This teacher is already assigned to this department.');
                  </script>";

        } else {

            // Insert assignment
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO teachersdepartments
                (department_id, teacher_id)
                VALUES (?, ?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "ii",
                $department_id,
                $teacher_id
            );

            if (mysqli_stmt_execute($stmt)) {

                echo "<script>
                        alert('Teacher assigned successfully.');
                        window.location.href='index.php';
                      </script>";

            } else {

                echo "<script>
                        alert('Error assigning teacher: " . mysqli_error($conn) . "');
                      </script>";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check);
    }
}

include("../dashnav.php");

// Get departments
$department_query = mysqli_query(
    $conn,
    "SELECT id, name FROM departments ORDER BY name ASC"
);


// Get teachers
$teacher_query = mysqli_query(
    $conn,
    "SELECT id, name FROM teachers ORDER BY name ASC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assign Teacher</title>

    
<style>
* {
    box-sizing: border-box;
    font-family: inherit;
}

body {
    margin: 0;
    background: #f5f7fb;
    
}

.container {
    margin-left: 250px;
    min-height: 100vh;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    padding: 30px;
    transition: margin-left 0.3s ease;
}
body.sidebar-collapsed .container{
    margin-left: 80px;
}

.container h2 {
    width: 100%;
    max-width: 500px;
    margin: 0 0 20px;
    color: #333;
    font-size: 26px;
    font-weight: 600;
}

.container form {
    width: 100%;
    max-width: 500px;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.mb-3 {
    margin-bottom: 18px;
}

.form-label {
    display: block;
    margin-bottom: 7px;
    color: #444;
    font-size: 14px;
    font-weight: 600;
}

.form-control {
    width: 100%;
    padding: 11px 13px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    background: white;
    outline: none;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

.btn2 {
    display: inline-block;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    font-size: 15px;
    cursor: pointer;
}

.btn-success {
    background: #198754;
    color: white;
}

.btn-success:hover {
    background: #157347;
}

.btn-secondary {
    background: #6c757d;
    color: white;
    margin-left: 6px;
}

.btn-secondary:hover {
    background: #5c636a;
}

@media (max-width: 700px) {
    .container {
        margin-left: 0;
        padding: 20px;
    }

    .container form {
        padding: 20px;
    }
}
</style>
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">
        Assign Teacher to Department
    </h2>

    <form action="" method="POST">

        <!-- Department -->

        <div class="mb-3">

            <label class="form-label">
                Department
            </label>

            <select
                name="department_id"
                class="form-control"
                required
            >

                <option value="">
                    Select Department
                </option>

                <?php while ($department = mysqli_fetch_assoc($department_query)) { ?>

                    <option value="<?php echo $department['id']; ?>">

                        <?php echo htmlspecialchars($department['name']); ?>

                    </option>

                <?php } ?>

            </select>

        </div>


        <!-- Teacher -->

        <div class="mb-3">

            <label class="form-label">
                Teacher
            </label>

            <select
                name="teacher_id"
                class="form-control"
                required
            >

                <option value="">
                    Select Teacher
                </option>

                <?php while ($teacher = mysqli_fetch_assoc($teacher_query)) { ?>

                    <option value="<?php echo $teacher['id']; ?>">

                        <?php echo htmlspecialchars($teacher['name']); ?>

                    </option>

                <?php } ?>

            </select>

        </div>


        <!-- Buttons -->

        <button
            type="submit"
            class="btn2 btn-success"
        >
            Save
        </button>

        <a
            href="departmentteacher.php"
            class="btn2 btn-secondary"
        >
            Back
        </a>

    </form>

</div>

</body>

</html>