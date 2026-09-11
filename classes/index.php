<?php
include "../db.php";


/* Get classes */
$stmt = $conn->prepare("
    SELECT id, class_name, section, academic_year, class_teacher, room, created_at
    FROM classes
    ORDER BY id DESC
");
$stmt->execute();
$classes = $stmt->get_result();

/* Cards */
$total = $conn->query("SELECT COUNT(*) total FROM classes")->fetch_assoc()['total'];
$sections = $conn->query("SELECT COUNT(DISTINCT section) total FROM classes")->fetch_assoc()['total'];
$years = $conn->query("SELECT COUNT(DISTINCT academic_year) total FROM classes")->fetch_assoc()['total'];

include "../dashnav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classes</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

/* PAGE */
.classes-page{
    margin-left:250px;
    padding:100px 45px 45px;
    transition:.3s;
}

body.sidebar-collapsed .classes-page{
    margin-left:80px;
}

/* HEADER */
.page-header,
.class-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h1,
.class-header h1{
    color:#1e293b;
    margin:0 0 5px;
    font-size:28px;
}

.page-header p,
.class-header p{
    color:#64748b;
    font-size:14px;
}

/* CARDS */
.scards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
    margin-bottom:24px;
}

.scard{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:15px;
    padding:20px;
    display:flex;
    align-items:center;
    gap:15px;
    transition:.3s;
}

.scard:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(15,23,42,.08);
}

.sicon{
    width:52px;
    height:52px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    text-decoration:none;
    border-radius:12px;
    font-size:20px;
}

.scard strong{
    display:block;
    font-size:25px;
    color:#1e293b;
}

.scard h3{
    font-size:14px;
    color:#64748b;
    margin:3px 0 0;
}

/* CREATE BUTTON */
.create-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:11px 18px;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    text-decoration:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

/* TABLE BOX */
.table-box{
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.04);
}

.table-box h2{
    color:#183b56;
    font-size:21px;
    margin:0 0 20px;
}

.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:850px;
}

th{
    text-align:left;
    padding:14px 12px;
    background:#f8fafc;
    color:#64748b;
    font-size:13px;
}

td{
    padding:16px 12px;
    border-bottom:1px solid #eef2f6;
    color:#475569;
    font-size:14px;
}

/* CLASS NAME */
.class-name{
    display:flex;
    align-items:center;
    gap:10px;
    color:#183b56;
    font-weight:600;
}

.class-avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    background:#e8f4ff;
    color:#2563eb;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

/* BADGES */
.badge{
    display:inline-block;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.section{
    background:#e8f4ff;
    color:#2563eb;
}

.year{
    background:#f3e8ff;
    color:#7e22ce;
}

/* ACTION */
.edit,
.delete{
    padding:6px 13px;
    margin:0 3px;
    border-radius:8px;
    text-decoration:none;
    transition:.3s;
}

.edit{
    background:#e8f4ff;
    color:#2563eb;
}

.delete{
    background:#fbeaec;
    color:red;
}

.edit:hover{
    background:#2563eb;
    color:white;
}

.delete:hover{
    background:red;
    color:white;
}

/* EMPTY */
.empty{
    text-align:center;
    padding:45px;
    color:#7b8794;
}

.empty i{
    font-size:38px;
    color:#2563eb;
}

/* RESPONSIVE */
@media(max-width:1100px){
    .scards{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:768px){

    .classes-page{
        margin-left:0;
        padding:18px;
    }

    body.sidebar-collapsed .classes-page{
        margin-left:0;
    }

    .page-header,
    .class-header{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .scards{
        grid-template-columns:1fr;
    }
}

</style>
</head>

<body>

<main class="classes-page">

<!-- HEADER -->
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>
            Welcome back,
            <?= htmlspecialchars(explode(" ",$_SESSION["name"])[0]) ?>
        </p>
    </div>

    <p>
        <strong>Today:</strong> <?= date("F d, Y") ?>
    </p>
</div>


<!-- CARDS -->
<div class="scards">

    <div class="scard">
        <div class="sicon">
            <i class="fa-solid fa-school"></i>
        </div>
        <div>
            <strong><?= $total ?></strong>
            <h3>Total Classes</h3>
        </div>
    </div>

    <div class="scard">
        <div class="sicon">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div>
            <strong><?= $sections ?></strong>
            <h3>Total Sections</h3>
        </div>
    </div>

    <div class="scard">
        <div class="sicon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <div>
            <strong><?= $years ?></strong>
            <h3>Academic Years</h3>
        </div>
    </div>

    <div class="scard">
        <a href="create.php" class="sicon">
            <i class="fa-solid fa-plus"></i>
        </a>
        <div>
            <strong>+</strong>
            <h3>Create Class</h3>
        </div>
    </div>

</div>


<!-- CLASS HEADER -->
<div class="class-header">
    <div>
        <h1>Classes</h1>
        <p>Manage registered classes</p>
    </div>

    <a href="create.php" class="create-btn">
        <i class="fa-solid fa-plus"></i>
        Create Class
    </a>
</div>


<!-- TABLE -->
<div class="table-box">

    <h2>Registered Classes</h2>

    <?php if($classes->num_rows > 0): ?>

    <div class="table-wrapper">

    <table>

        <tr>
            <th>S.NO.</th>
            <th>Class Name</th>
            <th>Section</th>
            <th>Academic Year</th>
            <th>Class Teacher</th>
            <th>Room</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>

        <?php $i=1; ?>

        <?php while($class=$classes->fetch_assoc()): ?>

        <tr>

            <td><?= $i++ ?></td>

            <td>
                <div class="class-name">

                    <div class="class-avatar">
                        <?= strtoupper(substr($class['class_name'],0,1)) ?>
                    </div>

                    <?= htmlspecialchars($class['class_name']) ?>

                </div>
            </td>

            <td>
                <span class="badge section">
                    <?= htmlspecialchars($class['section']) ?>
                </span>
            </td>

            <td>
                <span class="badge year">
                    <?= htmlspecialchars($class['academic_year']) ?>
                </span>
            </td>

            <td>
                <?= htmlspecialchars($class['class_teacher'] ?? 'N/A') ?>
            </td>

            <td>
                <?= htmlspecialchars($class['room'] ?? 'N/A') ?>
            </td>

            <td>
                <?= date("d M Y",strtotime($class['created_at'])) ?>
            </td>

            <td>
                <a href="edit.php?id=<?= $class['id'] ?>" class="edit">
                    Edit
                </a>

                <a href="delete.php?id=<?= $class['id'] ?>"
                   class="delete"
                   onclick="return confirm('Are you sure you want to delete this class?')">
                    Delete
                </a>
            </td>

        </tr>

        <?php endwhile; ?>

    </table>

    </div>

    <?php else: ?>

    <div class="empty">
        <i class="fa-solid fa-school"></i>
        <h3>No Classes Found</h3>
        <p>No classes have been registered yet.</p>
    </div>

    <?php endif; ?>

</div>

</main>

</body>
</html>