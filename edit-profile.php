<?php

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}

include "db.php";
$user_id= $_SESSION["user_id"];
$message="";

$stmt = $conn->prepare("SELECT name, email, phone FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result= $stmt->get_result();
$user = $result->fetch_assoc();

if($_SERVER["REQUEST_METHOD"]=== "POST"){
$name = trim($_POST["name"]?? "");
$email = trim($_POST["email"]?? "");
$phone = trim($_POST["phone"]?? "");

if($name ==="" || $email=== ""){
    $message= "Name and email are required.";

}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $message = "Please enter a valid email.";
}
else{
    $stmt = $conn->prepare("UPDATE users SET name= ?, email=?, phone=? WHERE id= ?");
    $stmt->bind_param("sssi", $name, $email, $phone, $user_id);

    if($stmt->execute()){
        $_SESSION["name"]= $name; //this update the name store in session
        header("Location: profile.php");
        exit;
    }else{
        $message = "Unable to update profile.";
    }
}
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
          <link rel="stylesheet" href="profile.css">
</head>
<body>
    




<div class="profile-page">

    <div class="profile-header">

        <div>
            <h1>Edit Profile</h1>
            <p>Update your personal information</p>
        </div>

        <a href="profile.php" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Profile
        </a>

    </div>
    <div class="information-card">
        <?php if ($message): ?>
        <div class="message">
            <?=  htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>

        <form method="post">
            <div class="edit-form">
                <label>Full Name </label>
                <input type="text" name="name" value="<?= htmlspecialchars($user["name"]?? "") ?>" required>

                <label>Email Address</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user["email"]?? "") ?>" required>
                <label>Phone Number</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user["phone"]?? "") ?>">
            <div class="form-buttons">

                    <a href="profile.php"
                       class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit"
                            class="save-btn">

                        <i class="fa-solid fa-check"></i>

                        Save Changes

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

    
</body>
</html>