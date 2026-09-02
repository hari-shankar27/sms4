
<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Privacy Policy | SchoolManage</title>

    <link rel="stylesheet" href="privacy.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>



.privacy-page {
    background: #f8fafc;
    min-height: 100vh;
    color: #1e293b;
}


/* =========================================
   HERO SECTION
========================================= */

.privacy-hero {
    position: relative;
    overflow: hidden;

    padding: 90px 20px 85px;

    text-align: center;

    background:
        radial-gradient(
            circle at 15% 20%,
            rgba(99, 102, 241, 0.15),
            transparent 35%
        ),
        radial-gradient(
            circle at 85% 80%,
            rgba(59, 130, 246, 0.12),
            transparent 35%
        ),
        #f8fafc;
}

.hero-icon {
    width: 76px;
    height: 76px;

    margin: 0 auto 22px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 22px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 31px;

    box-shadow:
        0 12px 30px rgba(79, 70, 229, 0.12);
}

.hero-label {
    display: inline-block;

    margin-bottom: 13px;

    color: #4f46e5;

    font-size: 12px;
    font-weight: 700;

    letter-spacing: 2px;
}

.privacy-hero h1 {
    margin: 0;

    color: #0f172a;

    font-size: clamp(40px, 6vw, 64px);

    line-height: 1.1;

    letter-spacing: -1.5px;
}

.privacy-hero p {
    max-width: 680px;

    margin: 20px auto 25px;

    color: #64748b;

    font-size: 16px;

    line-height: 1.8;
}

.last-updated {
    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 9px 17px;

    border: 1px solid #e2e8f0;

    border-radius: 30px;

    background: #ffffff;

    color: #64748b;

    font-size: 12px;

    box-shadow:
        0 6px 20px rgba(15, 23, 42, 0.05);
}


/* =========================================
   MAIN LAYOUT
========================================= */

.privacy-layout {
    max-width: 1200px;

    margin: 70px auto;

    padding: 0 25px;

    display: grid;

    grid-template-columns: 250px 1fr;

    gap: 50px;

    align-items: start;
}


/* =========================================
   TABLE OF CONTENTS
========================================= */

.privacy-menu {
    position: sticky;

    top: 95px;

    padding: 22px;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

    background: #ffffff;

    box-shadow:
        0 10px 30px rgba(15, 23, 42, 0.05);
}

.menu-title {
    display: flex;

    align-items: center;

    gap: 8px;

    margin-bottom: 16px;

    color: #0f172a;

    font-size: 15px;

    font-weight: 700;
}

.menu-title i {
    color: #4f46e5;
}

.menu-link {
    display: block;

    padding: 10px 12px;

    margin-bottom: 3px;

    border-radius: 9px;

    color: #64748b;

    text-decoration: none;

    font-size: 13px;

    transition:
        background .25s ease,
        color .25s ease,
        transform .25s ease;
}

.menu-link:hover {
    color: #4f46e5;

    background: #f1f5ff;

    transform: translateX(3px);
}

.menu-link.active {
    color: #4f46e5;

    background: #eef2ff;

    font-weight: 600;

    transform: translateX(3px);
}


/* =========================================
   CONTENT
========================================= */

.privacy-content {
    min-width: 0;
}

.policy-section {
    display: grid;

    grid-template-columns: 55px 1fr;

    gap: 18px;

    padding-bottom: 50px;

    margin-bottom: 50px;

    border-bottom: 1px solid #e2e8f0;

    scroll-margin-top: 100px;
}

.section-number {
    width: 45px;
    height: 45px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 12px;

    font-weight: 700;
}

.policy-section h2 {
    margin: 0 0 18px;

    color: #0f172a;

    font-size: 27px;

    line-height: 1.3;
}

.policy-section p {
    margin: 0 0 15px;

    color: #64748b;

    font-size: 15px;

    line-height: 1.9;
}

.policy-section strong {
    color: #334155;
}


