

<?php 


session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
include "db.php";

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("SELECT name, role, profile FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

$profile = $user["profile"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
          <link rel="stylesheet" href="dashboard.css">

</head>
<body>

    <div class="topbar">
        <div class="top-left">
            <button class="btn" id="menuBtn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="logo">
                <div class="logo-icon">
                      <i class="fa-solid fa-school"></i>
                </div>
                <span>SchoolManage</span>
            </div>
        </div>
        <div class="top-right">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
 
            </div>
              <div class="notification">
                <i class="fa-regular fa-bell"></i>
                <span></span>
            </div>
            <div class="admin">
                 <div class="admin-avatar">

    <?php if (!empty($profile)): ?>

        <img src="<?= htmlspecialchars($profile) ?>"
             alt="Profile">

    <?php else: ?>

        <i class="fa-solid fa-user"></i>

    <?php endif; ?>

</div>
                    <div class="profile-toggle-area" onclick="toggleAdminMenu()">
               <div class="admin-info">
    <div class="admin-name">
          <?= htmlspecialchars(explode(" ", $_SESSION["name"])[0]) ?>
    </div>

    <div class="admin-role">
        <?php
        if ($_SESSION["role"] === "admin") {
            echo "Administrator";
        } elseif ($_SESSION["role"] === "teacher") {
            echo "Teacher";
        } elseif ($_SESSION["role"] === "student") {
            echo "Student";
        }
        ?>
    </div>
</div>
<div class="dropdown">           
<i class="fa-solid fa-chevron-down"></i>
</div>
</div>
    
            <div class="admin-menu" id="adminMenu">

        <a href="profile.php">
            <i class="fa-regular fa-user"></i>
            <span>My Profile</span>
        </a>

        <a href="setting.php">
            <i class="fa-solid fa-sliders"></i>
            <span>Settings</span>
        </a>

        <hr>

        <a href="logout.php" class="logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>

    </div>
    </div>

<div class="sidebars" id="sideBar">
   <div class="sidebar-title">
    Main Menu
   </div>
   <ul class="sidebar-menu">
    <li>
        <a href="#" class="active"><i class="fa-solid fa-gauge-high"></i><span>Dashboard</span></a>
    </li>
    <li>
        <a href="#"><i class="fa-solid fa-user-graduate"></i><span>Student</span></a>
    </li>

   
            <li>
                <a href="#"><i class="fa-solid fa-chalkboard-user"></i><span>Teachers</span></a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-school"></i><span>Classes</span></a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-book"></i><span>Subjects</span></a>
            </li>

            <!-- <li>
                <a href="#"><i class="fa-solid fa-calendar-check"></i><span>Attendance</span></a>
            </li> -->

            <li>
                <a href="#"><i class="fa-solid fa-file-pen"></i><span>Exams</span></a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-chart-column"></i><span>Results</span></a>
            </li>

        </ul>
<div class="sidebar-title">
    Management
</div>

<ul class="sidebar-menu">
 <li>
                <a href="#">  <i class="fa-solid fa-bullhorn"></i><span>Notices</span></a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-calendar-days"></i><span>Events</span>
                </a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-chart-pie"></i><span>Reports</span>
                </a>
            </li>

</ul>
<div class="sidebar-title">
            System
        </div>

        <ul class="sidebar-menu">

            <li>
                <a href="#"><i class="fa-solid fa-gear"></i><span>Settings</span>
                </a>
            </li>

            <li>
                <a href="#" class="logout"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span>
                </a>
            </li>

        </ul>
</div>

<script>

   
function toggleAdminMenu(){
    const menu = document.getElementById("adminMenu");
    const toggle = document.querySelector(".dropdown");

    menu.classList.toggle("show");
    toggle.classList.toggle("active");
}
/* Close when clicking outside */
document.addEventListener("click", function(event){

const admin = document.querySelector(".admin");
const menu = document.getElementById("adminMenu");
const toggle = document.querySelector(".dropdown");

if(!admin.contains(event.target)){
    menu.classList.remove("show");
    toggle.classList.remove("active");
}

} );

const menuBtn = document.getElementById("menuBtn");
const sideBar = document.getElementById("sideBar");

menuBtn.addEventListener("click", function(){
    sideBar.classList.toggle("icon");
})


    </script>



</body>
</html>