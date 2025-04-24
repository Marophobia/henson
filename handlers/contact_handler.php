<?php
session_start();
require_once 'mail.php';

if (isset($_POST['submit_contact'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "All fields are required";
        header("Location: ../contact.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: ../contact.php");
        exit;
    }

    // Send confirmation email to user
    $userSubject = "Thank you for contacting Henson Demonstration Schools";
    $userMessage = "Dear {$name},<br><br>
                   Thank you for reaching out to Henson Demonstration Schools. 
                   We have received your message and will get back to you as soon as possible.<br><br>
                   Best regards,<br>
                   Henson Demonstration Schools Team";
    
    $userMailSent = sendMail($email, $name, $userSubject, generateEmailBody($name, $userMessage));

    // Send notification to admin
    $adminSubject = "New Contact Form Submission";
    $adminMessage = "A new contact form submission has been received:<br><br>
                    Name: {$name}<br>
                    Email: {$email}<br>
                    Subject: {$subject}<br><br>
                    Message:<br>
                    {$message}";
    
    $adminMailSent = sendMail('hello@hensonschools.com', 'Admin', $adminSubject, generateEmailBody('Admin', $adminMessage));

    if ($userMailSent === true && $adminMailSent === true) {
        $_SESSION['success'] = "Thank you for your message. We will get back to you soon!";
    } else {
        $_SESSION['error'] = "There was an error sending your message. Please try again later.";
    }

    header("Location: ../contact.php");
    exit;
}
?> 