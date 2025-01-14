<?php
require_once __DIR__ . '/PHPMailer.php';
require_once __DIR__ . '/SMTP.php';
require_once __DIR__ . '/Exception.php';

require_once __DIR__  . '/../../../core/loadenv.php';



use Email\PHPMailer;
use Email\Exception;


class EmailNotifier {
    private $mailer;

    /**
     * @throws Exception
     */
    public function __construct() {
        $this->mailer = new PHPMailer(true);

        loadEnv();

        // SMTP Configuration
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';         // Your SMTP server
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username =  getenv('SMTP_USERNAME');; // Your email address
        $this->mailer->Password = getenv('SMTP_PASSWORD');         // Your email password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port =getenv('SMTP_PORT');

        // Default sender
        $this->mailer->setFrom(getenv('SMTP_FROM_EMAIL'), getenv('SMTP_FROM_NAME'));
    }

    public function sendDonationReceipt($donorEmail, $donorName, $amount)
    {
        try {
            $this->mailer->addAddress($donorEmail, $donorName);
            $this->mailer->Subject = 'Thank You for Your Donation!';
            $this->mailer->isHTML(true);
            $this->mailer->Body = "
                <h1>Thank You, {$donorName}!</h1>
                <p>Your generous donation of <strong>\${$amount}</strong> means the world to us.</p>
                <p>Thank you for supporting our mission.</p>
            ";
            $this->mailer->send();
            echo "Donation receipt sent to {$donorName} ({$donorEmail}).<br>";
        } catch (Exception $e) {
            echo "Error sending email: " . $this->mailer->ErrorInfo . "<br>";
        }
    }


//    public function sendmessage($recieverEmail ,$recieverName , $subject  , $title , $message)
//    {
//
//        try {
//            $this->mailer->addAddress($recieverEmail, $recieverName);
//            $this->mailer->Subject = $subject;
//            $this->mailer->isHTML(true);
//            $this->mailer->Body = "
//                <h1>$title </h1>
//                <p>$message</p>
//            ";
//            $this->mailer->send();
//            echo "message  sent to {$recieverName} ({$recieverEmail}).<br>";
//        } catch (Exception $e) {
//            echo "Error sending email: " . $this->mailer->ErrorInfo . "<br>";
//        }
//    }






    public function sendmessage($recieverEmail, $recieverName, $subject  , $title , $message)
    {
        $htmlContent = "
<!DOCTYPE html>
<html>
<head>
    <title>Kind Quest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background: #007bff;
            color: #fff;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h1>KindQuest</h1>
        </div>
        <div class='content'>
            <p>Dear Volunteer,</p>
            <p>$message</p>
        </div>
        <div class='footer'>
            <p>&copy; 2024 CyberTools. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
";

        try {
            $this->mailer->addAddress($recieverEmail, $recieverName);
            $this->mailer->Subject = $subject;
            $this->mailer->isHTML(true); // Enable HTML formatting
            $this->mailer->Body = $htmlContent; // Use full HTML content as email body
            $this->mailer->send();
            echo "Message sent to {$recieverName} ({$recieverEmail}).<br>";
        } catch (Exception $e) {
            echo "Error sending email: " . $this->mailer->ErrorInfo . "<br>";
        }
    }

}
