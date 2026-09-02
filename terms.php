
<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Terms & Conditions | SchoolManage</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<style>

/* =========================================
   TERMS & CONDITIONS PAGE
========================================= */

* {
    box-sizing: border-box;
}

.terms-page {
    min-height: 100vh;

    background: #f8fafc;

    color: #1e293b;

    font-family: Arial, sans-serif;
}


/* =========================================
   HERO
========================================= */

.terms-hero {
    position: relative;

    overflow: hidden;

    padding: 90px 20px 80px;

    text-align: center;

    background:
        radial-gradient(
            circle at 15% 20%,
            rgba(99, 102, 241, .15),
            transparent 35%
        ),
        radial-gradient(
            circle at 85% 80%,
            rgba(59, 130, 246, .12),
            transparent 35%
        ),
        #f8fafc;
}

.terms-icon {
    width: 76px;
    height: 76px;

    margin: 0 auto 22px;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 22px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 30px;

    box-shadow:
        0 12px 30px rgba(79, 70, 229, .12);
}

.terms-label {
    display: inline-block;

    margin-bottom: 12px;

    color: #4f46e5;

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 2px;
}

.terms-hero h1 {
    margin: 0;

    color: #0f172a;

    font-size: clamp(40px, 6vw, 64px);

    line-height: 1.1;

    letter-spacing: -1px;
}

.terms-hero p {
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

    background: #fff;

    color: #64748b;

    font-size: 12px;

    box-shadow:
        0 6px 20px rgba(15, 23, 42, .05);
}


/* =========================================
   MAIN LAYOUT
========================================= */

.terms-layout {
    max-width: 1200px;

    margin: 70px auto;

    padding: 0 25px;

    display: grid;

    grid-template-columns: 250px 1fr;

    gap: 50px;

    align-items: start;
}


/* =========================================
   SIDE MENU
========================================= */

