```php
<?php
session_start();

/*
|--------------------------------------------------------------------------
| Temporary student data
|--------------------------------------------------------------------------
| Later connect these values with your database/session.
*/

$studentName = "Hari Shankar";
$studentRole = "Student";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard | SchoolManage</title>

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
   MENU
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
   BOTTOM
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
   GRID
===================================================== */

.dashboard-grid {

    display: grid;

    grid-template-columns: 1.5fr 1fr;

    gap: 20px;

}

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
   ATTENDANCE
===================================================== */

.attendance-box {

    display: flex;

    align-items: center;

    gap: 20px;

}

.attendance-circle {

    width: 105px;

    height: 105px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    border: 9px solid #eef2ff;

    color: #4f46e5;

    font-size: 21px;

    font-weight: 700;

}

.attendance-info h3 {

    color: #1e293b;

    font-size: 15px;

}

.attendance-info p {

    margin-top: 6px;

    color: #94a3b8;

    font-size: 11px;

}


/* =====================================================
   SUBJECTS
===================================================== */

.subject-item {

    display: flex;

    align-items: center;

    gap: 12px;

    padding: 12px 0;

    border-bottom: 1px solid #f1f5f9;

}

.subject-item:last-child {

    border-bottom: none;

}

.subject-icon {

    width: 38px;

    height: 38px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 9px;

    background: #eef2ff;

    color: #4f46e5;

}

.subject-info {

    flex: 1;

}

.subject-info strong {

    display: block;

    color: #334155;

    font-size: 12px;

}

.subject-info span {

    display: block;

    margin-top: 4px;

    color: #94a3b8;

    font-size: 10px;

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

        flex-direction: column;

        align-items: flex-start;

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


        <a href="student_dashboard.php"
           class="active">

            <i class="fa-solid fa-chart-pie"></i>

            Dashboard

        </a>


        <a href="student_attendance.php">

            <i class="fa-solid fa-calendar-check"></i>

            My Attendance

        </a>


        <a href="student_subjects.php">

            <i class="fa-solid fa-book"></i>

            My Subjects

        </a>


        <a href="student_results.php">

            <i class="fa-solid fa-square-poll-vertical"></i>

            My Results

        </a>


        <a href="student_notices.php">

            <i class="fa-solid fa-bullhorn"></i>

            Notices

        </a>


        <div class="menu-label"
             style="margin-top:25px;">

            Account

        </div>


        <a href="student_profile.php">

            <i class="fa-regular fa-user"></i>

            My Profile

        </a>


        <a href="student_settings.php">

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


<header class="topbar">


    <div class="topbar-left">


        <button class="mobile-menu"
                id="mobileMenu">

            <i class="fa-solid fa-bars"></i>

        </button>


        <div class="page-title">

            <h2>
                Student Dashboard
            </h2>

            <p>
                View your academic information
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

                <i class="fa-solid fa-user-graduate"></i>

            </div>


            <div class="profile-info">

                <strong>
                    <?php echo htmlspecialchars($studentName); ?>
                </strong>

                <span>
                    <?php echo htmlspecialchars($studentRole); ?>
                </span>

            </div>

        </div>


    </div>

</header>



<!-- =====================================================
     CONTENT
===================================================== -->

<section class="content">


    <div class="welcome">

        <div>

            <h1>
                Welcome Back, <?php echo htmlspecialchars($studentName); ?>! 👋
            </h1>

            <p>
                Here's an overview of your academic progress.
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

            <div class="stat-icon">

                <i class="fa-solid fa-calendar-check"></i>

            </div>

            <h3>
                94%
            </h3>

            <p>
                Attendance
            </p>

        </div>


        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-book"></i>

            </div>

            <h3>
                6
            </h3>

            <p>
                My Subjects
            </p>

        </div>


        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-square-poll-vertical"></i>

            </div>

            <h3>
                3.65
            </h3>

            <p>
                Current GPA
            </p>

        </div>


        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-ranking-star"></i>

            </div>

            <h3>
                8th
            </h3>

            <p>
                Class Rank
            </p>

        </div>


    </div>



    <!-- =================================================
         LOWER CONTENT
    ================================================== -->

    <div class="dashboard-grid">


        <!-- ATTENDANCE -->

        <div class="card">

            <div class="card-header">

                <h3>
                    My Attendance
                </h3>

                <a href="student_attendance.php">
                    View Details
                </a>

            </div>


            <div class="attendance-box">


                <div class="attendance-circle">

                    94%

                </div>


                <div class="attendance-info">

                    <h3>
                        Excellent Attendance
                    </h3>

                    <p>
                        Present: 47 days
                    </p>

                    <p>
                        Absent: 3 days
                    </p>

                    <p>
                        Total: 50 days
                    </p>

                </div>


            </div>

        </div>



        <!-- SUBJECTS -->

        <div class="card">

            <div class="card-header">

                <h3>
                    My Subjects
                </h3>

                <a href="student_subjects.php">
                    View All
                </a>

            </div>


            <div class="subject-item">

                <div class="subject-icon">

                    <i class="fa-solid fa-calculator"></i>

                </div>

                <div class="subject-info">

                    <strong>
                        Mathematics
                    </strong>

                    <span>
                        Mr. John
                    </span>

                </div>

            </div>


            <div class="subject-item">

                <div class="subject-icon">

                    <i class="fa-solid fa-laptop-code"></i>

                </div>

                <div class="subject-info">

                    <strong>
                        Computer Science
                    </strong>

                    <span>
                        Mr. David
                    </span>

                </div>

            </div>


            <div class="subject-item">

                <div class="subject-icon">

                    <i class="fa-solid fa-flask"></i>

                </div>

                <div class="subject-info">

                    <strong>
                        Science
                    </strong>

                    <span>
                        Mrs. Sarah
                    </span>

                </div>

            </div>


        </div>



    </div>



    <!-- =================================================
         QUICK ACTIONS
    ================================================== -->

    <div class="card"
         style="margin-top:20px;">


        <div class="card-header">

            <h3>
                Quick Access
            </h3>

        </div>


        <div class="quick-actions">


            <a href="student_attendance.php"
               class="quick-action">

                <i class="fa-solid fa-calendar-check"></i>

                <span>
                    View Attendance
                </span>

            </a>


            <a href="student_results.php"
               class="quick-action">

                <i class="fa-solid fa-square-poll-vertical"></i>

                <span>
                    View Results
                </span>

            </a>


            <a href="student_subjects.php"
               class="quick-action">

                <i class="fa-solid fa-book"></i>

                <span>
                    My Subjects
                </span>

            </a>


            <a href="student_notices.php"
               class="quick-action">

                <i class="fa-solid fa-bullhorn"></i>

                <span>
                    Notices
                </span>

            </a>


        </div>


    </div>


</section>


</main>

</div>



<script>

/* =====================================================
   MOBILE MENU
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
   CLOSE SIDEBAR
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
```
