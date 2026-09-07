<?php 
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}
include "db.php";

$user_id = $_SESSION["user_id"];

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: profile.php");
    exit;
}
if(!isset($_FILES["profile"])){
    header("Location: profile.php");
    exit;
}

$file = $_FILES["profile"];

if($file["error"] !== UPLOAD_ERR_OK){
    header("Location: profile.php");
    exit;
}

$allowed_types = ["image/jpeg", "image/jpg", "image/png"];

if(!in_array($file["type"], $allowed_types)){
    die("Only JPG and PNG images are allowed.");
}

if($file["size"]> 2* 1024 *1024){
    die("Image must be less than 2MB.");
}
$upload_dir ="uploads/profile/";

if(!is_dir($upload_dir)){
    mkdir($upload_dir, 0777, true);
}

$extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

$new_name = "user_" .$user_id . "_" .time() . "." . $extension;

$destination =$upload_dir . $new_name;
if(move_uploaded_file($file["tmp_name"], $destination)){ 
    
//$file["tmp_name"] is a special value automatically created by PHP.
$stmt = $conn->prepare("SELECT profile FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$old = $stmt->get_result()->fetch_assoc();

$stmt = $conn->prepare("UPDATE users SET profile=? WHERE id=?");
$stmt->bind_param("si", $destination, $user_id);
$stmt->execute();

if(!empty($old["profile"])){
    if(file_exists($old["profile"])){
        unlink($old["profile"]);
    }
}

}
header("Location: profile.php");
exit;

?>





<!-- 
//Steps of move_uploaded_file
The user selects an image
The user chooses a profile picture from their computer or phone.
PHP receives the image
PHP receives the uploaded image through the form.
PHP creates a temporary file
PHP does not immediately save the image in your project folder. First, it stores the image in a temporary location.
tmp_name stores the temporary location
The tmp_name value tells PHP exactly where the temporary uploaded file is located.
The destination is created
Your program decides where the image should finally be saved, such as the uploads/profile folder.
A new filename is created
Your program can give the image a new name, such as a user ID and timestamp. This helps prevent filename conflicts.
The image is moved
move_uploaded_file takes the image from PHP’s temporary location and moves it to the final destination.
PHP checks whether the move was successful
If the image was moved successfully, the next steps run. If it failed, the code inside the condition does not run.
The database is updated
The final image location is saved in the user’s database record.
The old image is deleted
If the user already had an old profile image, the old file can be deleted to avoid unnecessary files.
The user returns to the profile page
After the upload is complete, the user is redirected to the profile page. -->