<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    <div class="navbar">
<div class="nav-container">

<a href="index.html" class="logonav" >
    <div class="logo">
      <i class="fa-solid fa-school"></i>
    </div>
    <div class="sname">
        <div class="stitle">
            ManageSchool
        </div>
        <div class="subtitle">
            School Management System
        </div>
    </div>

</a>

 <ul class="home" id="homenav">

    <li>
        <a href="Departments.php" class="active"><i class="fa-solid fa-building"></i><span>Departments</span></a>
    </li>
    <li>
        <a href="TeachersDepartment.php"><i class="fa-solid fa-sitemap"></i><span>Teachers Department</span></a>
    </li>
    <li>
        <a href="Teachers.php"><i class="fa-solid fa-chalkboard-user"></i><span>Teachers</span></a>
    </li>
     <li>
        <a href="Subjects.php"><i class="fa-solid fa-book"></i><span>Subjects</span></a>
    </li>
      <li>
        <a href="Students.php"><i class="fa-solid fa-user-graduate"></i><span>Students</span></a>
    </li>
    
 </ul>

</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const homenav = document.getElementById('homenav');
    const navLinks = homenav.querySelectorAll('a');

    // Highlight active link based on current page URL
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    navLinks.forEach(function (link) {
        const linkPage = link.getAttribute('href').split('/').pop();
        if (linkPage === currentPage) {
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });
});
</script>

</body>
</html>