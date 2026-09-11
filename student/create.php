<?php
session_start();


include "../db.php";
$message="";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name= trim($_POST["name"]);
    $email=trim($_POST["email"]);
    $phone= trim($_POST["phone"]);
    $password= $_POST["password"];
    $status= $_POST["status"];
    $conpass = $_POST["conpass"];

    if($name=="" || $email=="" || $password == ""){
        $message="Name, email and password are required";
    }
     elseif($password !== $conpass){
        $message="Confirm password must password";
     }

     
    else{
        $stmtcheck=$conn->prepare("SELECT id FROM users WHERE email=? ");
        $stmtcheck->bind_param("s", $email);
        $stmtcheck->execute();

        $check=$stmtcheck->get_result();

        if($check->num_rows>0){
            $message="Email is already registered.";
        }
        else{
$hashpassword=password_hash($password, PASSWORD_DEFAULT);

            $stmt=$conn->prepare("INSERT INTO users (name, email, phone, password,role, status) VALUES(?, ?, ?, ?, 'student', ?)");
            $stmt->bind_param("sssss", $name, $email, $phone,$hashpassword, $status);
            if($stmt->execute()){
                header("Location: student.php");
                exit;
            }
            else{
                $message="Failed to create Student.";
            }
        }

    }

}
include "../dashnav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <style>
  
.edit-student{
    margin-left:300px;
    padding: 95px 45px 45px;
    min-height: 100vh;
    transition: 0.3s ease;
}

body.sidebar-collapsed .edit-student {
    margin-left: 120px;
}

.edithead {
    margin-bottom: 28px;
}

.edithead h1 {
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    color: #183b56;
    letter-spacing: -0.5px;
}

.edithead p {
    margin: 8px 0 0;
    font-size: 14px;
    color: #7b8794;
}

.edit-card {
    max-width: 760px;
    background: #ffffff;
    padding: 32px;
    border: 1px solid #eef2f7;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(15, 23, 42, 0.04);
}



.fg {
 margin-bottom: 22px;
}

.fg label {
  display: block;
 margin-bottom: 9px;
 font-size: 14px;
  font-weight: 600;
    color: #334e68;
}

.fg input,
.fg select {
width: 100%;
 height: 46px;
    box-sizing: border-box;

    padding: 0 14px;
border: 1px solid #dbe4ec;
    border-radius: 8px;
    outline: none;
    background: #ffffff;
    color: #334e68;
    font-size: 14px;
    font-family: inherit;
    transition: 0.25s ease;
}

.fg input::placeholder {
    color: #a0aec0;
}


.fg input:focus,
.fg select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
}


.fg select {
    cursor: pointer;
    appearance: auto;
}

.actions {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 30px;
    padding-top: 24px;
    border-top: 1px solid #eef2f7;
}

.btn1 {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: 0.25s ease;
}

.bu {
    background: #2563eb;
    color: #ffffff;
}

.bu:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(37, 99, 235, 0.18);
}


.bc {
    background: #f1f5f9;
    color: #475569;
}

.bc:hover {
    background: #e2e8f0;
    color: #334155;
}


.error {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
    padding: 13px 15px;
    border: 1px solid #fecaca;
    border-radius: 8px;
    background: #fef2f2;
    color: #b91c1c;
    font-size: 14px;
}



@media (max-width: 1024px) {

    .edit-student {
        margin-left: 220px;
        padding: 90px 30px 35px;
    }

    body.sidebar-collapsed .edit-student {
        margin-left: 80px;
    }

    .edit-card {
        max-width: 100%;
    }

}

@media (max-width: 768px) {

    .edit-student,
    body.sidebar-collapsed .edit-student {
        margin-left: 0;
        padding: 85px 20px 30px;
    }

    .edithead h1 {
        font-size: 25px;
    }

    .edit-card {
        padding: 24px;
        border-radius: 12px;
    }

    .actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn {
        width: 100%;
    }

}

@media (max-width: 480px) {

    .edit-student {
        padding: 80px 15px 25px;
    }

    .edit-card {
        padding: 20px;
    }

    .edithead h1 {
        font-size: 23px;
    }

}


    </style>
</head>

<body>

<div class="edit-student">

    <div class="edithead">
        <h1>Create Student</h1>
        <p>Create student information</p>
    </div>

    <div class="edit-card">

        <?php if($message !==""): ?>
       <div class="error">
        <?= htmlspecialchars($message) ?>
       </div>
       <?php endif; ?>


        <form method="POST">

            <div class="fg">
                <label for="name">Student Name</label>
                <input type="text" name="name"  required>
            </div>

            
           <div class="fg">
            <label for="email">Email Address</label>
            <input type="text" name="email"  required>
           </div>

            
           <div class="fg">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone"  required>
           </div>
           <div class="fg">
            <label for="password">Password</label>
            <input type="password" name="password" required>
           </div>
           <div class="fg">
            <label for="conpass">Confirm Password</label>
            <input type="password" name="conpass" required>
           </div>

           <div class="fg">
            <label for="status">Student Status</label>
            <select id="status" name="status">
                <option value="pending" <?= ($_POST["status"]?? "pending") === "pending" ? "selected" : "" ?>>Pending</option>
                <option value="approved" <?= ($_POST["status"]?? "") === "approved" ? "selected" : "" ?>>Approved</option>
                <option value="rejected" <?= ($_POST["status"]?? "") === "rejected" ? "selected" : "" ?>>Rejected</option>
            </select>
           </div>
            
            <div class="actions">
                <button type="submit" class="btn1 bu">
                    Update Student
                </button>

                <a href="student.php" class="btn1 bc">
                    Cancel
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>