.terms-menu {
    position: sticky;

    top: 95px;

    padding: 22px;

    border: 1px solid #e2e8f0;

    border-radius: 18px;

    background: #fff;

    box-shadow:
        0 10px 30px rgba(15, 23, 42, .05);
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

.terms-link {
    display: block;

    padding: 10px 12px;

    margin-bottom: 3px;

    border-radius: 9px;

    color: #64748b;

    text-decoration: none;

    font-size: 13px;

    transition: .25s;
}

.terms-link:hover,
.terms-link.active {
    color: #4f46e5;

    background: #eef2ff;

    transform: translateX(3px);
}


/* =========================================
   CONTENT
========================================= */

.terms-content {
    min-width: 0;
}

.term-section {
    display: grid;

    grid-template-columns: 55px 1fr;

    gap: 18px;

    padding-bottom: 50px;

    margin-bottom: 50px;

    border-bottom: 1px solid #e2e8f0;

    scroll-margin-top: 100px;

    opacity: 0;

    transform: translateY(20px);

    transition:
        opacity .6s ease,
        transform .6s ease;
}

.term-section.show-section {
    opacity: 1;

    transform: translateY(0);
}

.term-number {
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

.term-section h2 {
    margin: 0 0 18px;

    color: #0f172a;

    font-size: 27px;

    line-height: 1.3;
}

.term-section p {
    margin: 0 0 15px;

    color: #64748b;

    font-size: 15px;

    line-height: 1.9;
}

.term-section strong {
    color: #334155;
}


/* =========================================
   RULE LIST
========================================= */

.rule-list {
    display: grid;

    gap: 12px;

    margin-top: 20px;
}

.rule {
    display: flex;

    align-items: flex-start;

    gap: 12px;

    padding: 14px 16px;

    border: 1px solid #e2e8f0;

    border-radius: 12px;

    background: #fff;
}

.rule i {
    margin-top: 3px;

    color: #4f46e5;

    font-size: 14px;
}

.rule span {
    color: #475569;

    font-size: 14px;

    line-height: 1.6;
}


/* =========================================
   ROLE CARDS
========================================= */

.role-cards {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 15px;

    margin-top: 25px;
}

.role-card {
    padding: 22px;

    border: 1px solid #e2e8f0;

    border-radius: 16px;

    background: #fff;

    transition: .25s;
}

.role-card:hover {
    transform: translateY(-5px);

    box-shadow:
        0 15px 35px rgba(15, 23, 42, .08);
}

.role-icon {
    width: 45px;
    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 14px;

    border-radius: 12px;

    background: #eef2ff;

    color: #4f46e5;

    font-size: 20px;
}

.role-card h3 {
    margin: 0 0 10px;

    color: #1e293b;

    font-size: 16px;
}

.role-card p {
    margin: 0;

    font-size: 13px;
}


/* =========================================
   WARNING BOX
========================================= */

.warning-box {
    display: flex;

    align-items: flex-start;

    gap: 14px;

    margin-top: 22px;

    padding: 18px;

    border-left: 4px solid #4f46e5;

    border-radius: 10px;

    background: #eef2ff;
}

.warning-box i {
    margin-top: 3px;

    color: #4f46e5;

    font-size: 20px;
}

.warning-box p {
    margin: 0;

    font-size: 13px;
}


/* =========================================
   CONTACT
========================================= */

.contact_box {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 13px;

    margin-top: 25px;
}

.contact_item {
    display: flex;

    align-items: center;

    gap: 10px;

    padding: 16px;

    border: 1px solid #e2e8f0;

    border-radius: 12px;

    background: #fff;

    color: #475569;

    font-size: 12px;
}

.contact_item i {
    color: #4f46e5;

    font-size: 18px;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 1000px) {

    .terms-layout {
        grid-template-columns: 1fr;

        gap: 30px;
    }

    .terms-menu {
        position: relative;

        top: 0;
    }

    .role-cards {
        grid-template-columns: 1fr 1fr;
    }

    .contact-box {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 650px) {

    .terms-hero {
        padding: 65px 18px;
    }

    .terms-hero h1 {
        font-size: 42px;
    }

    .terms-hero p {
        font-size: 14px;
    }

    .terms-layout {
        margin: 45px auto;

        padding: 0 18px;
    }

    .term-section {
        grid-template-columns: 1fr;

        gap: 12px;

        padding-bottom: 35px;

        margin-bottom: 35px;
    }

    .role-cards {
        grid-template-columns: 1fr;
    }

    .term-section h2 {
        font-size: 23px;
    }

    .term-section p {
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


<main class="terms-page">


<!-- =========================================
     HERO
========================================= -->

<section class="terms-hero">

    <div class="terms-icon">

        <i class="fa-solid fa-file-contract"></i>

    </div>


    <span class="terms-label">
        PLEASE READ CAREFULLY
    </span>


    <h1>
        Terms & Conditions
    </h1>


    <p>
        These Terms & Conditions explain the rules and
        responsibilities for using the SchoolManage
        School Management System.
    </p>


    <div class="last-updated">

        <i class="fa-regular fa-calendar"></i>

        Last Updated: August 30, 2026

    </div>

</section>



<!-- =========================================
     MAIN CONTENT
========================================= -->

<section class="terms-layout">


<!-- =========================================
     SIDE MENU
========================================= -->

<aside class="terms-menu">


    <div class="menu-title">

        <i class="fa-solid fa-list"></i>

        Contents

    </div>


    <a href="#acceptance"
       class="terms-link active">

        Acceptance

    </a>


    <a href="#accounts"
       class="terms-link">

        User Accounts

    </a>


    <a href="#registration"
       class="terms-link">

        Registration

    </a>


    <a href="#responsibilities"
       class="terms-link">

        User Responsibilities

    </a>


    <a href="#roles"
       class="terms-link">

        User Roles

    </a>


    <a href="#school-data"
       class="terms-link">

        School Data

    </a>


    <a href="#security"
       class="terms-link">

        Security

    </a>


    <a href="#prohibited"
       class="terms-link">

        Prohibited Activities

    </a>


    <a href="#availability"
       class="terms-link">

        System Availability

    </a>


    <a href="#termination"
       class="terms-link">

        Account Termination

    </a>


    <a href="#changes"
       class="terms-link">

        Changes

    </a>


    <a href="#contact"
       class="terms-link">

        Contact Us

    </a>


</aside>



<!-- =========================================
     CONTENT
========================================= -->

<article class="terms-content">


<!-- 01 -->

<section id="acceptance"
         class="term-section">

    <div class="term-number">
        01
    </div>


    <div>

        <h2>
            Acceptance of Terms
        </h2>


        <p>
            By accessing or using
            <strong>SchoolManage</strong>,
            you agree to follow these Terms &
            Conditions.
        </p>


        <p>
            If you do not agree with these terms,
            you should not use the system.
        </p>

    </div>

</section>



<!-- 02 -->

<section id="accounts"
         class="term-section">

    <div class="term-number">
        02
    </div>


    <div>

        <h2>
            User Accounts
        </h2>


        <p>
            Users may need to create an account
            to access certain features of the
            SchoolManage system.
        </p>


        <div class="rule-list">


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    You must provide accurate information
                    during registration.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    You are responsible for keeping
                    your password confidential.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    You must not share your account
                    credentials with unauthorized users.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    You should immediately report
                    unauthorized account access.
                </span>

            </div>


        </div>

    </div>

</section>



<!-- 03 -->

<section id="registration"
         class="term-section">

    <div class="term-number">
        03
    </div>


    <div>

        <h2>
            Registration & Verification
        </h2>


        <p>
            SchoolManage may use school-issued
            identification information to verify
            users before allowing registration.
        </p>


        <div class="warning-box">

            <i class="fa-solid fa-circle-info"></i>

            <p>
                Students may be required to provide
                a valid student registration number,
                while teachers may be required to
                provide a valid Teacher ID issued
                by the school.
            </p>

        </div>

    </div>

</section>



<!-- 04 -->

<section id="responsibilities"
         class="term-section">

    <div class="term-number">
        04
    </div>


    <div>

        <h2>
            User Responsibilities
        </h2>


        <p>
            All users are expected to use
            SchoolManage responsibly and only
            for legitimate educational purposes.
        </p>


        <div class="rule-list">


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    Provide correct and up-to-date
                    information.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    Protect your login credentials.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    Respect the privacy of other users.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-check"></i>

                <span>
                    Use school information only for
                    authorized purposes.
                </span>

            </div>


        </div>

    </div>

</section>



<!-- 05 -->

<section id="roles"
         class="term-section">

    <div class="term-number">
        05
    </div>


    <div>

        <h2>
            User Roles & Permissions
        </h2>


        <p>
            Different users may have different
            permissions within the system.
        </p>


        <div class="role-cards">


            <div class="role-card">

                <div class="role-icon">

                    <i class="fa-solid fa-user-shield"></i>

                </div>

                <h3>
                    Administrator
                </h3>

                <p>
                    Administrators can manage users,
                    teachers, students, classes,
                    subjects, attendance and results.
                </p>

            </div>


            <div class="role-card">

                <div class="role-icon">

                    <i class="fa-solid fa-chalkboard-user"></i>

                </div>

                <h3>
                    Teacher
                </h3>

                <p>
                    Teachers can access features
                    permitted by the school, such as
                    attendance, classes and academic
                    records.
                </p>

            </div>


            <div class="role-card">

                <div class="role-icon">

                    <i class="fa-solid fa-user-graduate"></i>

                </div>

                <h3>
                    Student
                </h3>

                <p>
                    Students can access information
                    and services made available to
                    them by the school.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- 06 -->

<section id="school-data"
         class="term-section">

    <div class="term-number">
        06
    </div>


    <div>

        <h2>
            School Data
        </h2>


        <p>
            Information entered into SchoolManage
            should be accurate and relevant to
            legitimate school activities.
        </p>


        <p>
            Administrators and authorized staff
            are responsible for ensuring that
            school records are entered and
            maintained appropriately.
        </p>

    </div>

</section>



<!-- 07 -->

<section id="security"
         class="term-section">

    <div class="term-number">
        07
    </div>


    <div>

        <h2>
            Security
        </h2>


        <p>
            Users must take reasonable steps to
            protect their accounts and prevent
            unauthorized access.
        </p>


        <div class="rule-list">


            <div class="rule">

                <i class="fa-solid fa-lock"></i>

                <span>
                    Never share your password with
                    unauthorized persons.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    Log out after using the system
                    on shared devices.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-triangle-exclamation"></i>

                <span>
                    Report suspicious or unauthorized
                    activity to the administrator.
                </span>

            </div>


        </div>

    </div>

</section>



<!-- 08 -->

<section id="prohibited"
         class="term-section">

    <div class="term-number">
        08
    </div>


    <div>

        <h2>
            Prohibited Activities
        </h2>


        <p>
            Users must not use SchoolManage to:
        </p>


        <div class="rule-list">


            <div class="rule">

                <i class="fa-solid fa-ban"></i>

                <span>
                    Access another person's account
                    without authorization.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-ban"></i>

                <span>
                    Modify or delete records without
                    appropriate permission.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-ban"></i>

                <span>
                    Attempt to bypass system security.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-ban"></i>

                <span>
                    Upload malicious files or harmful
                    content.
                </span>

            </div>


            <div class="rule">

                <i class="fa-solid fa-ban"></i>

                <span>
                    Use the system for unlawful or
                    unauthorized purposes.
                </span>

            </div>


        </div>

    </div>

</section>



<!-- 09 -->

<section id="availability"
         class="term-section">

    <div class="term-number">
        09
    </div>


    <div>

        <h2>
            System Availability
        </h2>


        <p>
            We aim to keep SchoolManage available
            and functional, but temporary downtime
            may occur because of maintenance,
            technical problems, network issues or
            other circumstances.
        </p>

    </div>

</section>



<!-- 10 -->

<section id="termination"
         class="term-section">

    <div class="term-number">
        10
    </div>


    <div>

        <h2>
            Account Termination
        </h2>


        <p>
            The school administration may suspend
            or terminate an account if a user
            violates these Terms & Conditions or
            uses the system in an unauthorized
            manner.
        </p>


        <p>
            Access may also be removed when a
            user's relationship with the school
            ends.
        </p>

    </div>

</section>



<!-- 11 -->

<section id="changes"
         class="term-section">

    <div class="term-number">
        11
    </div>


    <div>

        <h2>
            Changes to These Terms
        </h2>


        <p>
            These Terms & Conditions may be
            updated when necessary to reflect
            changes to the SchoolManage system,
            school policies or applicable
            requirements.
        </p>


        <p>
            The latest version will display the
            date on which it was last updated.
        </p>

    </div>

</section>



<!-- 12 -->

<section id="contact"
         class="term-section">

    <div class="term-number">
        12
    </div>


    <div>

        <h2>
            Contact Us
        </h2>


        <p>
            If you have questions regarding these
            Terms & Conditions, please contact
            the school administration.
        </p>


        <div class="contact_box">


            <div class="contact_item">

                <i class="fa-solid fa-school"></i>

                <span>
                    SchoolManage
                </span>

            </div>


            <div class="contact_item">

                <i class="fa-solid fa-envelope"></i>

                <span>
                    school@example.com
                </span>

            </div>


            <div class="contact_item">

                <i class="fa-solid fa-phone"></i>

                <span>
                    +977-XXXXXXXXXX
                </span>

            </div>


        </div>

    </div>

</section>


</article>

</section>

</main>


<?php include 'footer.php' ?>
<script>

/* =========================================
   SMOOTH SCROLL
========================================= */

const termLinks =
    document.querySelectorAll(".terms-link");

const termSections =
    document.querySelectorAll(".term-section");


termLinks.forEach(function(link) {

    link.addEventListener("click", function(event) {

        event.preventDefault();

        const targetId =
            this.getAttribute("href");

        const target =
            document.querySelector(targetId);

        if (target) {

            target.scrollIntoView({

                behavior: "smooth",

                block: "start"

            });

        }

    });

});



/* =========================================
   ACTIVE MENU
========================================= */

function updateActiveMenu() {

    let current = "";

    termSections.forEach(function(section) {

        const sectionTop =
            section.getBoundingClientRect().top;

        if (sectionTop <= 180) {

            current =
                section.getAttribute("id");

        }

    });


    termLinks.forEach(function(link) {

        link.classList.remove("active");


        if (
            link.getAttribute("href") ===
            "#" + current
        ) {

            link.classList.add("active");

        }

    });

}


window.addEventListener(
    "scroll",
    updateActiveMenu
);


/* =========================================
   SECTION ANIMATION
========================================= */

const observer =
    new IntersectionObserver(

        function(entries) {

            entries.forEach(function(entry) {

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


termSections.forEach(function(section) {

    observer.observe(section);

});


/* Show first sections immediately */

document.querySelectorAll(
    ".term-section"
).forEach(function(section, index) {

    if (index < 2) {

        section.classList.add(
            "show-section"
        );

    }

});

</script>


</body>
</html>

