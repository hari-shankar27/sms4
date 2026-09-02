<?php include 'navbar.php';

$contact_items = [
    ["📍", "Our Location", "Tribhuvan University, Kirtipur, Nepal"],
    ["📧", "Email", "support@mmamc.com"],
    ["📞", "Phone", "+977 9827375500"],
    ["⏰", "Office Hours", "Sunday - Friday<br>10:00 AM - 5:00 PM"],
];

$support_items = [
    ["💬", "General Questions", "Contact us if you need general information about the Student Management System."],
    ["🛠️", "Technical Support", "Need help with the system? Send us your issue and our team can assist you."],
    ["📚", "System Information", "Learn more about our features and how the platform can simplify academic management."],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - School Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        .contact-wrapper {
            max-width: 1140px;
            margin: 0 auto;
            padding: 30px 20px 60px;
        }

        .contact-hero {
            background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
            color: white;
            padding: 60px 35px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.25);
        }
        .contact-hero h1 { font-size: 40px; font-weight: 700; margin-bottom: 18px; }
        .contact-hero p { max-width: 800px; margin: auto; font-size: 17px; line-height: 1.7; }

        .section-title { text-align: center; margin-bottom: 40px; }
        .section-title h2 { color: #1d4ed8; font-size: 34px; font-weight: 700; margin-bottom: 12px; }
        .section-title p { color: #666; font-size: 17px; }

        /* Custom grid (replaces .row / .col-md-*) */
        .contact-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
        }
        .contact-grid .col-info { flex: 1 1 380px; }
        .contact-grid .col-form { flex: 2 1 480px; }

        .grid-3 {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
        }
        .grid-3 > div { flex: 1 1 280px; }

        .contact-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            height: 100%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
            box-sizing: border-box;
        }
        .contact-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12); }
        .contact-card h3 { color: #1d4ed8; font-weight: 600; margin-bottom: 25px; }

        .contact-item { display: flex; align-items: flex-start; gap: 15px; margin-bottom: 25px; color: #555; line-height: 1.6; }
        .contact-icon { font-size: 25px; min-width: 35px; }
        .contact-item strong { display: block; color: #333; margin-bottom: 3px; }

        /* Form */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-weight: 500; color: #444; margin-bottom: 8px; }
        .form-control {
            display: block;
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
            font-family: inherit;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .btn-contact {
            background-color: #2563eb;
            color: white;
            padding: 11px 25px;
            border: none;
            border-radius: 7px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-contact:hover { background-color: #1d4ed8; color: white; transform: translateY(-2px); }

        .support-section { background: #f8fafc; padding: 50px 35px; border-radius: 18px; margin-top: 55px; }
        .support-box { text-align: center; padding: 20px; }
        .support-icon { font-size: 42px; margin-bottom: 15px; }
        .support-box h4 { color: #1d4ed8; font-weight: 600; margin-bottom: 10px; }
        .support-box p { color: #666; line-height: 1.7; margin: 0; }

        .contact-footer {
            margin-top: 55px;
            padding: 45px;
            text-align: center;
            background: linear-gradient(135deg, #eff6ff, #f8fafc);
            border: 1px solid #dbeafe;
            border-radius: 18px;
        }
        .contact-footer h2 { color: #1d4ed8; font-weight: 700; margin-bottom: 15px; }
        .contact-footer p { color: #555; max-width: 750px; margin: auto; line-height: 1.8; }

        @media (max-width: 768px) {
            .contact-hero { padding: 60px 25px; }
            .contact-hero h1 { font-size: 34px; }
            .contact-hero p { font-size: 16px; }
            .contact-card { padding: 25px; }
            .support-section, .contact-footer { padding: 35px 20px; }
        }
    </style>
</head>
<body>

<div class="contact-wrapper">

    <!-- Hero Section -->
    <div class="contact-hero">
        <h1>Contact Us</h1>
        <p>
            Have a question, need assistance, or want to learn more about
            our Student Management System? Get in touch with us and our team
            will be happy to help.
        </p>
    </div>

    <!-- Contact Section -->
    <div class="section-title">
        <h2>Get In Touch</h2>
        <p>We are here to help with your questions, support requests, and system-related information.</p>
    </div>

    <div class="contact-grid">

        <!-- Contact Information -->
        <div class="col-info">
            <div class="contact-card">
                <h3>Contact Information</h3>

                <?php foreach ($contact_items as $item): ?>
                    <div class="contact-item">
                        <span class="contact-icon"><?= $item[0] ?></span>
                        <div>
                            <strong><?= $item[1] ?></strong>
                            <?= $item[2] ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- Message Form -->
        <div class="col-form">
            <div class="contact-card">
                <h3>Send Us a Message</h3>

                <form method="POST">

                    <div class="form-group">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Your Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter subject" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Your Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                    </div>

                    <button type="submit" class="btn-contact">Send Message</button>

                </form>
            </div>
        </div>

    </div>

    <!-- Support Section -->
    <div class="support-section">

        <div class="section-title">
            <h2>How Can We Help?</h2>
            <p>Our contact channels are available for different types of questions and assistance.</p>
        </div>

        <div class="grid-3">
            <?php foreach ($support_items as $s): ?>
                <div>
                    <div class="support-box">
                        <div class="support-icon"><?= $s[0] ?></div>
                        <h4><?= $s[1] ?></h4>
                        <p><?= $s[2] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Bottom Section -->
    <div class="contact-footer">
        <h2>We're Here to Help</h2>
        <p>
            Whether you have a question about student records,
            teacher management, departments, or any other feature,
            feel free to contact us. Our goal is to make academic
            management simpler, faster, and more organized.
        </p>
    </div>

</div>
<?php include"footer.php";?>
</body>
</html>