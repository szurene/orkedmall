<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

// Added $amount and $paymentMethod to parameters
function sendRegistrationEmail($to, $fullName, $memberID, $startDate, $endDate, $durationMonths, $amount, $paymentMethod) {
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
        $mail->addAddress($to, $fullName);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Payment Confirmation - Orked Mall Membership';
        
        $mail->Body = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: 'Segoe UI', Arial, sans-serif; line-height: 1.6; color: #333333; margin: 0; padding: 0; }
                .wrapper { background-color: #e5dcd6; padding: 40px 10px; } 
                .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; }
                .header { background-color: #e19bb1; color: #ffffff; padding: 30px; text-align: center; } 
                .header h1 { margin: 0; font-size: 24px; letter-spacing: 2px; }
                .content { padding: 30px; background-color: #ffffff; }
                .details { 
                    background-color: #f9f9f9; 
                    padding: 20px; 
                    border-radius: 5px; 
                    margin: 20px 0; 
                    border-left: 4px solid #e19bb1; 
                }
                .details h3 { margin-top: 0; color: #e19bb1; font-size: 18px; }
                .amount-box { 
                    font-size: 20px; 
                    font-weight: bold; 
                    color: #e19bb1; 
                    margin-top: 10px;
                    border-top: 1px solid #e0e0e0;
                    padding-top: 10px;
                }
                .footer { background-color: #333333; color: #ffffff; padding: 20px; text-align: center; font-size: 12px; }
                ul { list-style: none; padding: 0; margin: 0; }
                li { margin-bottom: 8px; font-size: 14px; }
                strong { color: #333333; }
            </style>
        </head>
        <body>
            <div class='wrapper'>
                <div class='container'>
                    <div class='header'>
                        <h1>ORKED MALL</h1>
                    </div>
                    <div class='content'>
                        <p>Dear <strong>$fullName</strong>,</p>
                        <p>Your payment was successful! Thank you for joining Orked Mall. Your membership details and transaction summary are listed below.</p>
                        
                        <div class='details'>
                            <h3>Transaction & Membership</h3>
                            <ul>
                                <li><strong>Member ID:</strong> #$memberID</li>
                                <li><strong>Membership Plan:</strong> $durationMonths Months</li>
                                <li><strong>Validity:</strong> $startDate to $endDate</li>
                                <li><strong>Payment Method:</strong> $paymentMethod</li>
                            </ul>
                            <div class='amount-box'>
                                Amount Paid: RM " . number_format($amount, 2) . "
                            </div>
                        </div>
                        
                        <p>You can now log in to your account and start browse the latest promotions and category-based deals curated specifically for your membership tier.</p>
                        <p>Best regards,<br>The Orked Mall Team</p>
                    </div>
                    <div class='footer'>
                        <p>This is an automated transaction receipt. Please do not reply.</p>
                        <p>&copy; " . date('Y') . " Orked Mall. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->AltBody = "Dear $fullName, Your payment of RM " . number_format($amount, 2) . " via $paymentMethod was successful. Member ID: $memberID. Validity: $startDate to $endDate.";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}