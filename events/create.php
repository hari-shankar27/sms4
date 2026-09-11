<?php
include("../db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $event_date = $_POST["event_date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $location = trim($_POST["location"]);
    $event_type = trim($_POST["event_type"]);

    if ($title === "" || $event_date === "" || $start_time === "" || $end_time === "" || $location === "" || $event_type === "") {
        $error = "Please fill in all required fields.";
    } else {

        $stmt = $conn->prepare("
            INSERT INTO events
            (title, description, event_date, start_time, end_time, location, event_type)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssssss",
            $title,
            $description,
            $event_date,
            $start_time,
            $end_time,
            $location,
            $event_type
        );

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        }

        $error = "Failed to create event.";
    }
}
include("../dashnav.php");
?>

<style>
body{
    background:#f5f7fb;
    color:#1e293b;
}

.event-page{
    margin-left:250px;
    padding:100px 45px 45px;
    transition:.3s;
}

body.sidebar-collapsed .event-page{
    margin-left:80px;
}

.form-box{
    max-width:900px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(15,23,42,.06);
}

.form-header{
    margin-bottom:25px;
}

.form-header h2{
    margin:0;
    color:#183b56;
}

.form-header p{
    margin:6px 0 0;
    color:#64748b;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

.form-group.full{
    grid-column:1 / -1;
}

label{
    margin-bottom:7px;
    font-weight:600;
    color:#334155;
}

input,
textarea,
select{
    width:100%;
    padding:12px 14px;
    border:1px solid #dbe3ec;
    border-radius:10px;
    outline:none;
    font-size:14px;
    box-sizing:border-box;
}

textarea{
    height:110px;
    resize:none;
}

input:focus,
textarea:focus,
select:focus{
    border-color:#2563eb;
}

.form-actions{
    margin-top:25px;
    display:flex;
    gap:10px;
}

.save-btn{
    border:0;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    padding:12px 22px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

.cancel-btn{
    background:#f1f5f9;
    color:#475569;
    text-decoration:none;
    padding:12px 22px;
    border-radius:10px;
    font-weight:600;
}

.error{
    background:#fef2f2;
    color:#dc2626;
    padding:12px;
    border-radius:10px;
    margin-bottom:20px;
}

@media(max-width:700px){
    .event-page{
        margin-left:0;
        padding:90px 20px 30px;
    }

    body.sidebar-collapsed .event-page{
        margin-left:0;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .form-group.full{
        grid-column:auto;
    }
}
</style>

<div class="event-page">

    <div class="form-box">

        <div class="form-header">
            <h2>Add Event</h2>
            <p>Create a new school event</p>
        </div>

        <?php if ($error): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="form-grid">

                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" placeholder="Enter event title" required>
                </div>

                <div class="form-group">
                    <label>Event Type</label>
                    <select name="event_type" required>
                        <option value="">Select Type</option>
                        <option value="Academic">Academic</option>
                        <option value="Sports">Sports</option>
                        <option value="Cultural">Cultural</option>
                        <option value="Meeting">Meeting</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" placeholder="Enter event description"></textarea>
                </div>

                <div class="form-group">
                    <label>Event Date</label>
                    <input type="date" name="event_date" required>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" placeholder="Enter location" required>
                </div>

                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" name="start_time" required>
                </div>

                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" name="end_time" required>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-plus"></i> Create Event
                </button>

                <a href="index.php" class="cancel-btn">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>