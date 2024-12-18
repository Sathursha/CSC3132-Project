<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Save the data or send an email
    // For example, save to a file
    $log = fopen("messages.txt", "a");
    fwrite($log, "Name: $name\nEmail: $email\nMessage: $message\n---\n");
    fclose($log);

    echo "<p>Thank you for your message, $name. We'll get back to you soon!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Home page design.css">
</head>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>
    <form method="POST" action="contact.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>
        
        <button type="submit">Send Message</button>
    </form>
</body>
</html>
