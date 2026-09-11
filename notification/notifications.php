<?php

session_start();
include "../db.php";
include "../dashnav.php";



$stmt = $conn->prepare("SELECT id, user_id, title, message, is_read, created_at FROM notifications ORDER BY created_at DESC");
$stmt->execute();
$notifications = $stmt->get_result();

$countStmt = $conn->prepare("SELECT COUNT(*) AS total FROM notifications WHERE is_read = 0");
$countStmt->execute();
$unreadStmt = $countStmt->get_result()->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

.notification-page{
    margin-left: 250px;
    padding: 100px 35px 35px;
    min-height: 100vh;
    transition: margin-left 0.3s ease;
}
body.sidebar-collapsed .notification-page{
    margin-left: 80px;
}
.nheader{
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    
}
 .nheader h2 {
            font-size: 30px;
            font-weight: 700;
            color: #172554;
            margin-bottom: 8px;
        }

        .nheader p {
            color: #64748b;
            font-size: 15px;
        }

        .nheader p i {
            margin-right: 6px;
        }

.nheader a{
    padding: 12px 13px;
    border-radius: 12px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    text-decoration: none;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    font-family: inherit;
    font-weight: 600;
}
.nheader a:hover{
    background: #1d4ed8;
}
.ngrid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 20px;
}

.ncard{
    background: white;
        border: 1px solid #e2e8f0;
        padding: 22px;
        gap: 16px;
        border-radius: 14px;
        display: flex;
    align-items: center;
}
.si{
    font-size: 21px;
    height: 52px;
    width: 52px;
    display: flex;
    align-items: center;
    border-radius: 16px;
    justify-content: center;
}
.si.blue{
 background: #dbeafe;
            color: #2563eb;
}
  .si.orange {
            background: #ffedd5;
            color: #ea580c;
        }

        .si.green {
            background: #dcfce7;
            color: #16a34a;
        }
