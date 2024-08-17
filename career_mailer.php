<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Initialize variables
$resume = ''; // Make sure $resume is initialized

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Ensure data is properly decoded
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Invalid JSON data.';
        exit;
    }

    // Sanitize and assign data
    $fullName = isset($data['fullName']) ? htmlspecialchars($data['fullName']) : 'Not provided';
    $email = isset($data['email']) ? filter_var($data['email'], FILTER_SANITIZE_EMAIL) : 'Not provided';
    $phone = isset($data['phone']) ? htmlspecialchars($data['phone']) : 'Not provided';
    $message = isset($data['address']) ? htmlspecialchars($data['address']) : 'Not provided';
    $position = isset($data['position']) ? htmlspecialchars($data['position']) : 'Not provided';
    $experience = isset($data['experience']) ? htmlspecialchars($data['experience']) : 'Not provided';
    $years = isset($data['years']) ? htmlspecialchars($data['years']) : 'Not provided';
    $years = empty($years) ? "None" : $years;

    // Prepare email
    $to = $email;
    $subject = 'New Career Form Submission';
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: no-reply@yourdomain.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $body = "
        <h3>Career Form Submission:</h3>
        <p><strong>Name:</strong> $fullName</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Address:</strong> $message</p>
        <p><strong>Position:</strong> $position</p>
        <p><strong>Experience:</strong> $experience</p>
        <p><strong>Years of Experience:</strong> $years</p>
    ";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Hell Yeah its working!!!";
    } else {
        echo "Message could not be sent.";
    }
} else {
    echo 'Form not submitted properly. Method: ' . $_SERVER['REQUEST_METHOD'];
}
