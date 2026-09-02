
<?php 

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
          <link rel="stylesheet" href="dashboard.css">

</head>
<body>

    <div class="topbar">
        <div class="top-left">
            <button class="btn" id="menuBtn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="logo">
                <div class="logo-icon">
                      <i class="fa-solid fa-school"></i>
                </div>
                <span>SchoolManage</span>
            </div>
        </div>
        <div class="top-right">
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
 
            </div>
              <div class="notification">
                <i class="fa-regular fa-bell"></i>
                <span></span>
            </div>
            <div class="admin">
                 <div class="admin-avatar">
                     <i class="fa-solid fa-user"></i>
                </div>
               <div class="admin-info">
    <div class="admin-name">
          <?= htmlspecialchars(explode(" ", $_SESSION["name"])[0]) ?>
    </div>

    <div class="admin-role">
        <?php
        if ($_SESSION["role"] === "admin") {
            echo "Administrator";
        } elseif ($_SESSION["role"] === "teacher") {
            echo "Teacher";
        } elseif ($_SESSION["role"] === "student") {
            echo "Student";
        }
        ?>
    </div>
</div>
            <i class="fa-solid fa-chevron-down"></i>
        </div>
    </div>


</body>
</html>