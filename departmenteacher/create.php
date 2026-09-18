
<?php
include("../db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $department_id = (int)($_POST["department_id"] ?? 0);
    $teacher_id = (int)($_POST["teacher_id"] ?? 0);

    if (!$department_id || !$teacher_id) {
        $error = "Please select both department and teacher.";
    } else {
        $check = mysqli_prepare(
            $conn,
            "SELECT id FROM teachersdepartments
             WHERE department_id = ? AND teacher_id = ?"
        );

        mysqli_stmt_bind_param($check, "ii", $department_id, $teacher_id);
        mysqli_stmt_execute($check);

        $result = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($result) > 0) {
            $error = "This teacher is already assigned to this department.";
        } else {
            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO teachersdepartments
                (department_id, teacher_id, created_at, updated_at)
                VALUES (?, ?, NOW(), NOW())"
            );

            mysqli_stmt_bind_param($stmt, "ii", $department_id, $teacher_id);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php?status=created");
                exit;
            }

            $error = "Failed to assign teacher.";
            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($check);
    }
}

$departments = mysqli_query(
    $conn,
    "SELECT id, name FROM departments ORDER BY name ASC"
);

$teachers = mysqli_query(
    $conn,
    "SELECT id, name FROM teachers ORDER BY name ASC"
);

include("../dashnav.php");
?>

<style>
.assign-page {
    margin-left: 250px;
    min-height: 100vh;
    padding: 90px 30px 40px;

    display: flex;
    justify-content: center;
    align-items: center;

    transition: margin-left 0.3s ease;
}

body.sidebar-collapsed .assign-page {
    margin-left: 80px;
}

.assign-box {
    width: 100%;
    max-width: 520px;
    padding: 32px;

    background: #ffffff;
    border-radius: 10px;

    box-shadow: 0 10px 30px rgba(15, 47, 87, 0.12);
}

.assign-header {
    text-align: center;
    margin-bottom: 25px;
}

.assign-icon {
    width: 55px;
    height: 55px;
    margin: 0 auto 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eff6ff;
    color: #2563eb;

    border-radius: 50%;
    font-size: 23px;
}

.assign-header h2 {
    margin: 0;
    color: #0f2f57;
    font-size: 24px;
    font-weight: 700;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;

    color: #334155;
    font-size: 14px;
    font-weight: 600;
}

.form-control {
    width: 100%;
    padding: 12px;

    border: 1px solid #d1d5db;
    border-radius: 7px;

    background: #ffffff;
    color: #333;
    font-size: 15px;

    outline: none;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.actions {
    display: flex;
    gap: 10px;
    margin-top: 25px;
}

.assign-btn {
    flex: 1;
    padding: 11px;

    border: none;
    border-radius: 7px;

    text-align: center;
    text-decoration: none;

    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.save-btn {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #ffffff;
}

.save-btn:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
}

.back-btn {
    background: #e5e7eb;
    color: #374151;
}

.back-btn:hover {
    background: #d1d5db;
}

.error {
    margin-bottom: 18px;
    padding: 11px 14px;

    background: #fef2f2;
    color: #b42318;

    border: 1px solid #fecaca;
    border-radius: 7px;

    font-size: 14px;
}

@media (max-width: 700px) {
    .assign-page {
        margin-left: 0;
        padding: 30px 20px;
    }

    .assign-box {
        padding: 24px;
    }

    .actions {
        flex-direction: column;
    }
}
</style>

<div class="assign-page">

    <div class="assign-box">

        <div class="assign-header">
            <div class="assign-icon">
                <i class="fa-solid fa-user-plus"></i>
            </div>

            <h2>Assign Teacher to Department</h2>
        </div>

        <?php if ($error): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-group">
                <label>Department</label>

                <select name="department_id" class="form-control" required>
                    <option value="">Select Department</option>

                    <?php while ($department = mysqli_fetch_assoc($departments)): ?>
                        <option value="<?= $department["id"] ?>">
                            <?= htmlspecialchars($department["name"]) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Teacher</label>

                <select name="teacher_id" class="form-control" required>
                    <option value="">Select Teacher</option>

                    <?php while ($teacher = mysqli_fetch_assoc($teachers)): ?>
                        <option value="<?= $teacher["id"] ?>">
                            <?= htmlspecialchars($teacher["name"]) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="actions">

                <button type="submit" class="assign-btn save-btn">
                    <i class="fa-solid fa-link"></i>
                    Assign Teacher
                </button>

                <a href="index.php" class="assign-btn back-btn">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>

            </div>

        </form>

    </div>

</div>