.ncard h3{
   font-size: 25px;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .ncard span {
            font-size: 13px;
            color: #64748b;
}
.nsection{
    background: white;
    border-radius: 12px;
    border: 1px solid #e2e8f0;

}
.nohead{
    padding: 22px 25px;
    display: flex;
    align-self: center;
    justify-content: space-between;
    margin: 5px;
}
.nohead h2{
 font-size: 19px;
            color: #172554;
        }

        .nhead h2 i {
            color: #2563eb;
            margin-right: 8px;
        }
.uncount{
     background: #dbeafe;
    color: #1d4ed8;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 600;
}

.nolist{
display: flex;
flex-direction: column;
}
.noitem{
display: flex;
align-items: flex-start;
padding: 22px 25px;
gap: 16px;
     border-bottom: 1px solid #f1f5f9;
     position: relative;

}
 .noitem:last-child{
    border-bottom:none ;
 }

.noitem:hover{
 background: #f8fafc;
}
.noitem.unread{
  background: #f8fbff;
}
.noitem.unread::before {
 content: "";
 position: absolute;
 left: 0;
 top: 0;
 bottom: 0;
 width: 4px;
 background: #2563eb;
        }

.noitem.unread .noicon{
              background: #2563eb;
            color: white;
        }

.noicon{
width: 48px;
 height: 48px;
 min-width: 48px;
border-radius: 14px;
 background: #dbeafe;
 color: #2563eb;
 display: flex;
align-items: center;
justify-content: center;
font-size: 20px;
}

.nocontent{
flex: 1;
}
.nocontent h3{
 font-size: 16px;
            font-weight: 650;
            color: #1e293b;
            margin-bottom: 7px;
}
.nocontent p{
    font-size: 14px;
            line-height: 1.6;
            color: #64748b;
         margin-bottom: 10px;
}

.notime{
     font-size: 12px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 5px;
}


        .nostatus {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .nostatus.unread {
            background: #dbeafe;
            color: #2563eb;
        }

        .nostatus.read {
            background: #f1f5f9;
            color: #64748b;
}
        .empty-notification {
            text-align: center;
            padding: 70px 20px;
        }

        .empty-notification i {
            font-size: 55px;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        .empty-notification h3 {
            font-size: 20px;
            color: #334155;
            margin-bottom: 8px;
        }

        .empty-notification p {
            color: #94a3b8;
            font-size: 14px;
        }



        @media (max-width: 1100px) {

            .notification-page {
                margin-left: 0;
                padding: 25px;
            }

            .ngrid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 700px) {

            .notification-page {
                padding: 20px 15px;
            }

            .nheader {
                flex-direction: column;
                align-items: flex-start;
            }

            .nheader h1 {
                font-size: 25px;
            }

            .ngrid {
                grid-template-columns: 1fr;
            }

            .nohead {
                padding: 18px;
            }

            .noitem {
                padding: 18px;
                gap: 12px;
            }

            .noicon {
                width: 42px;
                height: 42px;
                min-width: 42px;
                font-size: 17px;
            }

            .ncontent h3 {
                font-size: 15px;
            }

            .ncontent p {
                font-size: 13px;
            }

            .notification-status {
                display: none;
            }

        }

    </style>
</head>

<body>



    <main class="notification-page">

    <div class="nheader">
<div>
    <h2>Notifications</h2>
    <p><i class="fa-regular fa-bell"></i>
                    Stay updated with the latest activities
</p>
</div>
<a href="marks-read.php" class="mark" onclick="markAllRead()"><i class="fa-solid fa-check-double"></i>

    Marks All As Read
</a>

    </div>
<div class="ngrid">
<div class="ncard">
 <div class="si blue">
                    <i class="fa-solid fa-bell"></i>
                </div>
<div>
    <h3><?= $notifications->num_rows ?></h3>
     <span>Total Notifications</span>

</div>

</div>
<div class="ncard">
 <div class="si orange">
                    <i class="fa-solid fa-envelope"></i>
                </div>
<div>
    <h3><?= $unreadStmt ?></h3>
     <span>Unread Notifications</span>

</div>

</div>
<div class="ncard">
 <div class="si green">
                    <i class="fa-solid fa-envelope-open"></i>
                </div>
<div>
    <h3><?= $notifications->num_rows-$unreadStmt ?></h3>
     <span>Read Notifications</span>

</div>

</div>

</div>

<div class="nsection">
<div class="nohead">

 <h2>
                    <i class="fa-solid fa-list"></i>
                      Recent Notifications
                </h2>

                <span class="uncount">
                       <?= $unreadStmt ?> Unread
                </span>

</div>

<div class="nolist">
    <?php if($notifications->num_rows>0): ?>
    <?php while($notification= $notifications->fetch_assoc()): ?>
<div class="noitem"
<?= $notification['is_read']==0 ?'unread': '' ?>>

<div class="noicon">
    <?php if($notification['is_read']==0): ?>
                                            <i class="fa-solid fa-bell"></i>

<?php else: ?>
          <i class="fa-solid fa-check"></i>
<?php endif; ?>
</div>
<div class="nocontent">

<h3> <?= htmlspecialchars($notification['title']) ?></h3>
<p><?= htmlspecialchars($notification['message']) ?></p>
 <span class="notime">
                                    <i class="fa-regular fa-clock"></i>
                                    <?= date("M d, Y • h:i A", strtotime($notification['created_at'])) ?>
                                </span>

</div>
<div class="nostatus <?= $notification['is_read'] == 0 ? 'unread' : 'read' ?>">

                                <?php if ($notification['is_read'] == 0): ?>

                                    <i class="fa-solid fa-circle"></i>
                                    Unread

                                <?php else: ?>

                                    <i class="fa-solid fa-check"></i>
                                    Read

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php else: ?>

                    <div class="empty-notification">

                        <i class="fa-regular fa-bell-slash"></i>

                        <h3>No Notifications Yet</h3>

                        <p>You don't have any notifications at the moment.</p>

                    </div>

                <?php endif; ?>


</div>


</div>

</div>

    </main>

    <script>

        function markAllRead() {

            if (confirm("Mark all notifications as read?")) {

                window.location.href = "marks-read.php";

            }

        }

    </script>

</body>
</html>