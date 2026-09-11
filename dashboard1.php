<?php


session_start();
include 'db.php';
include 'dashnav.php';


$noticestmt = $conn->prepare("SELECT id, title, description, notice_date FROM notices ORDER BY notice_date DESC LIMIT 3");
$noticestmt->execute();
$notices = $noticestmt->get_result();

$studentStmt = $conn->prepare("SELECT id, name, email, phone, created_at, status FROM users WHERE role='student' AND status='pending' ORDER BY created_at DESC LIMIT 3");
$studentStmt->execute();
$pendingStudent = $studentStmt->get_result();

$TeacherStmt = $conn->prepare(" SELECT id, name, email, phone, created_at, status FROM users WHERE role='teacher' AND status = 'pending' ORDER BY created_at DESC LIMIT 3");
$TeacherStmt->execute();
$teachersTotal= $TeacherStmt->get_result();

$approvedStmt= $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE role='student' AND status='approved'");
$approvedStmt->execute();
$approvedStudents= $approvedStmt->get_result()->fetch_assoc()["total"];
   
  $approvedT= $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE role='teacher' AND status='approved'");
$approvedT->execute();
$approvedTeachers= $approvedT->get_result()->fetch_assoc()["total"];

  $subject= $conn->prepare("SELECT COUNT(*) AS total FROM subjects");
$subject->execute();
$Tsubjects= $subject->get_result()->fetch_assoc()["total"];

  $classes= $conn->prepare("SELECT COUNT(*) AS total FROM exams");
$classes->execute();
$Tclasses= $classes->get_result()->fetch_assoc()["total"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
      <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    
<main class="dashboard-content">

    <div class="page-header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome back, <?= htmlspecialchars(explode(" ", $_SESSION["name"])[0]) ?> </p>
        </div>
       
            <div class="date-box">
    <p><strong>Today:</strong> <?= date("F d, Y") ?></p>
</div>
       
    </div>

    <!-- Simple Statistics -->
    <div class="dashboard-cards">

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <h3>Students</h3>
                <strong><?= $approvedStudents ?></strong>
                <p>Total Students</p>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div>
                <h3>Teachers</h3>
                <strong><?= $approvedTeachers ?></strong>
                <p>Total Teachers</p>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-school"></i>
            </div>
            <div>
                <h3>Classes</h3>
                <strong><?= $Tclasses ?></strong>
                <p>Active Classes</p>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <h3>Subjects</h3>
                <strong><?= $Tsubjects ?></strong>
                <p>Total Subjects</p>
            </div>
        </div>

    </div>


    <!-- Bottom Simple Sections -->
    <div class="dashboard-grid">

        <!-- Recent Notices -->
        <div class="dashboard-box">
            <div class="box-header">
                <h2>Recent Notices</h2>
                <a href="notice.php">View All</a>
            </div>
            <?php if($notices->num_rows > 0): ?>
                <?php while($notice = $notices->fetch_assoc()): ?>

            <div class="notice-item">
                <div class="notice-icon">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div class="notice-content">
                    <div>
                    <h4><?= htmlspecialchars($notice['title'])  ?></h4>
                    <p><?= htmlspecialchars($notice['description']) ?></p>
                </div>

                    <div>
                    <small><?= date("F d, Y", strtotime($notice["notice_date"])) ?></small>
                </div>
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

        <!-- Quick Actions -->
        <div class="dashboard-box">

            <div class="box-header">
                <h2>Quick Actions</h2>
            </div>

            <div class="quick-actions">

                <a href="#">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Add Student</span>
                </a>

                <a href="#">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Add Teacher</span>
                </a>

                <a href="#">
                    <i class="fa-solid fa-book"></i>
                    <span>Add Subject</span>
                </a>

                <a href="/sms4/notice/notice.php">
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
    <a href="#" >View All</a>
</div>
<?php if($pendingStudent->num_rows>0): ?>
<div class="student-list">
    <?php while ($student=$pendingStudent->fetch_assoc()): ?>
   <div class="list">

   <div class="first">
    <?= htmlspecialchars(substr($student["name"],0,1)) ?>
   </div>
   <div class="sinfo">
    <h2><?= htmlspecialchars($student["name"]) ?></h2>
    <p><?= htmlspecialchars($student["email"]) ?></p>
   </div>
 <div class="sdate">
    <small>
        <?= date("F d Y", strtotime($student["created_at"])) ?>
    </small>
 </div>
 <div class="statu">
 <?= htmlspecialchars($student["status"]) ?>
 </div>

 <a href="student-details.php?id=<?= $student["id"] ?>"
                           class="student-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php else: ?>

   </div>

            <div class="no-students">
                <i class="fa-solid fa-user-check"></i>
                <h2>No Pending Students</h2>
                <p>There are no students waiting for approval.</p>
            </div>

        <?php endif; ?>
</div>




    <div class="students">

        <div class="stu-head">
            <div>
                <h2>Teacher Registrations</h2>
                <p>Our Teachers</p>
            </div>

            <a href="teachers.php">View All</a>
        </div>

        <?php if ($teachersTotal->num_rows > 0): ?>

            <div class="student-list">

                <?php while ($teacher = $teachersTotal->fetch_assoc()): ?>

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
                                <?= date("d M Y", strtotime($teacher["created_at"])) ?>
                            </small>
                        </div>

                        <div class="statu">
 <?= htmlspecialchars($teacher["status"]) ?>
 </div>
                        <a href="teacher-details.php?id=<?= $teacher["id"] ?>"
                           class="student-view">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                    </div>

                <?php endwhile; ?>

            </div>

        <?php else: ?>

            <div class="no-students">
                <i class="fa-solid fa-chalkboard-user"></i>
                <h3>No Teachers Found</h3>
                <p>There are no teachers.</p>
            </div>

        <?php endif; ?>

    </div>

</div>

    </div>
        </div>

</main>


</body>
</html>