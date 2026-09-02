
<?php
session_start();

/*
|--------------------------------------------------------------------------
| Temporary teacher data
|--------------------------------------------------------------------------
| Later you can get these values from your database/session.
*/

$teacherName = "John Teacher";
$teacherRole = "Teacher";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Teacher Dashboard | SchoolManage</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

/* =====================================================
   RESET
===================================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {

    font-family: Arial, sans-serif;

    background: #f8fafc;

    color: #1e293b;

}


/* =====================================================
   DASHBOARD
===================================================== */

.dashboard {

    min-height: 100vh;

    display: flex;

}


/* =====================================================
   SIDEBAR
===================================================== */

.sidebar {

    width: 250px;

    height: 100vh;

    position: fixed;

    left: 0;

    top: 0;

    z-index: 1000;

    display: flex;

    flex-direction: column;

    background: #ffffff;

    border-right: 1px solid #e5e7eb;

    transition: .3s ease;

}


/* LOGO */

.sidebar-logo {

    height: 72px;

    padding: 0 20px;

    display: flex;

    align-items: center;

    gap: 11px;

    border-bottom: 1px solid #e5e7eb;

}

.logo-icon {

    width: 40px;

    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: linear-gradient(
        135deg,
        #4f46e5,
        #6366f1
    );

    color: #ffffff;

    font-size: 18px;

}

.logo-text {

    display: flex;

    flex-direction: column;

}

.logo-text strong {

    color: #0f172a;

    font-size: 16px;

}

.logo-text span {

    margin-top: 2px;

    color: #94a3b8;

    font-size: 9px;

}


/* =====================================================
   SIDEBAR MENU
===================================================== */

.sidebar-menu {

    flex: 1;

    padding: 20px 13px;

    overflow-y: auto;

}

.menu-label {

    padding: 0 12px;

    margin-bottom: 9px;

    color: #94a3b8;

    font-size: 10px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 1px;

}

.sidebar-menu a {

    position: relative;

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 11px 13px;

    margin-bottom: 4px;

    border-radius: 9px;

    color: #64748b;

    text-decoration: none;

    font-size: 13px;

    transition: .25s;

}

.sidebar-menu a i {

    width: 19px;

    text-align: center;

    font-size: 14px;

}

.sidebar-menu a:hover {

    color: #4f46e5;

    background: #f1f5ff;

}

.sidebar-menu a.active {

    color: #4f46e5;

    background: #eef2ff;

    font-weight: 600;

}

.sidebar-menu a.active::before {

    content: "";

    position: absolute;

    left: 0;

    top: 8px;

    width: 3px;

    height: calc(100% - 16px);

    border-radius: 0 5px 5px 0;

    background: #4f46e5;

}


/* =====================================================
   SIDEBAR BOTTOM
===================================================== */

.sidebar-bottom {

    padding: 13px;

    border-top: 1px solid #e5e7eb;

}

.sidebar-bottom a {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 11px 13px;

    border-radius: 9px;

    color: #64748b;

    text-decoration: none;

    font-size: 13px;

    transition: .25s;

}

.sidebar-bottom a:hover {

    color: #ef4444;

    background: #fef2f2;

}


/* =====================================================
   MAIN
===================================================== */

.main {

    width: calc(100% - 250px);

    margin-left: 250px;

    min-height: 100vh;

}


/* =====================================================
   TOPBAR
===================================================== */

.topbar {

    height: 72px;

    position: sticky;

    top: 0;

    z-index: 900;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 28px;

    background: #ffffff;

    border-bottom: 1px solid #e5e7eb;

}


/* LEFT */

.topbar-left {

    display: flex;

    align-items: center;

    gap: 15px;

}

.mobile-menu {

    display: none;

    width: 38px;

    height: 38px;

    border: none;

    border-radius: 9px;

    background: #f1f5f9;

    color: #334155;

    cursor: pointer;

}

.page-title h2 {

    color: #0f172a;

    font-size: 19px;

}

.page-title p {

    margin-top: 3px;

    color: #94a3b8;

    font-size: 11px;

}


/* RIGHT */

.topbar-right {

    display: flex;

    align-items: center;

    gap: 13px;

}


/* SEARCH */

