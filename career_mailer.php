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
    $years = htmlspecialchars($_POST['years']);<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    echo '<pre>';
print_r($_POST);
echo '</pre>';
    $fullName = isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : 'Not provided';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : 'Not provided';
    $phone = isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : 'Not provided';
    $message = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : 'Not provided';
    $position = isset($_POST['position']) ? htmlspecialchars($_POST['position']) : 'Not provided';
    $experience = isset($_POST['experience']) ? htmlspecialchars($_POST['experience']) : 'Not provided';
    $years = htmlspecialchars($_POST['years']);
    $years = empty($years) ? "None" : $years;

    // Handle file upload
    $resume = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $resumeTmpName = $_FILES['resume']['tmp_name'];
        $resumeName = basename($_FILES['resume']['name']);
        $resumePath = 'uploads/' . $resumeName;

        // Ensure the uploads directory exists and is writable
        if (!file_exists('uploads')) {
            mkdir('uploads', 0755, true);
        }

        if (move_uploaded_file($resumeTmpName, $resumePath)) {
            $resume = $resumePath;
        } else {
            echo 'Failed to upload resume.';
            exit;
        }
    }

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
            <p><strong>Address:</strong> $message</p>
            <p><strong>Position:</strong> $position</p>
            <p><strong>Experience:</strong> $experience</p>
            <p><strong>Years of Experience:</strong> $years</p>
        ";

        // Attach resume if uploaded
        if ($resume) {
            $mail->addAttachment($resume);
        }
        echo '<pre>';
print_r($mail);
echo '</pre>';
        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Form not submitted properly.';
}
?>

    
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
