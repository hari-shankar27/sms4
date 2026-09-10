<?php

include("../db.php");


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int) $_GET['id'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $department_id = (int) $_POST['department_id'];
    $teacher_id = (int) $_POST['teacher_id'];

    if ($department_id == 0 || $teacher_id == 0) {

        echo "<script>
                alert('Please select department and teacher.');
              </script>";

    } else {

        $check = mysqli_prepare(
            $conn,
            "SELECT id 
             FROM department_teacher
             WHERE department_id = ?
             AND teacher_id = ?
             AND id != ?"
        );

        mysqli_stmt_bind_param(
            $check,
            "iii",
            $department_id,
            $teacher_id,
            $id
        );

        mysqli_stmt_execute($check);

        $check_result = mysqli_stmt_get_result($check);


        if (mysqli_num_rows($check_result) > 0) {

            echo "<script>
                    alert('This teacher is already assigned to this department.');
                  </script>";

        } else {

            // Update assignment
            $stmt = mysqli_prepare(
                $conn,
                "UPDATE department_teacher
                 SET department_id = ?, teacher_id = ?
                 WHERE id = ?"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "iii",
                $department_id,
                $teacher_id,
                $id
            );


            if (mysqli_stmt_execute($stmt)) {

                echo "<script>
                        alert('Department teacher updated successfully.');
                        window.location.href='departmentteacher.php';
                      </script>";

                exit();

            } else {

                echo "<script>
                        alert('Error updating assignment.');
                      </script>";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check);
    }
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, department_id, teacher_id
     FROM department_teacher
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$departmentTeacher = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if (!$departmentTeacher) {

    echo "Department teacher assignment not found.";
    exit();
}

$department_query = mysqli_query(
    $conn,
    "SELECT id, name
     FROM departments
     ORDER BY name ASC"
);

$teacher_query = mysqli_query(
    $conn,
    "SELECT id, name
     FROM teachers
     ORDER BY name ASC"
);
include("../dashnav.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Department Teacher</title>
    
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
        <link rel="stylesheet" href="../dashnav.css">

</head>


<body>


<div class="container mt-5">

    <h2 class="mb-4">
        Edit Department Teacher
    </h2>


    <form action="" method="POST">

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


                <?php

                while ($department = mysqli_fetch_assoc($department_query)) {

                    $selected = "";

                    if (
                        $departmentTeacher['department_id']
                        == $department['id']
                    ) {

                        $selected = "selected";

                    }

                ?>

                    <option
                        value="<?php echo $department['id']; ?>"
                        <?php echo $selected; ?>
                    >

                        <?php
                        echo htmlspecialchars(
                            $department['name']
                        );
                        ?>

                    </option>

                <?php } ?>

            </select>

        </div>

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


                <?php

                while ($teacher = mysqli_fetch_assoc($teacher_query)) {

                    $selected = "";

                    if (
                        $departmentTeacher['teacher_id']
                        == $teacher['id']
                    ) {

                        $selected = "selected";

                    }

                ?>

                    <option
                        value="<?php echo $teacher['id']; ?>"
                        <?php echo $selected; ?>
                    >

                        <?php
                        echo htmlspecialchars(
                            $teacher['name']
                        );
                        ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update
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