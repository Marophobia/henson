<?php
session_start();
require_once '../config/db.php';
require_once 'mail.php';

if (isset($_POST['submit_application'])) {
    try {
        // Validate and sanitize input
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        $other_names = filter_var($_POST['other_names'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
        $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
        $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $date_of_birth = filter_var($_POST['date_of_birth'], FILTER_SANITIZE_STRING);

        // Validate email
        if (!$email) {
            throw new Exception("Invalid email address");
        }

        // Check for duplicate email
        $existing_application = R::findOne('application', 'email = ?', [$email]);
        if ($existing_application) {
            throw new Exception("An application with this email already exists");
        }

        // Handle file upload
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Please upload a valid image");
        }

        $file = $_FILES['image'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        
        // Validate file size (500KB = 500 * 1024 bytes)
        if ($file_size > 500 * 1024) {
            throw new Exception("Image size should not exceed 500KB");
        }

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file_type, $allowed_types)) {
            throw new Exception("Only JPG and PNG images are allowed");
        }

        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $upload_path = '../assets/img/applications/' . $filename;

        // Create directory if it doesn't exist
        // if (!file_exists('../assets/img/applications/')) {
        //     mkdir('../assets/img/applications/', 0777, true);
        // }

        // Move uploaded file
        if (!move_uploaded_file($file_tmp, $upload_path)) {
            throw new Exception("Failed to upload image");
        }

        // Create new application record
        $application = R::dispense('application');
        $application->first_name = $first_name;
        $application->last_name = $last_name;
        $application->other_names = $other_names;
        $application->email = $email;
        $application->image = $filename;
        $application->phone = $phone;
        $application->country = $country;
        $application->state = $state;
        $application->gender = $gender;
        $application->address = $address;
        $application->date_of_birth = $date_of_birth;
        $application->status = 0; // Pending
        $application->date = date('Y-m-d H:i:s');

        $id = R::store($application);

        // Send email to applicant
        $applicant_message = "Dear $first_name,\n\nThank you for submitting your application to Henson Demonstration Schools. Your application has been received and is being processed. We will contact you shortly to confirm your application.\n\nBest regards,\nHenson Demonstration Schools";
        
        sendMail(
            $email,
            "$first_name $last_name",
            "Application Received - Henson Demonstration Schools",
            generateEmailBody("$first_name $last_name", $applicant_message)
        );

        // Send email to admin
        $admin_email = "admin@hensonschools.com"; // Change to actual admin email
        $admin_message = "A new application has been submitted:\n\nName: $first_name $last_name\nEmail: $email\nPhone: $phone\n\nPlease login to the admin panel to review the application.";
        
        sendMail(
            $admin_email,
            "Admin",
            "New Student Application",
            generateEmailBody("Admin", $admin_message)
        );

        $_SESSION['success'] = "Application submitted successfully! We will contact you shortly.";
        header("Location: ../enroll.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../enroll.php");
        exit;
    }
} 