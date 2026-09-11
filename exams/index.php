<?php
include("../db.php");


//Get exams
$stmt = $conn->prepare("
    SELECT 
        exams.id,
        exams.exam_name,
        classes.class_name,
        subjects.name AS subject_name,
        exams.exam_date,
        exams.start_time,
        exams.end_time,
        exams.room,
        exams.total_marks
    FROM exams
    LEFT JOIN classes ON exams.class_id = classes.id
    LEFT JOIN subjects ON exams.subject_id = subjects.id
    ORDER BY exams.exam_date ASC
");

$stmt->execute();
$exams = $stmt->get_result();


$total_exams = $exams->num_rows;

$upcoming = 0;
$subjects = [];
$classes = [];

while ($exam = $exams->fetch_assoc()) {
    if ($exam['exam_date'] >= date('Y-m-d')) {
        $upcoming++;
    }

    $subjects[$exam['subject_name']] = true;
    $classes[$exam['class_name']] = true;
}

$stmt->execute();
$exams = $stmt->get_result();

include("../dashnav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Exams</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .add-btn {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            padding: 12px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }

        .add-btn i {
            margin-right: 6px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .06);
        }

        .card-title {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .card-value {
            font-size: 27px;
            font-weight: 700;
            color: #183b56;
        }

        .table-box {
            background: white;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .06);
            overflow-x: auto;
        }

        .table-box h2 {
            margin: 0 0 20px;
            font-size: 20px;
            color: #183b56;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            background: #f8fafc;
            color: #64748b;
            font-size: 13px;
            text-align: left;
            padding: 14px;
        }

        td {
            padding: 15px 14px;
            border-bottom: 1px solid #eef2f7;
            font-size: 14px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            background: #eef2ff;
            color: #4f46e5;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .edit,
        .delete {
            padding: 7px 11px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        .edit {
            background: #eff6ff;
            color: #2563eb;
        }

        .delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        @media (max-width: 1000px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .exams-page {
                margin-left: 80px;
                padding: 90px 20px 30px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="exams-page">

    <div class="page-header">
        <div>
            <h1>Exams</h1>
            <p>Manage and view all examinations.</p>
        </div>

        <a href="create.php" class="add-btn">
            <i class="fa-solid fa-plus"></i>
            Create Exam
        </a>
    </div>
    <div class="summary">

        <div class="card">
            <div class="card-title">Total Exams</div>
            <div class="card-value"><?= $total_exams ?></div>
        </div>

        <div class="card">
            <div class="card-title">Upcoming Exams</div>
            <div class="card-value"><?= $upcoming ?></div>
        </div>

        <div class="card">
            <div class="card-title">Subjects</div>
            <div class="card-value"><?= count($subjects) ?></div>
        </div>

        <div class="card">
            <div class="card-title">Classes</div>
            <div class="card-value"><?= count($classes) ?></div>
        </div>

    </div>
    <div class="table-box">

        <h2>Exam Schedule</h2>

        <table>
            <thead>
                <tr>
                    <th>S.NO.</th>
                    <th>Exam</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Marks</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            <?php if ($exams->num_rows > 0): ?>

                <?php $sn = 1; ?>

                <?php while ($exam = $exams->fetch_assoc()): ?>

                    <tr>
                        <td><?= $sn++ ?></td>

                        <td>
                            <strong><?= htmlspecialchars($exam['exam_name']) ?></strong>
                        </td>

                        <td>
                            <span class="badge">
                                <?= htmlspecialchars($exam['class_name']) ?>
                            </span>
                        </td>

                        <td>
                            <?= htmlspecialchars($exam['subject_name']) ?>
                        </td>

                        <td>
                            <?= date('d M Y', strtotime($exam['exam_date'])) ?>
                        </td>

                        <td>
                            <?= date('h:i A', strtotime($exam['start_time'])) ?>
                            -
                            <?= date('h:i A', strtotime($exam['end_time'])) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($exam['room']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($exam['total_marks']) ?>
                        </td>

                        <td>
                            <div class="actions">

                                <a href="edit.php?id=<?= $exam['id'] ?>"
                                   class="edit">
                                    <i class="fa-solid fa-pen"></i>
                                    Edit
                                </a>

                                <a href="delete.php?id=<?= $exam['id'] ?>"
                                   class="delete"
                                   onclick="return confirm('Are you sure you want to delete this exam?')">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </a>

                            </div>
                        </td>
                    </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>
                    <td colspan="9" class="empty">
                        No exams found.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>
        </table>

    </div>

</div>

</body>
</html>