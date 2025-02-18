<?php
session_start();
require '../../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

try {
    // Fetch all applications
    $applications = R::findAll('application', 'ORDER BY date DESC');
    
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="applications_' . date('Y-m-d') . '.csv"');
    
    // Create output stream
    $output = fopen('php://output', 'w');
    
    // Add UTF-8 BOM for proper Excel encoding
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Write headers
    fputcsv($output, [
        'S/N',
        'First Name',
        'Last Name',
        'Other Names',
        'Email',
        'Phone',
        'Gender',
        'Country',
        'State',
        'Address',
        'Date of Birth',
        'Status',
        'Application Date'
    ]);
    
    // Write data rows
    $sn = 1;
    foreach ($applications as $application) {
        $status = $application->status ? 'Confirmed' : 'Pending';
        
        fputcsv($output, [
            $sn++,
            $application->first_name,
            $application->last_name,
            $application->other_names,
            $application->email,
            $application->phone,
            $application->gender,
            $application->country,
            $application->state,
            $application->address,
            $application->date_of_birth,
            $status,
            $application->date
        ]);
    }
    
    fclose($output);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    exit('Error generating CSV: ' . $e->getMessage());
} 