/* =========================================
   INFORMATION CARDS
========================================= */

.privacy-cards {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 16px;

    margin-top: 25px;
}

.privacy-card {
    padding: 23px;

    border: 1px solid #e2e8f0;

    border-radius: 16px;

    background: #ffffff;

    transition:
        transform .25s ease,
        box-shadow .25s ease;
}

.privacy-card:hover {
    transform: translateY(-5px);

    box-shadow:
        0 15px 35px rgba(15, 23, 42, 0.08);
}

.card-icon {
    width: 46px;
    height: 46px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin-bottom: 15px;

    border-radius: 12px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 20px;
}

.privacy-card h3 {
    margin: 0 0 13px;

    color: #1e293b;

    font-size: 16px;
}

.privacy-card ul {
    margin: 0;

    padding-left: 17px;
}

.privacy-card li {
    margin-bottom: 8px;

    color: #64748b;

    font-size: 12px;

    line-height: 1.5;
}


/* =========================================
   CHECK LIST
========================================= */

.check-items {
    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 13px;

    margin-top: 22px;
}

.check-items div {
    display: flex;

    align-items: center;

    gap: 10px;

    color: #475569;

    font-size: 14px;

    line-height: 1.5;
}

.check-items i {
    color: #4f46e5;

    font-size: 13px;
}


/* =========================================
   VERIFICATION BOX
========================================= */

.verification-box {
    margin-top: 25px;

    padding: 10px 20px;

    border-radius: 16px;

    background: #eef2ff;
}

.verification-box > div {
    display: flex;

    align-items: flex-start;

    gap: 16px;

    padding: 17px 0;

    border-bottom: 1px solid #dbeafe;
}

.verification-box > div:last-child {
    border-bottom: none;
}

.verification-box > div > i {
    width: 42px;
    height: 42px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #ffffff;

    color: #4f46e5;

    font-size: 18px;
}

.verification-box h3 {
    margin: 0 0 5px;

    color: #1e293b;

    font-size: 15px;
}

.verification-box p {
    margin: 0;

    font-size: 13px;
}


/* =========================================
   SECURITY CARDS
========================================= */

.security-items {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 16px;

    margin-top: 25px;
}

.security-items > div {
    padding: 22px;

    border: 1px solid #e2e8f0;

    border-radius: 15px;

    background: #f8fafc;
}

.security-items i {
    display: block;

    margin-bottom: 13px;

    color: #4f46e5;

    font-size: 23px;
}

.security-items strong {
    display: block;

    margin-bottom: 5px;

    color: #1e293b;

    font-size: 14px;
}

.security-items p {
    margin: 0;

    font-size: 12px;
}


/* =========================================
   CONTACT BOX
========================================= */

.contact-box {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 13px;

    margin-top: 25px;
}

.contact-box div {
    display: flex;

    align-items: center;

    gap: 10px;

    padding: 16px;

    border: 1px solid #e2e8f0;

    border-radius: 12px;

    background: #ffffff;

    color: #475569;

    font-size: 12px;
}

