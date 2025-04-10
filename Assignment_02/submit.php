<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "job_portal_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $job_role = $_POST['job_role'] ?? '';
    $salary = $_POST['salary'] ?? '';
    $degree = $_POST['degree'] ?? '';
    $university = $_POST['university'] ?? '';
    $graduation = $_POST['graduation'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $pincode = $_POST['pincode'] ?? '';
    $linkedin = $_POST['link'] ?? '';
    $hobbies = $_POST['hobbies'] ?? '';

    // Handle file uploads
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $cv_path = "";
    if (!empty($_FILES['upload']['name'])) {
        $cv_path = $upload_dir . basename($_FILES["upload"]["name"]);
        move_uploaded_file($_FILES["upload"]["tmp_name"], $cv_path);
    }

    $certification_path = "";
    if (!empty($_FILES['certification']['name'])) {
        $certification_path = $upload_dir . basename($_FILES["certification"]["name"]);
        move_uploaded_file($_FILES["certification"]["tmp_name"], $certification_path);
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, phone, dob, gender, email, job_role, salary, degree, university, graduation, address, city, pincode, linkedin, hobbies, cv_path, certification_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssssss", $first_name, $last_name, $phone, $dob, $gender, $email, $job_role, $salary, $degree, $university, $graduation, $address, $city, $pincode, $linkedin, $hobbies, $cv_path, $certification_path);

    if ($stmt->execute()) {
        echo "<h2>Form Submitted Successfully</h2>";
        echo "<p>Name: $first_name $last_name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Phone: $phone</p>";
        echo "<p>Gender: $gender</p>";
        echo "<p>Job Role: $job_role</p>";
        echo "<p>Expected Salary: $salary</p>";
        echo "<p>LinkedIn: <a href='$linkedin'>$linkedin</a></p>";
        if ($cv_path) echo "<p>CV Uploaded: <a href='$cv_path'>Download CV</a></p>";
        if ($certification_path) echo "<p>Certification Uploaded: <a href='$certification_path'>Download Certificate</a></p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
