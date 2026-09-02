
<?php

include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name  = trim($_POST["name"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $email = trim($_POST["email"] ?? "");


    // ==========================================
    // VALIDATION
    // ==========================================

    if ($name === "") {

        $message = "Teacher name is required.";

    } else {


        // ==========================================
        // GENERATE RANDOM TEACHER ID
        // ==========================================

        function generateTeacherID($conn)
        {
            $characters = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

            do {

                $randomCode = "";

                for ($i = 0; $i < 8; $i++) {

                    $randomCode .= $characters[
                        random_int(
                            0,
                            strlen($characters) - 1
                        )
                    ];
                }

                $teacher_id = "TCH-" . $randomCode;


                // Check if ID already exists

                $stmt = $conn->prepare(
                    "SELECT id
                     FROM teachers
                     WHERE teacher_id = ?
                     LIMIT 1"
                );

                $stmt->bind_param(
                    "s",
                    $teacher_id
                );

                $stmt->execute();

                $result = $stmt->get_result();

                $exists = $result->num_rows > 0;

                $stmt->close();

            } while ($exists);


            return $teacher_id;
        }


        // Generate ID
        $teacher_id = generateTeacherID($conn);


        // ==========================================
        // INSERT TEACHER
        // ==========================================

        $stmt = $conn->prepare(
            "INSERT INTO teachers
            (teacher_id, name, phone, email)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssss",
            $teacher_id,
            $name,
            $phone,
            $email
        );


        if ($stmt->execute()) {

            // DO NOT DISPLAY TEACHER ID

            $message = "Teacher added successfully.";

        } else {

            $message = "Unable to add teacher.";
        }


        $stmt->close();
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Teacher</title>

</head>

<body>


<h1>Add Teacher</h1>


<?php if ($message !== ""): ?>

    <p>
        <?php echo htmlspecialchars($message); ?>
    </p>

<?php endif; ?>


<form method="POST">

    <label for="name">
        Teacher Name
    </label>

    <br>

    <input
        type="text"
        name="name"
        id="name"
        required
    >

    <br><br>


    <label for="phone">
        Phone
    </label>

    <br>

    <input
        type="text"
        name="phone"
        id="phone"
    >

    <br><br>


    <label for="email">
        Email
    </label>

    <br>

    <input
        type="email"
        name="email"
        id="email"
    >

    <br><br>


    <button type="submit">
        Add Teacher
    </button>

</form>


</body>

</html>

