<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer's autoloader or PHPMailer files

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                 // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                  // Set the SMTP server
    $mail->SMTPAuth = true;                          // Enable SMTP authentication
    $mail->Username = 'jamruljp@gmail.com';         //Host Gmail username
    $mail->Password = 'eltr ikzr vemf xobg';                  // Host  App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587;                               // TCP port

    // Recipients
    $mail->setFrom('jamruljp@gmail.com', 'Gseba Visa Takers'); // Sender email and name
    $mail->addAddress('jamrulislamjp@gmail.com', 'Jamrul Islam'); // First recipient
    $mail->addAddress('visatakers@gmail.com', 'Second Recipient'); // Second recipient
    //$mail->SMTPDebug = 3; // Enable verbose debug output

    // Content
    $mail->isHTML(true);                             // Email format is HTML
    $mail->Subject = 'Payment Notification';
    $mail->Body = '
        <html>
        <body>
            <h1>Hi,</h1>
            <p>Your amount is <strong>$500</strong>.</p>
            <img src="https://via.placeholder.com/150" alt="Placeholder Image" />
        </body>
        </html>
    ';
    $mail->AltBody = 'Hi, Your amount is $500.';

    // Send the email
    $mail->send();
    echo 'Message has been sent successfully.';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
