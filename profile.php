    <?php

    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
  

    include "db.php";

    $user_id = $_SESSION["user_id"];

    /* Get user information */
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        die("User not found.");
    }

    /* User information */
    $name = $user["name"] ?? "";
    $email = $user["email"] ?? "";
    $phone = $user["phone"] ?? "";
    $role = $user["role"] ?? "";
    $profile = $user["profile"] ?? "";

    /* First name */
    $first_name = explode(" ", trim($name))[0];

    /* Role display */
    if ($role === "admin") {
        $role_display = "Administrator";
    } elseif ($role === "teacher") {
        $role_display = "Teacher";
    } elseif ($role === "student") {
        $role_display = "Student";
    } else {
        $role_display = ucfirst($role);
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport"
            content="width=device-width, initial-scale=1.0">

        <title>My Profile</title>

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

        <link rel="stylesheet" href="profile.css">
    
    </head>

    <body>

    <div class="profile-page">

        <!-- Header -->

        <div class="profile-header">

            <div>
                <h1>My Profile</h1>

                <p>
                    Manage your personal information and account settings
                </p>
            </div>

            <a href="dashboard1.php" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Dashboard
            </a>

        </div>


        <!-- Profile Card -->

        <div class="profile-container">

            <!-- Left Profile Card -->

            <div class="profile-card">

                <div class="profile-cover"></div>

                <div class="profile-photo-section">

                    <div class="profile-photo">

                       <?php if(!empty($profile)): ?>

<img src="<?= htmlspecialchars($profile) ?>" alt="Profile">
                        <?php else: ?>

                            <i class="fa-solid fa-user"></i>
                        <?php endif; ?>

                    </div>

                    <!-- Upload -->

                    <label for="profileImage"
                        class="upload-btn"  
                        title="Change profile photo">
                         <!-- // for="profileImage" It matches: id="profileImage" here for=profileImage is important because it links the label to the hidden file input, allowing users to click the label to trigger the file selection dialog. -->
       

                        <i class="fa-solid fa-camera"></i>

                    </label>

                </div>


                <h2>
                    <?= htmlspecialchars($name) ?>
                </h2>

                <span class="role-badge">

                    <?php if ($role === "admin"): ?>

                        <i class="fa-solid fa-shield-halved"></i>

                    <?php elseif ($role === "teacher"): ?>

                        <i class="fa-solid fa-chalkboard-user"></i>

                    <?php else: ?>

                        <i class="fa-solid fa-user-graduate"></i>

                    <?php endif; ?>

                    <?= htmlspecialchars($role_display) ?>

                </span>


                <div class="profile-divider"></div>


                <div class="account-status">

                    <span class="status-dot"></span>

                    <div>
                        <strong>Account Active</strong>
                        <small>Your account is currently active</small>
                    </div>

                </div>

            </div>


            <!-- Right Information -->

            <div class="information-card">

                <div class="card-title">

                    <div>
                        <h2>Personal Information</h2>

                        <p>
                            Your account information
                        </p>
                    </div>

                    <a href="edit-profile.php"
                    class="edit-btn">

                        <i class="fa-solid fa-pen"></i>
                        Edit Profile

                    </a>

                </div>


                <div class="information-grid">

                    <!-- Full Name -->

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <span>Full Name</span>

                            <strong>
                                <?= htmlspecialchars($name) ?>
                            </strong>
                        </div>

                    </div>


                    <!-- Email -->

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div>
                            <span>Email Address</span>

                            <strong>
                                <?= htmlspecialchars($email) ?>
                            </strong>
                        </div>

                    </div>


                    <!-- Phone -->

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div>
                            <span>Phone Number</span>

                            <strong>
                                <?= !empty($phone)
                                    ? htmlspecialchars($phone)
                                    : "Not added" ?>
                            </strong>
                        </div>

                    </div>


                    <!-- Role -->

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="fa-solid fa-id-badge"></i>
                        </div>

                        <div>
                            <span>Account Role</span>

                            <strong>
                                <?= htmlspecialchars($role_display) ?>
                            </strong>
                        </div>

                    </div>


                    <!-- User ID -->

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="fa-solid fa-fingerprint"></i>
                        </div>

                        <div>
                            <span>User ID</span>

                            <strong>
                                #<?= htmlspecialchars($user_id) ?>
                            </strong>
                        </div>

                    </div>


                    <!-- Account -->

                    <div class="info-item">

                        <div class="info-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div>
                            <span>Account Status</span>

                            <strong class="active-text">
                                Active
                            </strong>
                        </div>

                    </div>

                </div>


                <!-- Security -->

                <div class="security-section">

                    <div class="security-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="security-info">

                        <h3>Account Security</h3>

                        <p>
                            Keep your account secure by using a strong password.
                        </p>

                    </div>

                    <a href="change-password.php"
                    class="password-btn">

                        Change Password

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- Hidden Upload Form -->

   <form action="upload-profile.php" method="post" enctype="multipart/form-data" id="uploadForm">
<input type="file" id="profileImage" name="profile" accept="image/jpg, image/jpeg, image/png" hidden>

   </form>


    <script>

    const profileImage =
        document.getElementById("profileImage");

    const uploadForm =
        document.getElementById("uploadForm");


    profileImage.addEventListener("change", function () {

        if (this.files.length > 0) {

            uploadForm.submit();

        }

    });

    </script>

    </body>
    </html>