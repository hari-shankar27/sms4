```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>School Management System</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1e293b;
        }

        /* =========================
           TOP NAVBAR
        ========================= */

        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            z-index: 1000;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .menu-btn {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 10px;
            background: #eef2ff;
            color: #4f46e5;
            font-size: 19px;
            cursor: pointer;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: 700;
            color: #1e293b;
        }

        .logo-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            font-size: 19px;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Search */

        .search-box {
            width: 250px;
            height: 42px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            padding: 0 13px;
            gap: 10px;
        }

        .search-box i {
            color: #94a3b8;
        }

        .search-box input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
        }

        /* Notification */

        .notification {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #475569;
        }

        .notification:hover {
            background: #f1f5f9;
        }

        .notification span {
            position: absolute;
            top: 5px;
            right: 4px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
        }

        /* Admin Profile */

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-size: 14px;
            font-weight: 600;
        }

        .admin-role {
            font-size: 11px;
            color: #64748b;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 250px;
            height: calc(100vh - 70px);
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 20px 14px;
            overflow-y: auto;
            transition: 0.3s ease;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-title {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            padding: 10px 15px;
            margin-bottom: 5px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            height: 46px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 15px;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s ease;
            white-space: nowrap;
        }

        .sidebar-menu a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-menu a:hover {
            background: #f1f5ff;
            color: #4f46e5;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, #eef2ff, #f5f3ff);
            color: #4f46e5;
            font-weight: 600;
        }

        .sidebar-menu a.logout {
            color: #ef4444;
        }

        .sidebar-menu a.logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Collapsed sidebar */

        .sidebar.collapsed .sidebar-title {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 0;
        }

        .sidebar.collapsed .sidebar-menu a span {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu a i {
            font-size: 17px;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .main-content {
            margin-left: 250px;
            padding: 100px 30px 30px;
            transition: 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        .page-title {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 900px) {

            .search-box {
                display: none;
            }

            .sidebar {
                left: -250px;
            }

            .sidebar.mobile-open {
                left: 0;
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.08);
            }

            .sidebar.collapsed {
                width: 250px;
            }

            .sidebar.collapsed .sidebar-title {
                display: block;
            }

            .sidebar.collapsed .sidebar-menu a {
                justify-content: flex-start;
                padding: 0 15px;
            }

            .sidebar.collapsed .sidebar-menu a span {
                display: inline;
            }

            .main-content,
            .main-content.expanded {
                margin-left: 0;
                padding: 95px 20px 30px;
            }

            .admin-info {
                display: none;
            }
        }

        @media (max-width: 500px) {

            .topbar {
                padding: 0 15px;
            }

            .logo span {
                display: none;
            }

            .top-right {
                gap: 8px;
            }

            .main-content {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         TOP NAVBAR
    ========================== -->

    <header class="topbar">

        <div class="top-left">

            <button class="menu-btn" id="menuBtn">
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

            <!-- Search -->
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
            </div>

            <!-- Notification -->
            <div class="notification">
                <i class="fa-regular fa-bell"></i>
                <span></span>
            </div>

            <!-- Admin -->
            <div class="admin-profile">

                <div class="admin-avatar">
                    A
                </div>

                <div class="admin-info">
                    <div class="admin-name">
                        Admin
                    </div>

                    <div class="admin-role">
                        Administrator
                    </div>
                </div>

                <i class="fa-solid fa-chevron-down"></i>

            </div>

        </div>

    </header>


    <!-- =========================
         SIDEBAR
    ========================== -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-title">
            Main Menu
        </div>

        <ul class="sidebar-menu">

            <li>
                <a href="#" class="active">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Students</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Teachers</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-school"></i>
                    <span>Classes</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-book"></i>
                    <span>Subjects</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Attendance</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-file-pen"></i>
                    <span>Exams</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Results</span>
                </a>
            </li>

        </ul>


        <div class="sidebar-title">
            Management
        </div>

        <ul class="sidebar-menu">

            <li>
                <a href="#">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Notices</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Events</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Reports</span>
                </a>
            </li>

        </ul>


        <div class="sidebar-title">
            System
        </div>

        <ul class="sidebar-menu">

            <li>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>

            <li>
                <a href="#" class="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>

    </aside>


    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <main class="main-content" id="mainContent">

        <h1 class="page-title">
            Dashboard
        </h1>

        <p class="page-subtitle">
            Welcome back, Admin. Here's what's happening in your school today.
        </p>

    </main>


    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script>

        const menuBtn = document.getElementById("menuBtn");
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");

        menuBtn.addEventListener("click", function () {

            if (window.innerWidth <= 900) {

                sidebar.classList.toggle("mobile-open");

            } else {

                sidebar.classList.toggle("collapsed");
                mainContent.classList.toggle("expanded");

            }

        });


        // Active menu item

        const menuLinks = document.querySelectorAll(".sidebar-menu a");

        menuLinks.forEach(function(link) {

            link.addEventListener("click", function() {

                menuLinks.forEach(function(item) {
                    item.classList.remove("active");
                });

                if (!this.classList.contains("logout")) {
                    this.classList.add("active");
                }

            });

        });


        // Close sidebar when clicking outside on mobile

        document.addEventListener("click", function(event) {

            if (
                window.innerWidth <= 900 &&
                !sidebar.contains(event.target) &&
                !menuBtn.contains(event.target)
            ) {
                sidebar.classList.remove("mobile-open");
            }

        });

    </script>

</body>
</html>
```
