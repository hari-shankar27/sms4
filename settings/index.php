
<?php
include("../db.php");
include("../dashnav.php");
?>

<style>
.settings-page {
    margin-left: 250px;
    min-height: 100vh;
    padding: 90px 45px 45px;
    transition: margin-left 0.3s ease;
}

body.sidebar-collapsed .settings-page {
    margin-left: 80px;
}

.settings-header {
    margin-bottom: 30px;
}

.settings-header h1 {
    margin: 0 0 8px;
    color: #0f2f57;
    font-size: 28px;
    font-weight: 700;
}

.settings-header p {
    margin: 0;
    color: #64748b;
    font-size: 15px;
}

.settings-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
    max-width: 1000px;
}

.setting-card {
    display: flex;
    align-items: center;
    gap: 18px;

    padding: 25px;

    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;

    text-decoration: none;

    box-shadow: 0 6px 20px rgba(15, 47, 87, 0.07);

    transition: 0.25s ease;
}

.setting-card:hover {
    transform: translateY(-3px);
    border-color: #2563eb;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.12);
}

.setting-icon {
    width: 55px;
    height: 55px;
    min-width: 55px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eff6ff;
    color: #2563eb;

    border-radius: 10px;
    font-size: 22px;
}

.setting-content h3 {
    margin: 0 0 7px;
    color: #0f2f57;
    font-size: 18px;
    font-weight: 700;
}

.setting-content p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.5;
}

.setting-arrow {
    margin-left: auto;
    color: #94a3b8;
    font-size: 16px;
}

.setting-card:hover .setting-arrow {
    color: #2563eb;
}

@media (max-width: 800px) {
    .settings-page {
        margin-left: 0;
        padding: 80px 25px 35px;
    }

    .settings-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 500px) {
    .settings-page {
        padding: 70px 18px 30px;
    }

    .setting-card {
        padding: 20px;
    }
}
</style>

<div class="settings-page">

    <div class="settings-header">
        <h1>Settings</h1>
        <p>Manage your school system settings and preferences.</p>
    </div>

    <div class="settings-grid">

        <a href="school-profile.php" class="setting-card">
            <div class="setting-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div class="setting-content">
                <h3>School Profile</h3>
                <p>Manage school name, logo, address and contact information.</p>
            </div>

            <div class="setting-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="academic.php" class="setting-card">
            <div class="setting-icon">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <div class="setting-content">
                <h3>Academic Settings</h3>
                <p>Manage academic year, semester and academic dates.</p>
            </div>

            <div class="setting-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="users.php" class="setting-card">
            <div class="setting-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="setting-content">
                <h3>Users & Roles</h3>
                <p>Manage system users, roles and account permissions.</p>
            </div>

            <div class="setting-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

        <a href="security.php" class="setting-card">
            <div class="setting-icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div class="setting-content">
                <h3>Security</h3>
                <p>Manage password and account security settings.</p>
            </div>

            <div class="setting-arrow">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </a>

    </div>

</div>
