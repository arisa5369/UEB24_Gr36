<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$phpMailerPath = __DIR__ . '/lib/PHPMailer/src/';
if (!file_exists($phpMailerPath . 'PHPMailer.php') ||
    !file_exists($phpMailerPath . 'SMTP.php') ||
    !file_exists($phpMailerPath . 'Exception.php')) {
    error_log("PHPMailer files not found in $phpMailerPath");
    return false;
}

require $phpMailerPath . 'Exception.php';
require $phpMailerPath . 'PHPMailer.php';
require $phpMailerPath . 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true); 

    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'arisadragusha5@gmail.com'; 
        $mail->Password = 'kzip mbsg rdzu srzq'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port = 587; 

     
        $mail->SMTPDebug = 2; 
        $mail->Debugoutput = function($str, $level) {
            error_log("PHPMailer Debug level $level: $str");
        };

        
        $mail->setFrom('no-reply@petfinder.com', 'Petfinder');
        $mail->addAddress($to);

    
        $mail->isHTML(false); 
        $mail->Subject = $subject;
        $mail->Body = $body;

 
        $mail->send();
        error_log("Email sent successfully to $to");
        return true;
    } catch (Exception $e) {
        error_log("Email could not be sent. PHPMailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>