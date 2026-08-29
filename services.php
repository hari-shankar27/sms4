<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - School Management System</title>

    <style>
        .services-wrapper {
            padding: 30px 0 60px;
        }

        /* Hero Section */
        .services-hero {
            background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
            color: white;
            padding: 60px 35px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.25);
        }

        .services-hero h1 {
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .services-hero p {
            font-size: 17px;
            max-width: 800px;
            margin: auto;
            line-height: 1.7;
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 34px;
            color: #1d4ed8;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .section-title p {
            color: #666;
            font-size: 17px;
            max-width: 750px;
            margin: auto;
        }

        /* Service Cards */
        .service-card {
            border: none;
            border-radius: 15px;
            padding: 35px 25px;
            height: 100%;
            background: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-align: center;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .service-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .service-card h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #222;
        }

        .service-card p {
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        /* Benefits */
        .benefits-section {
            background: #f8fafc;
            padding: 55px 40px;
            border-radius: 18px;
            margin-top: 60px;
        }

        .benefits-section h2 {
            color: #1d4ed8;
            font-weight: 700;
            font-size: 34px;
            margin-bottom: 30px;
        }

        .benefit-list {
            list-style: none;
            padding: 0;
            max-width: 600px;
            margin: auto;
        }

        .benefit-list li {
            color: #555;
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 14px;
            padding-left: 30px;
            position: relative;
        }

        .benefit-list li::before {
            content: "✔";
            color: #1d4ed8;
            font-weight: 700;
            position: absolute;
            left: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .services-hero {
                padding: 60px 25px;
            }

            .services-hero h1 {
                font-size: 34px;
            }

            .services-hero p {
                font-size: 16px;
            }

            .benefits-section {
                padding: 35px 20px;
            }
        }
    </style>
</head>
<body>

<div class="container services-wrapper">

    <!-- Hero Section -->
    <div class="services-hero">

        <h1>Our Services</h1>

        <p>
            Student Management System provides smart and efficient solutions to
            manage academic activities, student records, and institutional data.
        </p>

    </div>


    <!-- Section Title -->
    <div class="section-title">

        <h2>What We Offer</h2>

        <p>
            A complete set of tools built to simplify academic
            administration from every angle.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-4">
            <div class="service-card">
                <div class="service-icon">🎓</div>
                <h3>Student Records</h3>
                <p>
                    Manage complete student profiles including personal details,
                    academic information, and enrollment records easily.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <div class="service-icon">🏢</div>
                <h3>Department Management</h3>
                <p>
                    Organize departments, courses, and academic sections with
                    a structured and simple management system.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>Data Management</h3>
                <p>
                    Store, update, and manage educational data securely with
                    faster access and better organization.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <div class="service-icon">👨‍🏫</div>
                <h3>Teacher Management</h3>
                <p>
                    Maintain teacher details and manage academic responsibilities
                    efficiently.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <div class="service-icon">🔒</div>
                <h3>Secure System</h3>
                <p>
                    Provides organized data handling with secure access and
                    reliable information management.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="service-card">
                <div class="service-icon">⚡</div>
                <h3>Easy Management</h3>
                <p>
                    A simple and user-friendly interface that saves time and
                    improves productivity.
                </p>
            </div>
        </div>

    </div>


    <!-- Benefits -->
    <div class="benefits-section text-center">

        <h2>Why Choose Our System?</h2>

        <ul class="benefit-list text-start">
            <li>Faster student information management</li>
            <li>Easy CRUD operations for records</li>
            <li>Organized department and student data</li>
            <li>Simple interface for administrators</li>
            <li>Improved accuracy and productivity</li>
        </ul>

    </div>

</div>

<!-- Bootstrap JS bundle (optional, needed only if you use Bootstrap components elsewhere) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>