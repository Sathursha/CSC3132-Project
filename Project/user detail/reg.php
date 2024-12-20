<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "mariadb";  
    $username = " mariadb";         
    $password = "mariadb";             
    $database = "learning_platform";  
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize form inputs to prevent XSS and other potential issues
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $education_qualification = mysqli_real_escape_string($conn, trim($_POST['education_qualification']));

    // Validate phone number format (assuming 10-digit format)
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo "<p>Invalid phone number format. Please enter a 10-digit phone number.</p>";
        exit;
    }

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email format.</p>";
        exit;
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, education_qualification) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $education_qualification);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<p>User registered successfully!</p>";

        
        
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="register page design.css">
</head>
<body>
    <h1>User Registration Form</h1>
    <form action="reg.php" method="post">
        <label for="name">Full Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email Address:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label><br>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required><br><br>

        <label for="education">Education Qualification:</label><br>
        <input type="text" id="education" name="education_qualification" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>



