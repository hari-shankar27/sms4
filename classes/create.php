<?php
include "../db.php";


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $class_name = trim($_POST["class_name"]);
    $section = trim($_POST["section"]);
    $academic_year = trim($_POST["academic_year"]);
    $class_teacher = trim($_POST["class_teacher"]);
    $room = trim($_POST["room"]);

    if ($class_name == "" || $section == "" || $academic_year == "" ||
        $class_teacher == "" || $room == "") {

        $error = "All fields are required.";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO classes
            (class_name, section, academic_year, class_teacher, room)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssss",
            $class_name,
            $section,
            $academic_year,
            $class_teacher,
            $room
        );

        if ($stmt->execute()) {
            header("Location:index.php");
            exit;
        }

        $error = "Failed to create class.";
    }
}
include "../dashnav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Class</title>

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
.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h1{
    color:#1e293b;
    margin:0 0 5px;
    font-size:28px;
}

.page-header p{
    color:#64748b;
    font-size:14px;
}


/* FORM BOX */
.form-box{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 8px 25px rgba(0,0,0,.04);
}


/* FORM TITLE */
.form-box h2{
    color:#183b56;
    font-size:21px;
    margin:0 0 25px;
}

.form-box > p{
    color:#64748b;
    font-size:14px;
    margin-top:-15px;
    margin-bottom:25px;
}


/* FORM GRID */
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px 25px;
}


/* FIELD */
.field label{
    display:block;
    color:#475569;
    font-size:13px;
    font-weight:600;
    margin-bottom:8px;
}

.field input{
    width:100%;
    height:44px;
    padding:0 13px;
    border:1px solid #e2e8f0;
    border-radius:9px;
    background:#fff;
    color:#334155;
    font-size:14px;
    outline:none;
    box-sizing:border-box;
    transition:.2s;
}

.field input::placeholder{
    color:#94a3b8;
}

.field input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,.08);
}


/* ERROR */
.error{
    background:#fff1f2;
    color:#dc2626;
    border:1px solid #fecdd3;
    border-radius:9px;
    padding:11px 14px;
    margin-bottom:20px;
    font-size:14px;
}


/* BUTTONS */
.form-actions{
    display:flex;
    align-items:center;
    gap:10px;
    margin-top:28px;
}

.save-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:11px 18px;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    border:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
}

.save-btn:hover{
    opacity:.92;
}

.back-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:11px 18px;
    background:#f1f5f9;
    color:#475569;
    text-decoration:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.back-btn:hover{
    background:#e2e8f0;
}


/* RESPONSIVE */
@media(max-width:768px){

    .classes-page{
        margin-left:0;
        padding:85px 18px 30px;
    }

    body.sidebar-collapsed .classes-page{
        margin-left:0;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:8px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .form-box{
        padding:22px;
    }
}

</style>
</head>

<body>

<main class="classes-page">


    <!-- HEADER -->

    <div class="page-header">

        <div>
            <h1>Create Class</h1>
            <p>Add a new class to the school management system</p>
        </div>

        <a href="index.php" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Classes
        </a>

    </div>


    <!-- FORM -->

    <div class="form-box">

        <h2>Class Information</h2>

        <p>Enter the details of the new class below.</p>


        <?php if($error): ?>

            <div class="error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form method="POST">

            <div class="form-grid">


                <div class="field">

                    <label>Class Name</label>

                    <input
                        type="text"
                        name="class_name"
                        placeholder="e.g. BCA 1st Semester"
                        value="<?= htmlspecialchars($_POST['class_name'] ?? '') ?>"
                    >

                </div>


                <div class="field">

                    <label>Section</label>

                    <input
                        type="text"
                        name="section"
                        placeholder="e.g. A"
                        value="<?= htmlspecialchars($_POST['section'] ?? '') ?>"
                    >

                </div>


                <div class="field">

                    <label>Academic Year</label>

                    <input
                        type="text"
                        name="academic_year"
                        placeholder="e.g. 2026/27"
                        value="<?= htmlspecialchars($_POST['academic_year'] ?? '') ?>"
                    >

                </div>


                <div class="field">

                    <label>Class Teacher</label>

                    <input
                        type="text"
                        name="class_teacher"
                        placeholder="Enter class teacher name"
                        value="<?= htmlspecialchars($_POST['class_teacher'] ?? '') ?>"
                    >

                </div>


                <div class="field">

                    <label>Room</label>

                    <input
                        type="text"
                        name="room"
                        placeholder="e.g. Room 101"
                        value="<?= htmlspecialchars($_POST['room'] ?? '') ?>"
                    >

                </div>


            </div>


            <!-- ACTIONS -->

            <div class="form-actions">

                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-plus"></i>
                    Create Class
                </button>

                <a href="index.php" class="back-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</main>

</body>
</html>