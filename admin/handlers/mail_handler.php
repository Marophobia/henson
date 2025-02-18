<?php
session_start();
require '../../config/db.php';
require '../../handlers/mail.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['error'] = "You must log in first.";
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate and sanitize input
        $recipient_name = filter_var($_POST['recipient_name'], FILTER_SANITIZE_STRING);
        $recipient_email = filter_var($_POST['recipient_email'], FILTER_VALIDATE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $content = $_POST['content']; // HTML content from Quill editor

        // Basic validation
        if (empty($recipient_name) || empty($subject) || empty($content)) {
            throw new Exception("All fields are required.");
        }

        if (!$recipient_email) {
            throw new Exception("Invalid email address.");
        }

        // Generate email body using the template
        $email_body = generateEmailBody($recipient_name, $content);

        // Send the email
        $result = sendMail($recipient_email, $recipient_name, $subject, $email_body);

        if ($result === true) {
            $_SESSION['success'] = "Email sent successfully!";
        } else {
            throw new Exception("Failed to send email: " . $result);
        }

        header("Location: ../sendmail.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../sendmail.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../sendmail.php");
    exit;
} 