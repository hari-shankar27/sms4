<?php
include("../db.php");

$stmt = $conn->prepare("
    SELECT id, title, description, event_date, start_time, end_time,
           location, event_type, created_at
    FROM events
    ORDER BY event_date ASC, start_time ASC
");
$stmt->execute();
$events = $stmt->get_result();

$totalEvents = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
$upcomingEvents = $conn->query("SELECT COUNT(*) AS total FROM events WHERE event_date >= CURDATE()")->fetch_assoc()['total'];
$todayEvents = $conn->query("SELECT COUNT(*) AS total FROM events WHERE event_date = CURDATE()")->fetch_assoc()['total'];
$types = $conn->query("SELECT COUNT(DISTINCT event_type) AS total FROM events")->fetch_assoc()['total'];

include("../dashnav.php");
?>

<style>
body{
    background:#f5f7fb;
    color:#1e293b;
}

.events-page{
    margin-left:250px;
    padding:100px 45px 45px;
    transition:.3s;
}

body.sidebar-collapsed .events-page{
    margin-left:80px;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.page-header h2{
    margin:0;
    color:#183b56;
    font-weight:700;
}

.page-header p{
    margin:6px 0 0;
    color:#64748b;
}

.add-btn{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:10px;
    font-weight:600;
}

.add-btn:hover{
    color:white;
    opacity:.9;
}

.stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.stat-card{
    background:white;
    padding:22px;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(15,23,42,.06);
}

.stat-card i{
    font-size:22px;
    color:#2563eb;
    margin-bottom:12px;
}

.stat-card h3{
    margin:0;
    font-size:28px;
    color:#183b56;
}

.stat-card p{
    margin:5px 0 0;
    color:#64748b;
}

.events-box{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 5px 20px rgba(15,23,42,.06);
}

.events-box h3{
    margin:0 0 20px;
    color:#183b56;
}

.table-responsive{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f8fafc;
    color:#475569;
    padding:14px;
    text-align:left;
    font-size:14px;
}

td{
    padding:15px 14px;
    border-top:1px solid #eef2f7;
    color:#475569;
}

.event-title{
    font-weight:600;
    color:#183b56;
}

.event-type{
    display:inline-block;
    padding:5px 10px;
    border-radius:20px;
    background:#eff6ff;
    color:#2563eb;
    font-size:12px;
    font-weight:600;
}

.action{
    display:flex;
    gap:8px;
}

.edit-btn,
.delete-btn{
    width:34px;
    height:34px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    text-decoration:none;
}

.edit-btn{
    background:#eff6ff;
    color:#2563eb;
}

.delete-btn{
    background:#fef2f2;
    color:#dc2626;
}

.edit-btn:hover,
.delete-btn:hover{
    opacity:.8;
}

@media(max-width:1000px){
    .stats{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:700px){
    .events-page{
        margin-left:0;
        padding:90px 20px 30px;
    }

    body.sidebar-collapsed .events-page{
        margin-left:0;
    }

    .page-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .stats{
        grid-template-columns:1fr;
    }
}
</style>

<div class="events-page">

    <div class="page-header">
        <div>
            <h2>Events</h2>
            <p>Manage school events and activities</p>
        </div>

        <a href="create.php" class="add-btn">
            <i class="fa-solid fa-plus"></i> Add Event
        </a>
    </div>

    <div class="stats">

        <div class="stat-card">
            <i class="fa-solid fa-calendar-days"></i>
            <h3><?= $totalEvents ?></h3>
            <p>Total Events</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-calendar-check"></i>
            <h3><?= $upcomingEvents ?></h3>
            <p>Upcoming Events</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-calendar-day"></i>
            <h3><?= $todayEvents ?></h3>
            <p>Today's Events</p>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-layer-group"></i>
            <h3><?= $types ?></h3>
            <p>Event Types</p>
        </div>

    </div>

    <div class="events-box">

        <h3>All Events</h3>

        <div class="table-responsive">
            <table>

                <thead>
                    <tr>
                        <th>S.NO.</th>
                        <th>Event</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php if ($events->num_rows > 0): ?>

                    <?php $sn = 1; ?>

                    <?php while ($event = $events->fetch_assoc()): ?>

                        <tr>

                            <td><?= $sn++ ?></td>

                            <td>
                                <div class="event-title">
                                    <?= htmlspecialchars($event['title']) ?>
                                </div>

                                <small>
                                    <?= htmlspecialchars($event['description']) ?>
                                </small>
                            </td>

                            <td>
                                <span class="event-type">
                                    <?= htmlspecialchars($event['event_type']) ?>
                                </span>
                            </td>

                            <td>
                                <?= date('d M Y', strtotime($event['event_date'])) ?>
                            </td>

                            <td>
                                <?= date('h:i A', strtotime($event['start_time'])) ?>
                                -
                                <?= date('h:i A', strtotime($event['end_time'])) ?>
                            </td>

                            <td>
                                <i class="fa-solid fa-location-dot"></i>
                                <?= htmlspecialchars($event['location']) ?>
                            </td>

                            <td>
                                <div class="action">

                                    <a href="edit.php?id=<?= $event['id'] ?>"
                                       class="edit-btn"
                                       title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="delete.php?id=<?= $event['id'] ?>"
                                       class="delete-btn"
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this event?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="7" style="text-align:center;padding:30px;">
                            No events found.
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>