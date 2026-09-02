
function validateForm() {

    let name = document.getElementById("name").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let conpass = document.getElementById("conpass").value;

    // Name validation
    if (name == "") {
        alert("Please enter your name.");
        return false;
    }

    if (name.length > 40) {
        alert("Name cannot be more than 40 characters.");
        return false;
    }

    // Phone validation (10 digits)
    let phonePattern = /^[0-9]{10}$/;

    if (!phonePattern.test(phone)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    // Email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Password validation
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    // Confirm password
    if (password !== conpass) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}

function toggleTeacherField() {
    let role = document.getElementById("role").value;
    let teacherField = document.getElementById("teacherField");
    let teacherId = document.getElementById("teacher_id");

    if (role === "teacher") {
        teacherField.style.display = "block";
        teacherId.required = true;
    } else {
        teacherField.style.display = "none";
        teacherId.required = false;
        teacherId.value = "";
    }
}
