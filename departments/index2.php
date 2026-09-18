<?php
include("../db.php");

$error_msg = "";

if (isset($_GET['delete_id'])) {
    $id = (int) $_GET['delete_id'];

    if ($id <= 0) {
        $error_msg = "Invalid department ID.";
    } else {
        mysqli_begin_transaction($conn);

        try {
            $stmt = mysqli_prepare($conn, "DELETE FROM teachersdepartments WHERE department_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (!mysqli_stmt_execute($stmt)) throw new Exception("Failed to remove teacher assignments.");
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($conn, "DELETE FROM departments WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            if (!mysqli_stmt_execute($stmt)) throw new Exception("Failed to delete department.");
            mysqli_stmt_close($stmt);

            mysqli_commit($conn);
            header("Location: index.php?status=deleted");
            exit;
        } catch (Exception $e) {
            mysqli_rollback($conn);
            $error_msg = $e->getMessage();
        }
    }
}

include("../dashnav.php");

$departments = [];
$result = mysqli_query($conn, "SELECT id,name,created_at FROM departments ORDER BY id ASC");

while ($result && $row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}

$total = count($departments);
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Departments</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="../dashnav.css">

<style>
.department-page {
    margin-left:250px;
    padding:100px 45px 45px;
    transition:.3s ease;
}

body.sidebar-collapsed .department-page {
    margin-left:80px;
}

.page-header,
.department-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-header h1,
.department-header h1 {
    margin:0;
    color:#183b56;
    font-size:28px;
}

.page-header p,
.department-header p {
    margin-top:8px;
    color:#7b8794;
    font-size:14px;
}

.dcards {
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
    margin-bottom:25px;
}

.dcard {
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:15px;
    padding:20px;
    display:flex;
    align-items:center;
    gap:15px;
    transition:.3s;
}

.dcard:hover {
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(15,23,42,.08);
}

.dicon {
    width:52px;
    height:52px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    border-radius:12px;
    font-size:20px;
    text-decoration:none;
    flex-shrink:0;
}

.dcard h3 {
    font-size:14px;
    color:#64748b;
    margin:3px 0 0;
}

.dcard strong {
    display:block;
    font-size:25px;
    color:#1e293b;
}

.header-buttons {
    display:flex;
    gap:10px;
}

.add-btn {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:11px 18px;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    text-decoration:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    transition:.3s;
}

.add-btn:hover {
    transform:translateY(-2px);
    color:#fff;
}

.department-table-box {
    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.04);
}

.department-table-box h2 {
    margin:0 0 20px;
    color:#183b56;
    font-size:21px;
}

.department-table-wrapper {
    overflow-x:auto;
}

.department-table {
    width:100%;
    min-width:650px;
    border-collapse:collapse;
}

.department-table th {
    text-align:left;
    padding:14px 12px;
    background:#f8fafc;
    color:#64748b;
    font-size:13px;
}

.department-table td {
    padding:16px 12px;
    border-bottom:1px solid #eef2f6;
    color:#475569;
    font-size:14px;
}

.department-table tbody tr:hover {
    background:#f8fafc;
}

.department-name {
    display:flex;
    align-items:center;
    gap:10px;
    color:#183b56;
    font-weight:600;
}

.department-avatar {
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

.department-edit,
.department-delete {
    display:inline-block;
    padding:6px 13px;
    margin:0 3px;
    border-radius:8px;
    text-decoration:none;
    transition:.3s;
}

.department-edit {
    background:#e8f4ff;
    color:#2563eb;
}

.department-delete {
    background:#fbeaec;
    color:red;
}

.department-edit:hover {
    background:#2563eb;
    color:#fff;
}

.department-delete:hover {
    background:red;
    color:#fff;
}

.alert-box {
    padding:12px 18px;
    border-radius:8px;
    margin-bottom:20px;
    font-weight:500;
}

.alert-success {
    background:#dcfce7;
    color:#166534;
}

.alert-error {
    background:#fee2e2;
    color:#991b1b;
}

.no-data {
    text-align:center;
    padding:45px 20px !important;
    color:#7b8794;
}

.no-data i {
    display:block;
    font-size:38px;
    color:#2563eb;
    margin-bottom:15px;
}

@media(max-width:1000px) {
    .dcards {
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:768px) {
    .department-page {
        padding:18px;
    }

    .page-header,
    .department-header {
        align-items:flex-start;
        flex-direction:column;
        gap:10px;
    }

    .header-buttons {
        width:100%;
        flex-wrap:wrap;
    }
}

@media(max-width:500px) {
    .dcards {
        grid-template-columns:1fr;
    }

    .add-btn {
        width:100%;
        justify-content:center;
    }
}
</style>

</head>

<body>

<main class="department-page">
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>Welcome back, <?= htmlspecialchars(explode(" ", $_SESSION["name"])[0]) ?></p>
    </div>

    <div>
        <p><strong>Today:</strong> <?= date("F d, Y") ?></p>
    </div>
</div>

<div class="dcards">

    <?php
    $cards = [
        ["fa-building", "Total Departments"],
        ["fa-layer-group", "Active Departments"],
        ["fa-building-columns", "Available Departments"]
    ];

    foreach ($cards as $card):
    ?>
        <div class="dcard">
            <div class="dicon">
                <i class="fa-solid <?= $card[0] ?>"></i>
            </div>
            <div>
                <strong><?= $total ?></strong>
                <h3><?= $card[1] ?></h3>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="dcard">
        <a href="create.php" class="dicon">
            <i class="fa-solid fa-plus"></i>
        </a>
        <div>
            <strong>+</strong>
            <h3>Create Department</h3>
        </div>
    </div>

</div>

<div class="department-header">
    <div>
        <h1>Departments</h1>
        <p>Manage academic departments</p>
    </div>

    <div class="header-buttons">
        <a href="../departmenteacher/index.php" class="add-btn">
            <i class="fa-solid fa-user-plus"></i>
            teachers departments
        </a>

        <a href="create.php" class="add-btn">
            <i class="fa-solid fa-plus"></i>
            Add Department
        </a>
    </div>
</div>

<?php if (isset($_GET['status'])): ?>

    <?php
    $messages = [
        "created" => "Department added successfully.",
        "updated" => "Department updated successfully.",
        "deleted" => "Department deleted successfully."
    ];
    ?>

    <?php if (isset($messages[$_GET['status']])): ?>
        <div class="alert-box alert-success">
            <i class="fa-solid fa-circle-check"></i>
            <?= $messages[$_GET['status']] ?>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php if ($error_msg): ?>
    <div class="alert-box alert-error">
        <i class="fa-solid fa-circle-exclamation"></i>
        <?= htmlspecialchars($error_msg) ?>
    </div>
<?php endif; ?>

<div class="department-table-box">

    <h2>Registered Departments</h2>

    <?php if ($total): ?>

        <div class="department-table-wrapper">

            <table class="department-table">

                <thead>
                    <tr>
                        <th>S.NO.</th>
                        <th>Department Name</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($departments as $i => $department): ?>

                    <tr>

                        <td><?= $i + 1 ?></td>

                        <td>
                            <div class="department-name">

                                <div class="department-avatar">
                                    <?= strtoupper(substr($department["name"], 0, 1)) ?>
                                </div>

                                <?= htmlspecialchars($department["name"]) ?>

                            </div>
                        </td>

                        <td>
                            <?= date("d M Y", strtotime($department["created_at"])) ?>
                        </td>

                        <td>

                            <a href="edit.php?id=<?= $department['id'] ?>"
                               class="department-edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit
                            </a>

                            <a href="index.php?delete_id=<?= $department['id'] ?>"
                               class="department-delete"
                               onclick="return confirm('Are you sure you want to delete this department? All teacher assignments for this department will also be removed.')">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else: ?>

        <div class="no-data">
            <i class="fa-solid fa-folder-open"></i>
            <h3>No Departments Found</h3>
            <p>No departments are available.</p>
        </div>

    <?php endif; ?>

</div>
</main>

</body>
</html>
