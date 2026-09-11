<?php
session_start();

include "db.php";

// Check login before including any HTML
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $created_at = $_POST["created_at"] ?? "";

    if (empty($title) || empty($description) || empty($created_at)) {

        $message = "Please fill in all fields.";
        $messageType = "error";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO notices (title, description, created_at)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param(
            "sss",
            $title,
            $description,
            $created_at,
        );

        if ($stmt->execute()) {

            // Redirect after successful creation
            header("Location: dashboard1.php");
            exit;

        } else {

            $message = "Failed to create notice.";
            $messageType = "error";

        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Notice</title>

    <link rel="stylesheet" href="dashboad.cs">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <style>
      /* =========================================
   CREATE NOTICE PAGE
========================================= */

.dashboard-content {
    margin-left: 400px;
    padding: 105px 30px 35px;
    min-height: 100vh;
    transition: margin-left 0.3s ease;
}

/* When sidebar is collapsed */
body.sidebar-collapsed .dashboard-content {
    margin-left: 300px;
}

/* Page Header */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}

.page-header h1 {
    margin: 0 0 7px;
    color: #1e293b;
    font-size: 27px;
    font-weight: 750;
    letter-spacing: -0.5px;
}

.page-header p {
    margin: 0;
    color: #64748b;
    font-size: 13px;
}

/* Back Button */
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 16px;
    border-radius: 10px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: #2563eb;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.back-btn:hover {
    background: #eff6ff;
    border-color: #bfdbfe;
    color: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(37, 99, 235, 0.08);
}

/* Alert Messages */
.alert {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
    margin-bottom: 22px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
}

.alert.success {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #047857;
}

.alert.error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
}

/* Main Form Card */
.notice-form-box {
    width: 100%;
    max-width: 850px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 12px 35px rgba(15, 23, 42, 0.05);
}

/* Form Heading */
.form-heading {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-bottom: 24px;
    margin-bottom: 27px;
    border-bottom: 1px solid #f1f5f9;
}

.form-heading-icon {
    width: 52px;
    height: 52px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: #ffffff;
    font-size: 21px;
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.18);
}

.form-heading h2 {
    margin: 0 0 5px;
    color: #1e293b;
    font-size: 20px;
    font-weight: 750;
}

.form-heading p {
    margin: 0;
    color: #94a3b8;
    font-size: 13px;
}

/* Form Group */
.form-group {
    margin-bottom: 23px;
}

.form-group label {
    display: block;
    margin-bottom: 9px;
    color: #334155;
    font-size: 13px;
    font-weight: 700;
}

/* Input Wrapper */
.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 16px;
    z-index: 1;
    color: #94a3b8;
    font-size: 14px;
    pointer-events: none;
}

/* Text Input */
.input-wrapper input {
    width: 100%;
    height: 49px;
    padding: 0 15px 0 44px;
    border: 1px solid #e2e8f0;
    border-radius: 11px;
    outline: none;
    background: #f8fafc;
    color: #334155;
    font-family: inherit;
    font-size: 13px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.input-wrapper input:hover,
.form-group textarea:hover {
    border-color: #cbd5e1;
}

.input-wrapper input:focus,
.form-group textarea:focus {
    border-color: #2563eb;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
}

.input-wrapper input::placeholder,
.form-group textarea::placeholder {
    color: #94a3b8;
}

/* Date Input */
.input-wrapper input[type="date"] {
    color: #475569;
    cursor: pointer;
}

/* Textarea */
.form-group textarea {
    width: 100%;
    min-height: 155px;
    padding: 14px 15px;
    border: 1px solid #e2e8f0;
    border-radius: 11px;
    outline: none;
    resize: vertical;
    background: #f8fafc;
    color: #334155;
    font-family: inherit;
    font-size: 13px;
    line-height: 1.7;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

/* Form Actions */
.form-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
    padding-top: 8px;
    margin-top: 5px;
}

/* Common Button Style */
.cancel-btn,
.submit-btn {
    min-height: 45px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 0 19px;
    border-radius: 11px;
    font-family: inherit;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

/* Cancel Button */
.cancel-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #64748b;
}

.cancel-btn:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #334155;
    transform: translateY(-2px);
}

