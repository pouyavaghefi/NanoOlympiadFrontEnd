<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
    $contact_message = nl2br(htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    // Email message
    $message = "
        <html>
        <head>
            <title>Contact Form Submission</title>
        </head>
        <body>
            <h2>Mail Sender Info:</h2>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Message:</b></p>
            <p>{$contact_message}</p>
        </body>
        </html>";

    // Recipient email
    $to = "info@nanolympiad.org";

    // Email headers
    $headers = "From: info@example.com\r\n"; // Replace with your domain's email
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Return-Path: info@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Your message was sent successfully!";
    } else {
        echo "Error: Your message could not be sent!";
    }
} else {
    echo "Invalid request!";
}
?>
