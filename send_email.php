<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader (if using Composer)
require 'vendor/autoload.php';

// Alternative: If not using Composer, include files manually
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullname = htmlspecialchars($_POST['fullname']);
    $student_id = htmlspecialchars($_POST['student_id']); // NEW
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);
    $course = htmlspecialchars($_POST['course']);
    $subject = htmlspecialchars($_POST['subject']);       // NEW
    $year = htmlspecialchars($_POST['year']);
    $address = htmlspecialchars($_POST['address']);
    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                      
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'tanjil01994087654@gmail.com';   
        $mail->Password   = 'hwed lump hgkc jusi';                     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;     

        // For other email providers, use these settings:
        // Outlook/Hotmail: smtp-mail.outlook.com, Port: 587
        // Yahoo: smtp.mail.yahoo.com, Port: 587
        // Custom SMTP: contact your hosting provider

        //Recipients
        $mail->setFrom('tanjil01994087654@gmail.com', 'Student Form');
        $mail->addAddress('harashid@uttarauniversity.edu.bd');  // Email where you want to receive submissions
        $mail->addReplyTo($email, $fullname);

        // Content
        $mail->isHTML(true);
        // Now the email subject in your inbox will match the form's subject
        $mail->Subject = $student_id . " - " . $subject . " - " . $fullname;
        
        // Email body with student details
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                h2 { color: #667eea; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
                .detail-row { margin: 15px 0; padding: 10px; background: #f8f9fa; border-radius: 5px; }
                .label { font-weight: bold; color: #555; }
                .value { color: #333; margin-left: 10px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2> New Student Registration</h2>
                <div class='detail-row'>
                    <span class='label'>Full Name:</span>
                    <span class='value'>{$fullname}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Email:</span>
                    <span class='value'>{$email}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Phone:</span>
                    <span class='value'>{$phone}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Date of Birth:</span>
                    <span class='value'>{$dob}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Gender:</span>
                    <span class='value'>{$gender}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Course:</span>
                    <span class='value'>{$course}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Year of Study:</span>
                    <span class='value'>{$year}</span>
                </div>
                <div class='detail-row'>
                    <span class='label'>Address:</span>
                    <span class='value'>{$address}</span>
                </div>
            </div>
        </body>
        </html>
        ";

        // Plain text version for email clients that don't support HTML
        $mail->AltBody = "New Student Registration\n\n" .
                        "Full Name: {$fullname}\n" .
                        "Email: {$email}\n" .
                        "Phone: {$phone}\n" .
                        "Date of Birth: {$dob}\n" .
                        "Gender: {$gender}\n" .
                        "Course: {$course}\n" .
                        "Year of Study: {$year}\n" .
                        "Address: {$address}";

        $mail->send();
        
        // Redirect to form page with success message
        header("Location: index.html?status=success");
        exit();
        
    } catch (Exception $e) {
        // Redirect to form page with error message
        header("Location: index.html?status=error");
        exit();
        
        // For debugging, you can uncomment the line below:
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If someone tries to access this file directly
    header("Location: index.html");
    exit();
}
?>