.search {

    width: 210px;

    height: 39px;

    display: flex;

    align-items: center;

    gap: 8px;

    padding: 0 12px;

    border: 1px solid #e2e8f0;

    border-radius: 9px;

    background: #f8fafc;

}

.search i {

    color: #94a3b8;

    font-size: 12px;

}

.search input {

    width: 100%;

    border: none;

    outline: none;

    background: transparent;

    font-size: 12px;

}


/* NOTIFICATION */

.notification {

    position: relative;

    width: 39px;

    height: 39px;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 1px solid #e2e8f0;

    border-radius: 9px;

    background: #ffffff;

    color: #64748b;

    cursor: pointer;

}

.notification:hover {

    color: #4f46e5;

    background: #eef2ff;

}

.notification-dot {

    position: absolute;

    top: 7px;

    right: 8px;

    width: 6px;

    height: 6px;

    border-radius: 50%;

    background: #ef4444;

}


/* PROFILE */

.profile {

    display: flex;

    align-items: center;

    gap: 9px;

    padding: 4px 7px 4px 4px;

    border-radius: 10px;

    cursor: pointer;

}

.profile:hover {

    background: #f8fafc;

}

.avatar {

    width: 37px;

    height: 37px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 14px;

}

.profile-info {

    display: flex;

    flex-direction: column;

    gap: 2px;

}

.profile-info strong {

    color: #1e293b;

    font-size: 12px;

}

.profile-info span {

    color: #94a3b8;

    font-size: 10px;

}


/* =====================================================
   CONTENT
===================================================== */

.content {

    padding: 30px;

}


/* WELCOME */

.welcome {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 25px;

}

.welcome h1 {

    color: #0f172a;

    font-size: 25px;

}

.welcome p {

    margin-top: 6px;

    color: #64748b;

    font-size: 13px;

}

.date {

    padding: 10px 15px;

    border: 1px solid #e2e8f0;

    border-radius: 9px;

    background: #ffffff;

    color: #64748b;

    font-size: 12px;

}


/* =====================================================
   STAT CARDS
===================================================== */

.stats {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 17px;

    margin-bottom: 25px;

}

.stat-card {

    padding: 20px;

    border: 1px solid #e2e8f0;

    border-radius: 14px;

    background: #ffffff;

    transition: .25s;

}

.stat-card:hover {

    transform: translateY(-3px);

    box-shadow:
        0 12px 30px rgba(
            15,
            23,
            42,
            .07
        );

}

.stat-top {

    display: flex;

    align-items: center;

    justify-content: space-between;

}

.stat-icon {

    width: 43px;

    height: 43px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 11px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 17px;

}

.stat-card h3 {

    margin-top: 16px;

    color: #0f172a;

    font-size: 25px;

}

.stat-card p {

    margin-top: 4px;

    color: #94a3b8;

    font-size: 11px;

}


/* =====================================================
   CONTENT GRID
===================================================== */

.dashboard-grid {

    display: grid;

    grid-template-columns: 1.5fr 1fr;

    gap: 20px;

}


/* CARD */

.card {

    padding: 22px;

    border: 1px solid #e2e8f0;

    border-radius: 14px;

    background: #ffffff;

}

.card-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 20px;

}

.card-header h3 {

    color: #1e293b;

    font-size: 15px;

}

.card-header a {

    color: #4f46e5;

    text-decoration: none;

    font-size: 11px;

}


/* =====================================================
   TODAY'S CLASSES
===================================================== */

.class-item {

    display: flex;

    align-items: center;

    gap: 13px;

    padding: 13px 0;

    border-bottom: 1px solid #f1f5f9;

}

.class-item:last-child {

    border-bottom: none;

}

.class-time {

    width: 65px;

    color: #4f46e5;

    font-size: 11px;

    font-weight: 600;

}

.class-info {

    flex: 1;

}

.class-info strong {

    display: block;

    color: #334155;

    font-size: 13px;

}

.class-info span {

    display: block;

    margin-top: 4px;

    color: #94a3b8;

    font-size: 10px;

}

.class-status {

    padding: 5px 8px;

    border-radius: 6px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 9px;

}


/* =====================================================
   QUICK ACTIONS
===================================================== */

.quick-actions {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 11px;

}

