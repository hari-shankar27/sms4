```php
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";
include "dashnav.php";

// Get all notices
$sql = "SELECT id, title, description, created_at
        FROM notices
        ORDER BY created_at DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Error loading notices: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
<style>
.notice-container{
    margin-left: 250px;
     padding: 95px 45px 45px;

}
body.sidebar-collapsed .notice-container{
    margin-left: 80px;
}
.notice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
}

.notice-header h1 {
        font-size: 28px;
        color: #1e293b;
        margin-bottom: 5px;
 }

.notice-header p {
        color: #64748b;
        font-size: 14px;
    }

.create-notice {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 18px;
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .create-notice:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
    }

    .notice-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        width: 100%;
    }

  .notice-card {
    position: relative;
    width: 100%;
    padding: 24px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
    transition: 0.3s ease;
    overflow: hidden;
}


.notice-card::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #2563eb, #4f46e5);
}

.main {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}


.notice-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #eef2ff;
    color: #4f46e5;
}


.main > div:last-child {
    flex: 1;
}

.notice-card h2 {
    margin: 0 0 2px;
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
}

.notice-card p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.7;
}

.notice-date {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-top: 18px;
    padding-top: 13px;
    border-top: 1px solid #f1f5f9;
    color: #94a3b8;
    font-size: 12px;
}

.notice-date i {
    color: #64748b;
}
    .no-notice {
        grid-column: 1 / -1;
        background: white;
        padding: 60px 30px;
        text-align: center;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        color: #64748b;
    }

    .no-notice i {
        font-size: 45px;
        color: #cbd5e1;
        margin-bottom: 15px;
    }

    .no-notice h3 {
        color: #334155;
        margin-bottom: 7px;
    }

    @media (max-width: 900px) {
        .notice-list {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .notice-container {
            margin-left: 0;
            padding: 90px 18px 30px;
        }

        body.sidebar-collapsed .notice-container {
            margin-left: 0;
        }

        .notice-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .create-notice {
            width: 100%;
            justify-content: center;
        }
    }
</style>

</head>
<body>
    



<div class="notice-container">

    <div class="notice-header">

        <div>
            <h1>Notice Board</h1>
            <p>Latest notices and announcements from the school.</p>
        </div>

        <?php if ($_SESSION["role"] === "admin"): ?>
            <a href="create-notice.php" class="create-notice">
                <i class="fa-solid fa-plus"></i>
                Create Notice
            </a>
        <?php endif; ?>

    </div>


    <div class="notice-list">

        <?php if ($result->num_rows > 0): ?>

            <?php while ($notice = $result->fetch_assoc()): ?>

                <div class="notice-card">
<div class="main">
                    <div class="notice-icon">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
<div>
                    <h2>
                        <?= htmlspecialchars($notice["title"]) ?>
                    </h2>

                    <p>
                        <?= nl2br(htmlspecialchars($notice["description"])) ?>
                    </p>
</div>
</div>
                    <div class="notice-date">
                        <i class="fa-regular fa-calendar"></i>

                        Published on
                        <?= date("F d, Y", strtotime($notice["created_at"])) ?>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="no-notice">

                <i class="fa-regular fa-bell-slash"></i>

                <h3>No notices available</h3>

                <p>
                    There are currently no notices to display.
                </p>

            </div>

        <?php endif; ?>

    </div>

</div>
  

</body>
</html>