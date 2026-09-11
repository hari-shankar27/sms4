
<?php

session_start();
include "db.php";

function countData($conn, $table, $condition = "") {
    $sql = "SELECT COUNT(*) AS total FROM $table";
    if ($condition) $sql .= " WHERE $condition";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc()['total'];
}

$approvedStudents = countData(
    $conn,
    "users",
    "role='student' AND status='approved'"
);

$approvedTeachers = countData(
    $conn,
    "users",
    "role='teacher' AND status='approved'"
);

$totalClasses = countData($conn, "classes");
$totalSubjects = countData($conn, "subjects");


$stmt = $conn->prepare("
    SELECT id, title, description, created_at
    FROM notices
    ORDER BY created_at DESC
    LIMIT 3
");
$stmt->execute();
$notices = $stmt->get_result();


$stmt = $conn->prepare("
    SELECT id, name, email, created_at, status
    FROM users
    WHERE role='student' AND status='pending'
    ORDER BY created_at DESC
    LIMIT 3
");
$stmt->execute();
$pendingStudents = $stmt->get_result();


$stmt = $conn->prepare("
    SELECT id, name, email, created_at, status
    FROM users
    WHERE role='teacher'
    ORDER BY created_at DESC
    LIMIT 3
");
$stmt->execute();
$teachers = $stmt->get_result();

include "dashnav.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="dashboard.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<main class="dashboard-content">

    <div class="page-header">

        <div>
            <h1>Dashboard</h1>

            <p>
                Welcome back,
                <?= htmlspecialchars(
                    explode(" ", $_SESSION["name"] ?? "Admin")[0]
                ) ?>
            </p>
        </div>

        <div class="date-box">
            <p>
                <strong>Today:</strong>
                <?= date("F d, Y") ?>
            </p>
        </div>

    </div>


    <div class="dashboard-cards">

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-user-graduate"></i>
            </div>

            <div>
                <h3>Students</h3>
                <strong><?= $approvedStudents ?></strong>
                <p>Approved Students</p>
            </div>
        </div>


        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>

            <div>
                <h3>Teachers</h3>
                <strong><?= $approvedTeachers ?></strong>
                <p>Approved Teachers</p>
            </div>
        </div>


        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div>
                <h3>Classes</h3>
                <strong><?= $totalClasses ?></strong>
                <p>Total Classes</p>
            </div>
        </div>


        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-book"></i>
            </div>

            <div>
                <h3>Subjects</h3>
                <strong><?= $totalSubjects ?></strong>
                <p>Total Subjects</p>
            </div>
        </div>

    </div>


    <div class="dashboard-grid">

        <div class="dashboard-box">

            <div class="box-header">
                <h2>Recent Notices</h2>
                <a href="notice.php">View All</a>
            </div>

            <?php if ($notices->num_rows): ?>

                <?php while ($notice = $notices->fetch_assoc()): ?>

                    <div class="notice-item">

                        <div class="notice-icon">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>

                        <div class="notice-content">

                            <div>
                                <h4>
                                    <?= htmlspecialchars($notice['title']) ?>
                                </h4>

                                <p>
                                    <?= htmlspecialchars($notice['description']) ?>
                                </p>
                            </div>

                            <small>
                                <?= date(
                                    "F d, Y",
                                    strtotime($notice["created_at"])
                                ) ?>
                            </small>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="no-notice">
                    <i class="fa-regular fa-bell-slash"></i>
                    <p>No recent notices available.</p>
                </div>

            <?php endif; ?>

        </div>


        <div class="dashboard-box">

            <div class="box-header">
                <h2>Quick Actions</h2>
            </div>

            <div class="quick-actions">

                <a href="student-add.php">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Add Student</span>
                </a>

                <a href="teacher-add.php">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Add Teacher</span>
                </a>

                <a href="subjects/create.php">
                    <i class="fa-solid fa-book"></i>
                    <span>Add Subject</span>
                </a>

                <a href="create-notice.php">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Create Notice</span>
                </a>

            </div>

        </div>

    </div>


    <div class="student-grid">


        <div class="students">

            <div class="stu-head">

                <div>
                    <h2>Pending Student Registrations</h2>
                    <p>Students waiting for admin approval</p>
                </div>

                <a href="students.php">View All</a>

            </div>


            <?php if ($pendingStudents->num_rows): ?>

                <div class="student-list">

                    <?php while ($student = $pendingStudents->fetch_assoc()): ?>

                        <div class="list">

                            <div class="first">
                                <?= strtoupper(substr($student["name"], 0, 1)) ?>
                            </div>

                            <div class="sinfo">

                                <h3>
                                    <?= htmlspecialchars($student["name"]) ?>
                                </h3>

                                <p>
                                    <?= htmlspecialchars($student["email"]) ?>
                                </p>

                            </div>

                            <div class="sdate">
                                <small>
                                    <?= date(
                                        "d M Y",
                                        strtotime($student["created_at"])
                                    ) ?>
                                </small>
                            </div>

                            <div class="statu">
                                <?= htmlspecialchars($student["status"]) ?>
                            </div>

                            <a
                                href="student-details.php?id=<?= $student["id"] ?>"
                                class="student-view"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </a>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="no-students">

                    <i class="fa-solid fa-user-check"></i>

                    <h3>No Pending Students</h3>

                    <p>No students are waiting for approval.</p>

                </div>

            <?php endif; ?>

        </div>


        <div class="students">

            <div class="stu-head">

                <div>
                    <h2>Teacher Registrations</h2>
                    <p>Latest enrolled teachers</p>
                </div>

                <a href="teachers.php">View All</a>

            </div>


            <?php if ($teachers->num_rows): ?>

                <div class="student-list">

                    <?php while ($teacher = $teachers->fetch_assoc()): ?>

                        <div class="list">

                            <div class="first">
                                <?= strtoupper(substr($teacher["name"], 0, 1)) ?>
                            </div>

                            <div class="sinfo">

                                <h3>
                                    <?= htmlspecialchars($teacher["name"]) ?>
                                </h3>

                                <p>
                                    <?= htmlspecialchars($teacher["email"]) ?>
                                </p>

                            </div>

                            <div class="sdate">
                                <small>
                                    <?= date(
                                        "d M Y",
                                        strtotime($teacher["created_at"])
                                    ) ?>
                                </small>
                            </div>

                            <div class="statu">
                                <?= htmlspecialchars($teacher["status"]) ?>
                            </div>

                            <a
                                href="teacher-details.php?id=<?= $teacher["id"] ?>"
                                class="student-view"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </a>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="no-students">

                    <i class="fa-solid fa-chalkboard-user"></i>

                    <h3>No Teachers Found</h3>

                    <p>There are no registered teachers.</p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</main>
</body>
</html>