.quick-action {

    padding: 15px;

    border: 1px solid #e2e8f0;

    border-radius: 10px;

    background: #f8fafc;

    color: #475569;

    text-decoration: none;

    transition: .25s;

}

.quick-action:hover {

    border-color: #c7d2fe;

    background: #eef2ff;

    color: #4f46e5;

}

.quick-action i {

    display: block;

    margin-bottom: 9px;

    color: #4f46e5;

    font-size: 18px;

}

.quick-action span {

    font-size: 11px;

    font-weight: 600;

}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 1100px) {

    .stats {

        grid-template-columns:
            repeat(2, 1fr);

    }

    .dashboard-grid {

        grid-template-columns: 1fr;

    }

    .search {

        width: 160px;

    }

}


@media (max-width: 800px) {

    .sidebar {

        left: -250px;

    }

    .sidebar.show {

        left: 0;

    }

    .main {

        width: 100%;

        margin-left: 0;

    }

    .mobile-menu {

        display: flex;

        align-items: center;

        justify-content: center;

    }

}


@media (max-width: 600px) {

    .topbar {

        padding: 0 15px;

    }

    .content {

        padding: 20px 15px;

    }

    .search {

        display: none;

    }

    .profile-info {

        display: none;

    }

    .welcome {

        align-items: flex-start;

        flex-direction: column;

        gap: 15px;

    }

    .stats {

        grid-template-columns: 1fr;

    }

}

</style>

</head>


<body>


<div class="dashboard">


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar" id="sidebar">


    <div class="sidebar-logo">

        <div class="logo-icon">

            <i class="fa-solid fa-school"></i>

        </div>

        <div class="logo-text">

            <strong>SchoolManage</strong>

            <span>
                School Management System
            </span>

        </div>

    </div>


    <div class="sidebar-menu">


        <div class="menu-label">
            Main Menu
        </div>


        <a href="teacher_dashboard.php"
           class="active">

            <i class="fa-solid fa-chart-pie"></i>

            Dashboard

        </a>


        <a href="teacher_students.php">

            <i class="fa-solid fa-user-graduate"></i>

            My Students

        </a>


        <a href="teacher_attendance.php">

            <i class="fa-solid fa-calendar-check"></i>

            Attendance

        </a>


        <a href="teacher_subjects.php">

            <i class="fa-solid fa-book"></i>

            My Subjects

        </a>


        <a href="teacher_results.php">

            <i class="fa-solid fa-square-poll-vertical"></i>

            Results

        </a>


        <a href="teacher_notices.php">

            <i class="fa-solid fa-bullhorn"></i>

            Notices

        </a>


        <div class="menu-label"
             style="margin-top:25px;">

            Account

        </div>


        <a href="teacher_profile.php">

            <i class="fa-regular fa-user"></i>

            My Profile

        </a>


        <a href="teacher_settings.php">

            <i class="fa-solid fa-gear"></i>

            Settings

        </a>


    </div>


    <div class="sidebar-bottom">

        <a href="logout.php">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>


</aside>



<!-- =====================================================
     MAIN
===================================================== -->

<main class="main">


<!-- TOPBAR -->

<header class="topbar">


    <div class="topbar-left">


        <button class="mobile-menu"
                id="mobileMenu">

            <i class="fa-solid fa-bars"></i>

        </button>


        <div class="page-title">

            <h2>
                Teacher Dashboard
            </h2>

            <p>
                Manage your classes and students
            </p>

        </div>


    </div>



    <div class="topbar-right">


        <div class="search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                placeholder="Search..."
            >

        </div>


        <button class="notification">

            <i class="fa-regular fa-bell"></i>

            <span class="notification-dot"></span>

        </button>


        <div class="profile">

            <div class="avatar">

                <i class="fa-solid fa-chalkboard-user"></i>

            </div>


            <div class="profile-info">

                <strong>
                    <?php echo htmlspecialchars($teacherName); ?>
                </strong>

                <span>
                    <?php echo htmlspecialchars($teacherRole); ?>
                </span>

            </div>

        </div>


    </div>

</header>



<!-- CONTENT -->

