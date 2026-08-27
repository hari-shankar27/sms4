<?php
include 'navbar.php';

// Replace with a real query later, e.g.
// $notices = $pdo->query("SELECT * FROM notices ORDER BY date DESC")->fetchAll();
$notices = [
    ["date" => "2026-08-25", "category" => "Exam",     "title" => "Mid-Term Examination Routine Published",     "description" => "The mid-term examination schedule for all departments has been published. Students are advised to check their respective timetables and prepare accordingly."],
    ["date" => "2026-08-20", "category" => "Holiday",  "title" => "Institution Closed for Public Holiday",       "description" => "The institution will remain closed on account of a public holiday. Regular classes will resume the following working day."],
    ["date" => "2026-08-15", "category" => "Academic", "title" => "New Semester Registration Now Open",          "description" => "Registration for the upcoming semester is now open for all eligible students. Please complete the registration process before the deadline."],
    ["date" => "2026-08-10", "category" => "Event",    "title" => "Annual Sports Week Announced",                "description" => "The annual sports week will be held next month. Interested students can register with their respective department coordinators."],
    ["date" => "2026-08-05", "category" => "Academic", "title" => "Guest Lecture on Modern Teaching Methods",    "description" => "A guest lecture session for teaching staff has been scheduled. Attendance is encouraged for all faculty members."],
];

$categories = ["All", "Academic", "Exam", "Event", "Holiday"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices - School Management System</title>

    <!-- Bootstrap (used for .container, .row, .col-md-* grid classes) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .notices-wrapper {
            padding: 30px 0 60px;
        }

        /* Hero Section */
        .notices-hero {
            background: linear-gradient(135deg, #1d4ed8, #2563eb, #3b82f6);
            color: white;
            padding: 60px 35px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 50px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.25);
        }

        .notices-hero h1 {
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .notices-hero p {
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

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 40px;
        }

        .filter-btn {
            background: white;
            border: 1px solid #dbeafe;
            color: #1d4ed8;
            padding: 9px 22px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background: #eff6ff;
        }

        .filter-btn.active {
            background: #1d4ed8;
            color: white;
            border-color: #1d4ed8;
        }

        /* Notice Card */
        .notice-list {
            max-width: 850px;
            margin: 0 auto;
        }

        .notice-card {
            display: flex;
            gap: 25px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .notice-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .notice-date {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .notice-date .day {
            font-size: 24px;
            font-weight: 700;
            line-height: 1;
        }

        .notice-date .month {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .notice-body h3 {
            font-size: 22px;
            font-weight: 600;
            color: #222;
            margin-bottom: 10px;
        }

        .notice-body p {
            color: #666;
            line-height: 1.7;
            margin-bottom: 12px;
        }

        .notice-tag {
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .no-notices {
            text-align: center;
            color: #777;
            font-size: 17px;
            padding: 40px 0;
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .notices-hero {
                padding: 60px 25px;
            }

            .notices-hero h1 {
                font-size: 34px;
            }

            .notices-hero p {
                font-size: 16px;
            }

            .notice-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .notice-date {
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>
<body>

<div class="container notices-wrapper">

    <!-- Hero Section -->
    <div class="notices-hero">

        <h1>Notices &amp; Announcements</h1>

        <p>
            Stay updated with the latest academic notices, exam schedules,
            events, and important announcements from the institution.
        </p>

    </div>


    <!-- Section Title -->
    <div class="section-title">

        <h2>Latest Updates</h2>

        <p>
            Browse recent notices or filter by category to find what's
            relevant to you.
        </p>

    </div>


    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <?php foreach ($categories as $cat): ?>
            <button class="filter-btn <?= $cat === 'All' ? 'active' : '' ?>" data-filter="<?= $cat ?>">
                <?= $cat ?>
            </button>
        <?php endforeach; ?>
    </div>


    <!-- Notice List -->
    <div class="notice-list" id="noticeList">

        <?php if (empty($notices)): ?>

            <p class="no-notices" style="display:block;">No notices available at the moment.</p>

        <?php else: ?>

            <?php foreach ($notices as $notice): ?>
                <?php
                    $timestamp = strtotime($notice['date']);
                    $day   = date('d', $timestamp);
                    $month = date('M', $timestamp);
                ?>
                <div class="notice-card" data-category="<?= htmlspecialchars($notice['category']) ?>">

                    <div class="notice-date">
                        <span class="day"><?= $day ?></span>
                        <span class="month"><?= $month ?></span>
                    </div>

                    <div class="notice-body">
                        <span class="notice-tag"><?= htmlspecialchars($notice['category']) ?></span>
                        <h3><?= htmlspecialchars($notice['title']) ?></h3>
                        <p><?= htmlspecialchars($notice['description']) ?></p>
                    </div>

                </div>
            <?php endforeach; ?>

            <p class="no-notices" id="noResults">No notices found in this category.</p>

        <?php endif; ?>

    </div>

</div>

<!-- Bootstrap JS bundle (optional, needed only if you use Bootstrap components elsewhere) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Simple client-side category filter
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.notice-card');
    const noResults = document.getElementById('noResults');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;
            let visibleCount = 0;

            cards.forEach(card => {
                const match = filter === 'All' || card.dataset.category === filter;
                card.style.display = match ? 'flex' : 'none';
                if (match) visibleCount++;
            });

            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
</script>

</body>
</html>