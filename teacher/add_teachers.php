
<?php

include "../db.php";
include "../dashnav.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name  = trim($_POST["name"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($name === "") {

        $message = "Teacher name is required.";
        $messageType = "error";

    } else {

        function generateTeacherID($conn)
        {
            $characters = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

            do {

                $randomCode = "";

                for ($i = 0; $i < 8; $i++) {
                    $randomCode .= $characters[
                        random_int(0, strlen($characters) - 1)
                    ];
                }

                $teacher_id = "TCH-" . $randomCode;

                $stmt = $conn->prepare(
                    "SELECT id FROM teachers
                     WHERE teacher_id = ?
                     LIMIT 1"
                );

                $stmt->bind_param("s", $teacher_id);
                $stmt->execute();

                $result = $stmt->get_result();
                $exists = $result->num_rows > 0;

                $stmt->close();

            } while ($exists);

            return $teacher_id;
        }

        // Generate Teacher ID
        $teacher_id = generateTeacherID($conn);

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

            $message = "Teacher added successfully.";
            $messageType = "success";

        } else {

            $message = "Unable to add teacher.";
            $messageType = "error";
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

    <style>


        .add {
            margin-left: 250px;
            padding: 100px 45px 45px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
          
        }

        body.sidebar-collapsed .add {
            margin-left: 80px;
        }


        .add-header {
            margin-bottom: 25px;
        }

        .add-header h1 {
            margin: 0 0 8px;
            font-size: 28px;
            color: #1e293b;
        }

        .add-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }


        /* Form Card */

        .teacher-form-card {
            max-width: 650px;
            background: #ffffff;
            padding: 30px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }


        /* Form Group */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }


        /* Button */

        .add-teacher-btn {
            display: block;
            min-width: fit-content;

            margin:20px auto;
            text-align: center;
            padding: 13px 10px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
        
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }


        /* Message */

        .form-message {
            max-width: 650px;
            box-sizing: border-box;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-message.success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .form-message.error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }


        /* Responsive */

        @media (max-width: 768px) {

            .add {
                margin-left: 0;
                padding: 90px 20px 30px;
            }

            body.sidebar-collapsed .add {
                margin-left: 0;
            }

            .add-header h1 {
                font-size: 24px;
            }

            .teacher-form-card {
                padding: 22px;
            }

        }

    </style>

</head>

<body>

<main class="add">

    <div class="add-header">
        <h1>Add Teacher</h1>
        <p>Add a new teacher to your school management system.</p>
    </div>


    <?php if ($message !== ""): ?>

        <div class="form-message <?= $messageType ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php endif; ?>


    <div class="teacher-form-card">

        <form method="POST">

            <div class="form-group">

                <label for="name">
                    Teacher Name
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Enter teacher name"
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label for="phone">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="Enter phone number"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                >

            </div>


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter email address"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                >

            </div>


            <button type="submit" class="add-teacher-btn">
               Generate Teacher ID
            </button>

        </form>

    </div>

</main>

</body>
</html>

