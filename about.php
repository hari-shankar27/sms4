<?php include 'navbar.php';

$features = [
    ["🎓", "Student Management", "Easily add, update, view, and manage student information through a clean and user-friendly interface."],
    ["👨‍🏫", "Teacher Management", "Maintain teacher information and organize their association with academic departments efficiently."],
    ["🏢", "Department Control", "Create, update, view, and manage department records while keeping academic sections properly organized."],
    ["📋", "Organized Records", "Keep academic records structured and easily accessible, reducing unnecessary paperwork and duplicate information."],
    ["🔐", "Secure Access", "Authentication and controlled access help protect important academic information from unauthorized users."],
    ["⚡", "Easy to Use", "A simple interface makes it easier for administrators to perform everyday academic management tasks."],
];

$benefits = [
    ["⏱ Save Time", "Quickly manage records without relying on time-consuming manual processes."],
    ["📊 Better Organization", "Keep students, teachers, and departments organized in a structured database."],
    ["💻 Digital Management", "Replace traditional paperwork with a modern digital approach to academic administration."],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - School Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .about-wrapper { padding: 30px 0 60px; }

        .about-hero {
            background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
            color: white;
            padding: 60px 35px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.25);
        }
        .about-hero h1 { font-size: 40px; font-weight: 700; margin-bottom: 18px; }
        .about-hero p { font-size: 17px; max-width: 800px; margin: auto; line-height: 1.7; }

        .overview { margin-bottom: 60px; }

        .section-title { text-align: center; margin-bottom: 40px; }
        .section-title h2 { font-size: 34px; color: #1d4ed8; font-weight: 700; margin-bottom: 12px; }
        .section-title p { color: #666; font-size: 17px; max-width: 750px; margin: auto; }

        .overview-text { font-size: 17px; color: #555; line-height: 1.9; }

        .feature-card {
            border: none;
            border-radius: 15px;
            padding: 35px 25px;
            height: 100%;
            background: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-align: center;
        }
        .feature-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12); }
        .feature-icon { font-size: 48px; margin-bottom: 20px; }
        .feature-card h3 { font-size: 22px; font-weight: 600; margin-bottom: 15px; color: #222; }
        .feature-card p { color: #666; line-height: 1.7; margin: 0; }

        .benefits-section { background: #f8fafc; padding: 55px 40px; border-radius: 18px; margin-top: 60px; }
        .benefit-box { padding: 20px; }
        .benefit-box h4 { color: #1d4ed8; font-weight: 600; margin-bottom: 10px; }
        .benefit-box p { color: #666; line-height: 1.7; margin: 0; }

        .mission {
            background: linear-gradient(135deg, #eff6ff, #f8fafc);
            padding: 50px;
            border-radius: 18px;
            margin-top: 60px;
            text-align: center;
            border: 1px solid #dbeafe;
        }
        .mission h2 { color: #1d4ed8; font-weight: 700; margin-bottom: 20px; font-size: 32px; }
        .mission p { max-width: 850px; margin: auto; color: #555; font-size: 17px; line-height: 1.8; }

        @media (max-width: 768px) {
            .about-hero { padding: 60px 25px; }
            .about-hero h1 { font-size: 34px; }
            .about-hero p { font-size: 16px; }
            .benefits-section, .mission { padding: 35px 20px; }
        }
    </style>
</head>
<body>

<div class="container about-wrapper">

    <!-- Hero Section -->
    <div class="about-hero">
        <h1>About School Management System</h1>
        <p>
            A modern and efficient digital platform designed to simplify
            student, teacher, department, and academic record management.
            Our system brings essential academic information together in
            one organized and easy-to-use platform.
        </p>
    </div>

    <!-- Overview Section -->
    <div class="overview">
        <div class="section-title">
            <h2>System Overview</h2>
            <p>Everything you need to manage academic information efficiently and securely.</p>
        </div>

        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <p class="overview-text">
                    The School Management System is developed to reduce
                    the complexity of traditional academic record management.
                    Instead of maintaining information across multiple files
                    and paper records, administrators can manage important
                    academic data from a centralized system.
                </p>
                <p class="overview-text">
                    The platform allows institutions to manage students,
                    teachers, departments, and other academic information
                    through a simple and structured interface. CRUD
                    operations make it easy to add, update, view, and remove
                    records whenever required.
                </p>
            </div>

            <div class="col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">🏫</div>
                    <h3>Centralized Academic Management</h3>
                    <p>
                        Keep important academic information organized in
                        one centralized platform, making daily management
                        faster and more efficient.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="section-title">
        <h2>What Our System Provides</h2>
        <p>Powerful features designed to make academic administration simple and organized.</p>
    </div>

    <div class="row g-4">
        <?php foreach ($features as $f): ?>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><?= $f[0] ?></div>
                    <h3><?= $f[1] ?></h3>
                    <p><?= $f[2] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Benefits -->
    <div class="benefits-section">
        <div class="section-title">
            <h2>Why Use This System?</h2>
            <p>Designed to improve productivity and simplify academic administration.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($benefits as $b): ?>
                <div class="col-md-4">
                    <div class="benefit-box">
                        <h4><?= $b[0] ?></h4>
                        <p><?= $b[1] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Mission -->
    <div class="mission">
        <h2>Our Mission</h2>
        <p>
            Our mission is to provide a secure, reliable, and easy-to-use
            platform that simplifies academic management. By bringing
            student, teacher, and department information into one system,
            we aim to improve organization, reduce administrative effort,
            and support a more efficient educational environment.
        </p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>