/* Submit Button */
.submit-btn {
    border: none;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: #ffffff;
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.18);
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(37, 99, 235, 0.25);
}

.submit-btn:active,
.cancel-btn:active,
.back-btn:active {
    transform: translateY(0);
}

/* Dashnav Compatibility */
.dashnav {
    position: fixed;
    top: 70px;
    left: 250px;
    right: 0;
    z-index: 998;
    transition: left 0.3s ease;
}

body.sidebar-collapsed .dashnav {
    left: 80px;
}

/* Responsive Design */
@media (max-width: 1000px) {
    .dashboard-content {
        padding: 105px 22px 30px;
    }

    .notice-form-box {
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .dashboard-content {
        margin-left: 0;
        padding: 95px 18px 25px;
    }

    body.sidebar-collapsed .dashboard-content {
        margin-left: 0;
    }

    .dashnav {
        left: 0;
    }

    body.sidebar-collapsed .dashnav {
        left: 0;
    }

    .page-header {
        align-items: flex-start;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .page-header h1 {
        font-size: 23px;
    }

    .back-btn {
        width: 100%;
    }

    .notice-form-box {
        padding: 22px;
        border-radius: 16px;
    }
}

@media (max-width: 520px) {
    .dashboard-content {
        padding: 95px 14px 22px;
    }

    .notice-form-box {
        padding: 18px;
    }

    .form-heading {
        gap: 11px;
        padding-bottom: 20px;
        margin-bottom: 22px;
    }

    .form-heading-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        font-size: 18px;
    }

    .form-heading h2 {
        font-size: 18px;
    }

    .form-actions {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    .cancel-btn,
    .submit-btn {
        width: 100%;
    }

    .alert {
        align-items: flex-start;
    }
}
    </style>
</head>

<body>

    <?php include "dashnav.php"; ?>

    <main class="dashboard-content">

        <div class="page-header">
            <div>
                <h1>Create Notice</h1>
                <p>Publish an important announcement for students and teachers.</p>
            </div>

            <a href="notice.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                View Notices
            </a>
        </div>

        <?php if (!empty($message)): ?>

            <div class="alert <?= htmlspecialchars($messageType) ?>">
                <i class="fa-solid
                    <?= $messageType === "success"
                        ? "fa-circle-check"
                        : "fa-circle-exclamation" ?>">
                </i>

                <?= htmlspecialchars($message) ?>
            </div>

        <?php endif; ?>

        <div class="notice-form-box">

            <div class="form-heading">
                <div class="form-heading-icon">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>

                <div>
                    <h2>New Notice</h2>
                    <p>Enter the details of the notice below.</p>
                </div>
            </div>

            <form method="POST" action="">

                <div class="form-group">
                    <label for="title">Notice Title</label>

                    <div class="input-wrapper">
                        <i class="fa-solid fa-heading"></i>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Enter notice title"
                            maxlength="255"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Notice Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Write your notice here..."
                        rows="6"
                        required
                    ></textarea>
                </div>

                <div class="form-group">
                    <label for="created_at">Notice Date</label>

                    <div class="input-wrapper">
                        <i class="fa-regular fa-calendar"></i>

                        <input
                            type="date"
                            id="created_at"
                            name="created_at"
                            value="<?= date("Y-m-d") ?>"
                            required
                        >
                    </div>
                </div>

                <div class="form-actions">

                    <a href="dashboard.php" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="submit-btn">
                        <i class="fa-solid fa-paper-plane"></i>
                        Publish Notice
                    </button>

                </div>

            </form>

        </div>

    </main>

</body>
</html>