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

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

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
            class="btn btn-success"
        >
            Save
        </button>

        <a
            href="departmentteacher.php"
            class="btn btn-secondary"
        >
            Back
        </a>

    </form>

</div>

</body>

</html>