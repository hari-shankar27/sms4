<?php
include("../db.php");


$classes = $conn->query("
    SELECT id, class_name
    FROM classes
    ORDER BY class_name ASC
");


$subjects = $conn->query("
    SELECT id, name, code
    FROM subjects
    ORDER BY name ASC
");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $exam_name   = trim($_POST["exam_name"]);
    $class_id    = (int) $_POST["class_id"];
    $subject_id  = (int) $_POST["subject_id"];
    $exam_date   = $_POST["exam_date"];
    $start_time  = $_POST["start_time"];
    $end_time    = $_POST["end_time"];
    $room        = trim($_POST["room"]);
    $total_marks = (int) $_POST["total_marks"];
    $pass_marks  = (int) $_POST["pass_marks"];

    $stmt = $conn->prepare("
        INSERT INTO exams
        (exam_name, class_id, subject_id, exam_date, start_time, end_time, room, total_marks, pass_marks)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "siissssii",
        $exam_name,
        $class_id,
        $subject_id,
        $exam_date,
        $start_time,
        $end_time,
        $room,
        $total_marks,
        $pass_marks
    );

    $stmt->execute();

    header("Location: index.php");
    exit;
}

include("../dashnav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Exam</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        body {
            background: #f5f7fb;
            color: #1e293b;
            margin: 0;
        }

        .exams-page {
            margin-left: 250px;
            padding: 100px 45px 45px;
            transition: .3s;
        }

        body.sidebar-collapsed .exams-page {
            margin-left: 80px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            margin: 0;
            color: #183b56;
            font-size: 28px;
        }

        .page-header p {
            margin: 6px 0 0;
            color: #64748b;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .06);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        input,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            border: 1px solid #dbe2ea;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
            background: white;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
        }

        .buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .save-btn,
        .cancel-btn {
            padding: 11px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .save-btn {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
        }

        .cancel-btn {
            background: #f1f5f9;
            color: #475569;
        }

        @media (max-width: 700px) {
            .exams-page {
                margin-left: 80px;
                padding: 90px 20px 30px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }
    </style>
</head>

<body>

<div class="exams-page">

    <div class="page-header">
        <h1>Create Exam</h1>
        <p>Add a new examination to the schedule.</p>
    </div>

    <div class="form-box">

        <form method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Exam Name</label>
                    <input type="text"
                           name="exam_name"
                           placeholder="Enter exam name"
                           required>
                </div>

                <div class="form-group">
                    <label>Class</label>
                    <select name="class_id" required>
                        <option value="">Select Class</option>

                        <?php while ($class = $classes->fetch_assoc()): ?>
                            <option value="<?= $class['id'] ?>">
                                <?= htmlspecialchars($class['class_name']) ?>
                            </option>
                        <?php endwhile; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <select name="subject_id" required>
                        <option value="">Select Subject</option>

                        <?php while ($subject = $subjects->fetch_assoc()): ?>
                            <option value="<?= $subject['id'] ?>">
                                <?= htmlspecialchars($subject['name']) ?>
                                (<?= htmlspecialchars($subject['code']) ?>)
                            </option>
                        <?php endwhile; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Exam Date</label>
                    <input type="date"
                           name="exam_date"
                           required>
                </div>

                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time"
                           name="start_time"
                           required>
                </div>

                <div class="form-group">
                    <label>End Time</label>
                    <input type="time"
                           name="end_time"
                           required>
                </div>

                <div class="form-group">
                    <label>Room</label>
                    <input type="text"
                           name="room"
                           placeholder="Enter room number"
                           required>
                </div>

                <div class="form-group">
                    <label>Total Marks</label>
                    <input type="number"
                           name="total_marks"
                           placeholder="e.g. 100"
                           min="1"
                           required>
                </div>

                <div class="form-group">
                    <label>Pass Marks</label>
                    <input type="number"
                           name="pass_marks"
                           placeholder="e.g. 40"
                           min="1"
                           required>
                </div>

            </div>

            <div class="buttons">
                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-plus"></i>
                    Create Exam
                </button>

                <a href="index.php" class="cancel-btn">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>