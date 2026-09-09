<?php

session_start();
include "../db.php";
include "../dashnav.php";



$status =$_GET['status']?? '';
if($status=='approved' || $status=='pending'){
$stmt=$conn->prepare("SELECT id, name, teacher_id, email, phone, status, created_at FROM users WHERE role= 'teacher' AND status=? ORDER BY created_at DESC");
$stmt->bind_param("s", $status);
}else{

$stmt = $conn->prepare("SELECT id, name, teacher_id, email, phone, status, created_at FROM users WHERE role = 'teacher' ORDER BY created_at DESC");
}
$stmt->execute();
$teachers = $stmt->get_result();

$TotalTeacher = $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE role='teacher'");
$TotalTeacher->execute();
$Teacher = $TotalTeacher->get_result()->fetch_assoc()['total'];

$pendingTeacher = $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE role='teacher' AND status='pending'");
$pendingTeacher->execute();
$pteacher = $pendingTeacher->get_result()->fetch_assoc()['total'];

$stmt= $conn->prepare("SELECT COUNT(*) AS total FROM users WHERE role='teacher' AND status='approved'");
$stmt->execute();
$Ateacher = $stmt->get_result()->fetch_assoc()['total'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Students</title>

   


    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

        .student-page {
            margin-left: 250px;
            padding: 100px 45px 45px;
            transition: margin-left 0.3s ease;
        }
body.sidebar-collapsed .student-page{
    margin-left: 80px;
}

.page-header {
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 5px;
}

.page-header p {
    font-size: 14px;
    color: #64748b;
}

.scards {
        display: grid;
        grid-template-columns: repeat(4 ,1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

     .scard{
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: 0.3s ease;

 }
 .scard:hover{
    transform: translateY(-3px);
     box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
 }


.sicon{
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #2563eb, #4f46e5);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-size: 20px;
}
.scard h3 {
    font-size: 14px;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 3px;
}

.scard strong {
    display: block;
    font-size: 25px;
    color: #1e293b;
    margin-bottom: 2px;
}





        .student-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .student-page-header a{
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

        .student-page-header h1 {
            margin: 0;
            color: #183b56;
            font-size: 28px;
        }

        .student-page-header p {
            margin-top: 8px;
            color: #7b8794;
        }

        .student-table-box {
            background: #fff;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        }

        .student-table-box h2 {
            margin: 0 0 20px;
            color: #183b56;
            font-size: 21px;
        }

        .student-table-wrapper {
            overflow-x: auto;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .student-table th {
            text-align: left;
            padding: 14px 12px;
            background: #f8fafc;
            color: #64748b;
            font-size: 13px;
        }

        .student-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #eef2f6;
            color: #475569;
            font-size: 14px;
        }

        .student-name {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #183b56;
            font-weight: 600;
        }

        .student-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e8f4ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #e0f2fe;
            color: #0369a1;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
       

        .student-view{
       
    padding: 6px 13px;
    margin: 0 3px;
    border-radius: 8px;
    background: #e8f4ff;
    color: #2563eb;
    text-decoration: none;
    transition: 0.3s ease;
        }
    .student-delete{
         padding: 6px 13px;
    margin: 0 3px;
    border-radius: 8px;
background: #fbeaec;
    color: red;
    text-decoration: none;
    transition: 0.3s ease;
    }

        .student-view:hover {
            background: #2563eb;
            color: #fff;
        }
        
    .student-delete:hover{
            background: red;
            color: #fff;
        }

        .no-students {
            text-align: center;
            padding: 45px 20px;
            color: #7b8794;
        }

        .no-students i {
            font-size: 38px;
            color: #2563eb;
            margin-bottom: 15px;
        }
    .sort{
        display: flex;
        align-items: center;
        justify-content: space-between;
        
    }

    .sort form{
        font-family: inherit;
        margin: 0 0 20px;
        font-size: 22px; 
        color: #1e293b;
    }
    .sort select {
        font-family: inherit;
         padding: 10px 14px;
          border: 1px solid #d1d5db;
           border-radius: 8px;
           font-weight: 500;
            background: white; 
            
            font-size: 14px;
             cursor: pointer;
         }
        
         
        @media (max-width: 768px) {

            .student-page {
                padding: 18px;
            }

            .student-page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

        }
    </style>

</head>

<body>
        <main class="student-page">

    <div class="page-header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome back, <?= htmlspecialchars(explode(" "  ,$_SESSION["name"])[0]) ?></p>
        </div>
       
            <div class="date-box">
    <p><strong>Today:</strong> <?= date("F d, Y") ?></p>
</div>
       
    </div>
  
<div class="scards">

    <div class="scard">
        <div class="sicon">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
      
            <strong><?= $Teacher ?></strong>
              <h3>Total Teachers</h3>
        </div>
    </div>

    <div class="scard">
        <div class="sicon">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div>
        
            <strong><?= $pteacher ?></strong>
           <h3>Pending Teachers</h3>
        </div>
    </div>

    <div class="scard">
        <div class="sicon">
            <i class="fa-solid fa-user-check"></i>
        </div>
        <div>
          
            <strong><?= $Ateacher ?></strong>
              <h3>Approved Teachers</h3>
        </div>
    </div>
     <div class="scard">
        <a href="add_teachers.php" class="sicon">
            <i class="fa-solid fa-plus"></i>
</a>
        <div>
          
            <strong><?= $Ateacher ?></strong>
              <h3>Create Teacher ID</h3>
        </div>
    </div>

</div>


        <div class="student-page-header">

         <div>
                <h1>Teachers</h1>
                <p>Manage registered teachers</p>
            </div>
            <a href="create.php">
                 <i class="fa-solid fa-plus"></i>
                Create Teacher  </a>

        </div>

        <div class="student-table-box">
<div class="sort">
            <h2>Registered Teachers</h2>
            <form method="GET">
               <select name="status" onchange="this.form.submit()">
                 <!-- Yes. name="status" must match the PHP variable name inside $_GET['status']. -->
                <option value="">All Teachers</option>
                <option value="approved" <?= ($_GET['status']?? '') =='approved' ? 'selected': ''?>>Approved Teachers </option>
                    <option value="pending" <?= ($_GET['status']?? '')=='pending' ? 'selected': '' ?>> Pending Teachers </option>
               </select>
                     </form>
</div>
                    <?php if ($teachers->num_rows > 0): ?>

                <div class="student-table-wrapper">

            <table class="student-table">
                            <tr>
                                <th>S.NO.</th>
                                <th>Teacher Name</th>
                                <th>Teacher ID</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Registered Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                       

                            <?php $i = 1; ?>

                            <?php while ($teacher = $teachers->fetch_assoc()): ?>

                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>
                                     <div class="student-name">

                                <div class="student-avatar">
                                 <?= strtoupper(substr($teacher["name"], 0, 1)) ?>
                            </div>

                    <?= htmlspecialchars($teacher["name"]) ?>

                             </div>
            </td>
<td>
    <?= htmlspecialchars($teacher["teacher_id"]) ?>
</td>
            <td>
                <?= htmlspecialchars($teacher["email"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($teacher["phone"] ?? "N/A") ?>
            </td>

            <td>
                <?= date("d M Y", strtotime($teacher["created_at"])) ?>
            </td>

        <td>

            <?php if ($teacher["status"] === "approved"): ?>

                <span class="status-badge status-approved">
                    Approved
                </span>

            <?php elseif ($teacher["status"] === "rejected"): ?>

                <span class="status-badge status-rejected">
         Rejected
                </span>

             <?php else: ?>

                 <span class="status-badge status-pending">
                 Pending
                 </span>

            <?php endif; ?>

        </td>

        <td>

            <a href="edit.php?id=<?= $teacher["id"] ?>" class="student-view">
    Edit
</a>
<a href="delete.php?id=<?= $teacher["id"] ?>" onclick="return confirm('Are you sure want to delete this teacher.?')" class="student-delete">Delete</a>
         </td>

             </tr>
        <?php endwhile; ?>

            

</table>
                </div>

            <?php else: ?>

                <div class="no-students">

                    <i class="fa-solid fa-user-graduate"></i>

                    <h3>No Teachers Found</h3>

                    <p>No registered teachers are available.</p>

                </div>

            <?php endif; ?>

        </div>

            </main>


</body>
</html>