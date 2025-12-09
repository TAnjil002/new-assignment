<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullname = htmlspecialchars($_POST['fullname']);
    $student_id = htmlspecialchars($_POST['student_id']); 
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);
    $course = htmlspecialchars($_POST['course']);
    $subject = htmlspecialchars($_POST['subject']);       
    $year = htmlspecialchars($_POST['year']);
    $address = htmlspecialchars($_POST['address']);

    // --- YOUR GITHUB LINK ---
    // I grabbed this from your index.html file
    $github_link = "https://github.com/TAnjil002/new-assignment"; 

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

        //Recipients
        $mail->setFrom('tanjil01994087654@gmail.com', 'Student Form');
        $mail->addAddress('harashid@uttarauniversity.edu.bd'); 
        $mail->addReplyTo($email, $fullname);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $student_id . " - " . $subject . " - " . $fullname;
        
        // Email Body
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
                
                /* New GitHub Button Style */
                .btn-github {
                    display: inline-block;
                    background-color: #24292e;
                    color: #ffffff !important;
                    padding: 12px 24px;
                    text-decoration: none;
                    border-radius: 6px;
                    font-weight: bold;
                    margin-top: 20px;
                }
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
                    <span class='label'>Student ID:</span>
                    <span class='value'>{$student_id}</span>
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

                <div style='text-align: center; margin-top: 30px;'>
                    <a href='{$github_link}' class='btn-github'>
                        View Project on GitHub
                    </a>
                </div>

            </div>
        </body>
        </html>
        ";

        // Plain text version
        $mail->AltBody = "New Student Registration\n\n" .
                        "Full Name: {$fullname}\n" .
                        "Student ID: {$student_id}\n" .
                        "Email: {$email}\n" .
                        "Phone: {$phone}\n" .
                        "Date of Birth: {$dob}\n" .
                        "Gender: {$gender}\n" .
                        "Course: {$course}\n" .
                        "Year of Study: {$year}\n" .
                        "Address: {$address}\n\n" .
                        "GitHub Link: {$github_link}";

        $mail->send();
        header("Location: index.html?status=success");
        exit();
        
    } catch (Exception $e) {
        header("Location: index.html?status=error");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}
?>