.contact-box i {
    color: #4f46e5;

    font-size: 18px;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 1000px) {

    .privacy-layout {
        grid-template-columns: 1fr;

        gap: 30px;
    }

    .privacy-menu {
        position: relative;

        top: 0;
    }

    .privacy-cards,
    .security-items {
        grid-template-columns: 1fr 1fr;
    }

    .contact-box {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 650px) {

    .privacy-hero {
        padding: 65px 18px;
    }

    .privacy-hero h1 {
        font-size: 42px;
    }

    .privacy-hero p {
        font-size: 14px;
    }

    .privacy-layout {
        margin: 45px auto;

        padding: 0 18px;
    }

    .policy-section {
        grid-template-columns: 1fr;

        gap: 12px;

        padding-bottom: 35px;

        margin-bottom: 35px;
    }

    .privacy-cards,
    .security-items,
    .check-items {
        grid-template-columns: 1fr;
    }

    .policy-section h2 {
        font-size: 23px;
    }

    .policy-section p {
        font-size: 14px;
    }

    .footer-inner {
        flex-direction: column;

        align-items: flex-start;

        gap: 25px;
    }

    .footer-links {
        flex-direction: column;

        gap: 12px;
    }

}



    </style>

</head>

<body>

<main class="privacy-page">

    <!-- ================= HERO ================= -->

    <section class="privacy-hero">

        <div class="hero-icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <span class="hero-label">
            YOUR PRIVACY MATTERS
        </span>

        <h1>
            Privacy Policy
        </h1>

        <p>
            We are committed to protecting your personal information
            and maintaining your trust while using SchoolManage.
        </p>

        <div class="last-updated">

            <i class="fa-regular fa-calendar"></i>

            Last Updated: August 30, 2026

        </div>

    </section>


    <!-- ================= POLICY ================= -->

    <section class="privacy-layout">


        <!-- TABLE OF CONTENTS -->

        <aside class="privacy-menu">

            <div class="menu-title">

                <i class="fa-solid fa-list"></i>

                Contents

            </div>


            <a href="#introduction" class="menu-link active">
                Introduction
            </a>

            <a href="#collection" class="menu-link">
                Information We Collect
            </a>

            <a href="#usage" class="menu-link">
                How We Use Information
            </a>

            <a href="#verification" class="menu-link">
                Student & Teacher Verification
            </a>

            <a href="#security" class="menu-link">
                Data Security
            </a>

            <a href="#sharing" class="menu-link">
                Information Sharing
            </a>

            <a href="#cookies" class="menu-link">
                Cookies & Sessions
            </a>

            <a href="#rights" class="menu-link">
                Your Rights
            </a>

            <a href="#children" class="menu-link">
                Children's Privacy
            </a>

            <a href="#changes" class="menu-link">
                Changes to Policy
            </a>

            <a href="#contact" class="menu-link">
                Contact Us
            </a>

        </aside>


        <!-- ================= CONTENT ================= -->

        <article class="privacy-content">


            <!-- 01 -->

            <section id="introduction" class="policy-section">

                <div class="section-number">
                    01
                </div>

                <div>

                    <h2>
                        Introduction
                    </h2>

                    <p>
                        Welcome to <strong>SchoolManage</strong>,
                        a School Management System designed to help
                        schools manage students, teachers, classes,
                        attendance, examinations and other academic
                        information.
                    </p>

                    <p>
                        This Privacy Policy explains what information
                        we collect, how we use it and how we protect
                        your information.
                    </p>

                </div>

            </section>


            <!-- 02 -->

            <section id="collection" class="policy-section">

                <div class="section-number">
                    02
                </div>

                <div>

                    <h2>
                        Information We Collect
                    </h2>

                    <p>
                        Depending on your role, SchoolManage may
                        collect information necessary to provide
                        school management services.
                    </p>


                    <div class="privacy-cards">


                        <!-- STUDENT -->

                        <div class="privacy-card">

                            <div class="card-icon">

                                <i class="fa-solid fa-user-graduate"></i>

                            </div>

                            <h3>
                                Student Information
                            </h3>

                            <ul>

                                <li>Full Name</li>

                                <li>
                                    Student ID / Registration Number
                                </li>

                                <li>Phone Number</li>

                                <li>Email Address</li>

                                <li>Class Information</li>

                                <li>Attendance Records</li>

                                <li>Examination Results</li>

                            </ul>

                        </div>


                        <!-- TEACHER -->

                        <div class="privacy-card">

                            <div class="card-icon">

                                <i class="fa-solid fa-chalkboard-user"></i>

                            </div>

                            <h3>
                                Teacher Information
                            </h3>

                            <ul>

                                <li>Full Name</li>

                                <li>Teacher ID</li>

                                <li>Phone Number</li>

                                <li>Email Address</li>

                                <li>Subject Information</li>

                                <li>Assigned Classes</li>

                            </ul>

                        </div>


                        <!-- ACCOUNT -->

                        <div class="privacy-card">

                            <div class="card-icon">

                                <i class="fa-solid fa-user-lock"></i>

                            </div>

                            <h3>
                                Account Information
                            </h3>

                            <ul>

                                <li>Email Address</li>

                                <li>Password</li>

                                <li>Phone Number</li>

                                <li>User Role</li>

                            </ul>

                        </div>

                    </div>

                </div>

            </section>


            <!-- 03 -->

            <section id="usage" class="policy-section">

                <div class="section-number">
                    03
                </div>

                <div>

                    <h2>
                        How We Use Your Information
                    </h2>

                    <p>
                        The information collected through SchoolManage
                        is used for legitimate school management
                        purposes.
                    </p>


                    <div class="check-items">

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Manage student and teacher accounts
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Manage classes and subjects
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Record student attendance
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Manage examinations and results
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Verify students and teachers
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Maintain system security
                        </div>

                    </div>

                </div>

            </section>


            <!-- 04 -->

            <section id="verification" class="policy-section">

                <div class="section-number">
                    04
                </div>

                <div>

                    <h2>
                        Student & Teacher Verification
                    </h2>

                    <p>
                        To help prevent unauthorized registration,
                        SchoolManage may require school-issued
                        identification numbers.
                    </p>


                    <div class="verification-box">


                        <div>

                            <i class="fa-solid fa-id-card"></i>

                            <div>

                                <h3>
                                    Student Registration Number
                                </h3>

                                <p>
                                    Students may be required to enter
                                    the registration number provided
                                    by the school.
                                </p>

                            </div>

                        </div>


                        <div>

                            <i class="fa-solid fa-id-badge"></i>

                            <div>

                                <h3>
                                    Teacher ID
                                </h3>

                                <p>
                                    Teachers may be required to enter
                                    the Teacher ID provided by the
                                    school administration.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <!-- 05 -->

            <section id="security" class="policy-section">

                <div class="section-number">
                    05
                </div>

                <div>

                    <h2>
                        Data Security
                    </h2>

                    <p>
                        We take reasonable steps to protect personal
                        information from unauthorized access,
                        modification, disclosure or misuse.
                    </p>


                    <div class="security-items">


                        <div>

                            <i class="fa-solid fa-lock"></i>

                            <strong>
                                Secure Passwords
                            </strong>

                            <p>
                                Passwords should be stored using
                                secure password hashing.
                            </p>

                        </div>


                        <div>

                            <i class="fa-solid fa-user-shield"></i>

                            <strong>
                                Access Control
                            </strong>

                            <p>
                                Protected information should only
                                be available to authorized users.
                            </p>

                        </div>


                        <div>

                            <i class="fa-solid fa-database"></i>

                            <strong>
                                Protected Records
                            </strong>

                            <p>
                                Academic records should be protected
                                from unauthorized use.
                            </p>

                        </div>


                    </div>

                </div>

            </section>


            <!-- 06 -->

            <section id="sharing" class="policy-section">

                <div class="section-number">
                    06
                </div>

                <div>

                    <h2>
                        Information Sharing
                    </h2>

                    <p>
                        We do not intentionally sell or rent personal
                        information to third parties.
                    </p>

                    <p>
                        Information may be accessed by authorized
                        school administrators, teachers or staff when
                        required for legitimate educational and
                        administrative purposes.
                    </p>

                </div>

            </section>


            <!-- 07 -->

            <section id="cookies" class="policy-section">

                <div class="section-number">
                    07
                </div>

                <div>

                    <h2>
                        Cookies & Sessions
                    </h2>

                    <p>
                        SchoolManage may use cookies and session
                        technologies to maintain login sessions,
                        improve functionality and provide a secure
                        user experience.
                    </p>

                </div>

            </section>


            <!-- 08 -->

            <section id="rights" class="policy-section">

                <div class="section-number">
                    08
                </div>

                <div>

                    <h2>
                        Your Rights
                    </h2>

                    <p>
                        Depending on applicable laws and school
                        policies, users may request:
                    </p>


                    <div class="check-items">

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Access to their personal information
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Correction of inaccurate information
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Information about how their data is used
                        </div>

                        <div>
                            <i class="fa-solid fa-check"></i>
                            Assistance with unauthorized account activity
                        </div>

                    </div>

                </div>

            </section>


            <!-- 09 -->

            <section id="children" class="policy-section">

                <div class="section-number">
                    09
                </div>

                <div>

                    <h2>
                        Children's Privacy
                    </h2>

                    <p>
                        SchoolManage may contain information belonging
                        to students who are minors.
                    </p>

                    <p>
                        Student information should only be collected,
                        accessed and processed for legitimate
                        educational and administrative purposes.
                    </p>

                </div>

            </section>


            <!-- 10 -->

            <section id="changes" class="policy-section">

                <div class="section-number">
                    10
                </div>

                <div>

                    <h2>
                        Changes to This Policy
                    </h2>

                    <p>
                        We may update this Privacy Policy when
                        necessary to reflect changes in the system,
                        school policies, security practices or
                        applicable requirements.
                    </p>

                    <p>
                        The latest version will display the date it
                        was last updated.
                    </p>

                </div>

            </section>


            <!-- 11 -->

            <section id="contact" class="policy-section">

                <div class="section-number">
                    11
                </div>

                <div>

                    <h2>
                        Contact Us
                    </h2>

                    <p>
                        If you have questions or concerns about this
                        Privacy Policy, please contact the school
                        administration.
                    </p>


                    <div class="contact-box">

                        <div>
                            <i class="fa-solid fa-school"></i>
                            <span>SchoolManage</span>
                        </div>

                        <div>
                            <i class="fa-solid fa-envelope"></i>
                            <span>school@example.com</span>
                        </div>

                        <div>
                            <i class="fa-solid fa-phone"></i>
                            <span>+977-XXXXXXXXXX</span>
                        </div>

                    </div>

                </div>

            </section>


        </article>

    </section>

</main>



<?php include 'footer.php' ?>
<script src="privacy.js"></script>
<script>


document.addEventListener("DOMContentLoaded", function () {

    const menuLinks = document.querySelectorAll(".menu-link");
    const sections = document.querySelectorAll(".policy-section");


    /* =========================================
       SMOOTH SCROLL
    ========================================= */

    menuLinks.forEach(function (link) {

        link.addEventListener("click", function (event) {

            event.preventDefault();

            const targetId = this.getAttribute("href");

            const target = document.querySelector(targetId);

            if (target) {

                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });

            }

        });

    });


    /* =========================================
       ACTIVE SECTION
    ========================================= */

    function updateActiveSection() {

        let currentSection = "";

        sections.forEach(function (section) {

            const sectionTop =
                section.getBoundingClientRect().top;

            if (sectionTop <= 180) {

                currentSection =
                    section.getAttribute("id");

            }

        });


        menuLinks.forEach(function (link) {

            link.classList.remove("active");

            const linkTarget =
                link.getAttribute("href");

            if (
                linkTarget === "#" + currentSection
            ) {

                link.classList.add("active");

            }

        });

    }


    window.addEventListener(
        "scroll",
        updateActiveSection
    );


    updateActiveSection();


    /* =========================================
       FADE-IN SECTIONS
    ========================================= */

    const observer =
        new IntersectionObserver(
            function (entries) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            "show-section"
                        );

                    }

                });

            },
            {
                threshold: 0.08
            }
        );


    sections.forEach(function (section) {

        observer.observe(section);

    });

});


    </script>

</body>
</html>

