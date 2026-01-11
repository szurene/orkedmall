<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

// Updated parameters to use $fullName
function sendRegistrationEmail($to, $fullName, $memberID, $startDate, $endDate, $durationMonths) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'safiahamzai@gmail.com'; 
        $mail->Password   = 'jxoe gekr daxp irre';    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Recipients
        $mail->setFrom('no-reply@orkedmall.com', 'Orked Mall');
        $mail->addAddress($to, $fullName); // Uses the combined full name
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Payment Received - Welcome to Orked Mall!';
        
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
                .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background: #f9f9f9; }
                .footer { background: #333; color: white; padding: 10px; text-align: center; font-size: 12px; }
                .details { background: white; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 5px solid #4CAF50; }
                .status-badge { background: #4CAF50; color: white; padding: 5px 10px; border-radius: 3px; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Welcome to Orked Mall!</h1>
                </div>
                <div class='content'>
                    <p>Dear $fullName,</p>
                    <p>Thank you! Your payment has been received and your membership is now <strong>Active</strong>.</p>
                    
                    <div class='details'>
                        <h3>Membership Summary:</h3>
                        <ul>
                            <li><strong>Member ID:</strong> $memberID</li>
                            <li><strong>Membership Period:</strong> $startDate to $endDate</li>
                            <li><strong>Duration:</strong> $durationMonths months</li>
                            <li><strong>Status:</strong> <span class='status-badge'>Paid</span></li>
                        </ul>
                    </div>
                    
                    <p>You can now log in to your dashboard to view exclusive discounts and promotions.</p>
                    <p>Thank you for choosing Orked Mall!</p>
                </div>
                <div class='footer'>
                    <p>This is an automated receipt. Please do not reply.</p>
                    <p>&copy; " . date('Y') . " Orked Mall. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        // Plain text version
        $mail->AltBody = "Dear $fullName,\n\nYour payment was successful and your membership is now active.\n\nMember ID: $memberID\nValidity: $startDate to $endDate\n\nThank you for joining Orked Mall!";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}
?>