<section class="content">


    <div class="welcome">

        <div>

            <h1>
                Good Morning, Teacher! 👋
            </h1>

            <p>
                Here's what's happening with your classes today.
            </p>

        </div>


        <div class="date">

            <i class="fa-regular fa-calendar"></i>

            <?php echo date("F d, Y"); ?>

        </div>

    </div>



    <!-- =================================================
         STATISTICS
    ================================================== -->

    <div class="stats">


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">

                    <i class="fa-solid fa-user-graduate"></i>

                </div>

            </div>

            <h3>
                85
            </h3>

            <p>
                My Students
            </p>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">

                    <i class="fa-solid fa-chalkboard"></i>

                </div>

            </div>

            <h3>
                4
            </h3>

            <p>
                My Classes
            </p>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">

                    <i class="fa-solid fa-book"></i>

                </div>

            </div>

            <h3>
                6
            </h3>

            <p>
                My Subjects
            </p>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">

                    <i class="fa-solid fa-calendar-check"></i>

                </div>

            </div>

            <h3>
                92%
            </h3>

            <p>
                Today's Attendance
            </p>

        </div>


    </div>



    <!-- =================================================
         LOWER CONTENT
    ================================================== -->

    <div class="dashboard-grid">


        <!-- TODAY'S CLASSES -->

        <div class="card">

            <div class="card-header">

                <h3>
                    Today's Classes
                </h3>

                <a href="teacher_subjects.php">
                    View All
                </a>

            </div>


            <div class="class-item">

                <div class="class-time">
                    10:00 AM
                </div>

                <div class="class-info">

                    <strong>
                        Mathematics
                    </strong>

                    <span>
                        Class 10 · Room 204
                    </span>

                </div>

                <span class="class-status">
                    Upcoming
                </span>

            </div>


            <div class="class-item">

                <div class="class-time">
                    11:30 AM
                </div>

                <div class="class-info">

                    <strong>
                        Computer Science
                    </strong>

                    <span>
                        Class 9 · Computer Lab
                    </span>

                </div>

                <span class="class-status">
                    Upcoming
                </span>

            </div>


            <div class="class-item">

                <div class="class-time">
                    1:30 PM
                </div>

                <div class="class-info">

                    <strong>
                        Mathematics
                    </strong>

                    <span>
                        Class 8 · Room 105
                    </span>

                </div>

                <span class="class-status">
                    Upcoming
                </span>

            </div>


            <div class="class-item">

                <div class="class-time">
                    3:00 PM
                </div>

                <div class="class-info">

                    <strong>
                        Computer Science
                    </strong>

                    <span>
                        Class 10 · Lab 2
                    </span>

                </div>

                <span class="class-status">
                    Upcoming
                </span>

            </div>

        </div>



        <!-- QUICK ACTIONS -->

        <div class="card">

            <div class="card-header">

                <h3>
                    Quick Actions
                </h3>

            </div>


            <div class="quick-actions">


                <a href="teacher_attendance.php"
                   class="quick-action">

                    <i class="fa-solid fa-calendar-check"></i>

                    <span>
                        Mark Attendance
                    </span>

                </a>


                <a href="teacher_results.php"
                   class="quick-action">

                    <i class="fa-solid fa-square-poll-vertical"></i>

                    <span>
                        Enter Results
                    </span>

                </a>


                <a href="teacher_students.php"
                   class="quick-action">

                    <i class="fa-solid fa-users"></i>

                    <span>
                        View Students
                    </span>

                </a>


                <a href="teacher_notices.php"
                   class="quick-action">

                    <i class="fa-solid fa-bullhorn"></i>

                    <span>
                        View Notices
                    </span>

                </a>


            </div>

        </div>


    </div>


</section>


</main>

</div>



<script>

/* =====================================================
   MOBILE SIDEBAR
===================================================== */

const mobileMenu =
    document.getElementById("mobileMenu");

const sidebar =
    document.getElementById("sidebar");


mobileMenu.addEventListener(
    "click",
    function () {

        sidebar.classList.toggle("show");

    }
);


/* =====================================================
   CLOSE SIDEBAR WHEN CLICKING OUTSIDE
===================================================== */

document.addEventListener(
    "click",
    function (event) {

        if (
            window.innerWidth <= 800 &&
            !sidebar.contains(event.target) &&
            !mobileMenu.contains(event.target)
        ) {

            sidebar.classList.remove("show");

        }

    }
);

</script>


</body>

</html>

