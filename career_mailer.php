<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data to prevent XSS attacks
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    $position = htmlspecialchars($_POST['position']);
    $experience = htmlspecialchars($_POST['experience']);
    $years = htmlspecialchars($_POST['years']);
    
    // Default to 0 if $years is empty or not set
    $years = empty($years) ? "None" : $years;


    // PHPMailer configuration
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'yaswanthptj1@gmail.com'; // Your Gmail address
        $mail->Password = 'fauwtrbxujowekoy'; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender info
        $mail->setFrom('yaswanthptj1@gmail.com');
        
        // Recipient
        $mail->addAddress('hemanthsai2019@gmail.com', 'Dealer');
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Career Form Submission';
        $mail->Body = "
            <h3>Career form Submission:</h3>
            <p><strong>Name:</strong> $fullName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong> $message</p>
            <p><strong>Position:</strong> $position</p>
            <p><strong>Experience:</strong> $experience</p>
            <p><strong>Years of Experience:</strong> $years</p>
        ";

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
