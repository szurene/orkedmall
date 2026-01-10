<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer
// OR if manual installation:
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';
// require 'path/to/PHPMailer/src/Exception.php';

function sendRegistrationEmail($to, $firstname, $lastname, $memberID, $startDate, $endDate, $durationMonths) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'safiahamzai@gmail.com'; // Your email
        $mail->Password   = 'jxoe gekr daxp irre';    // App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Alternative: For local XAMPP testing
        // $mail->isSMTP();
        // $mail->Host = 'localhost';
        // $mail->SMTPAuth = false;
        // $mail->Port = 25;
        
        // Recipients
        $mail->setFrom('no-reply@orkedmall.com', 'Orked Mall');
        $mail->addAddress($to, $firstname . ' ' . $lastname);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Registration Successful - Orked Mall Membership';
        
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9f9f9; }
                .footer { background: #333; color: white; padding: 10px; text-align: center; font-size: 12px; }
                .details { background: white; padding: 15px; border-radius: 5px; margin: 15px 0; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Welcome to Orked Mall!</h1>
                </div>
                <div class='content'>
                    <p>Dear $firstname $lastname,</p>
                    <p>Your membership registration has been successfully processed.</p>
                    
                    <div class='details'>
                        <h3>Membership Details:</h3>
                        <ul>
                            <li><strong>Member ID:</strong> $memberID</li>
                            <li><strong>Start Date:</strong> $startDate</li>
                            <li><strong>End Date:</strong> $endDate</li>
                            <li><strong>Duration:</strong> $durationMonths months</li>
                        </ul>
                    </div>
                    
                    <p>You can login to your account using the email you registered with.</p>
                    <p>Now, you can view all the lists of avilable discounts and promotions by categories.</p>
                    
                    <p>Thank you for joining us!</p>
                </div>
                <div class='footer'>
                    <p>This is an automated email. Please do not reply.</p>
                    <p>&copy; " . date('Y') . " Orked Mall. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        // Plain text version for non-HTML clients
        $mail->AltBody = "Dear $firstname $lastname,\n\nYour membership registration has been successfully processed.\n\nMember ID: $memberID\nStart Date: $startDate\nEnd Date: $endDate\nDuration: $durationMonths months\n\nPlease proceed with payment to activate your membership.\n\nThank you for joining Orked Mall!";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}
?>