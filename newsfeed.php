<?php
include('tam_layout/header.php'); 
session_start();
$conn = mysqli_connect('localhost', 'salesbaz_visa', 'L=(wUEQVbbYa', 'salesbaz_visa');
mysqli_set_charset($conn, "utf8");

date_default_timezone_set('Asia/Dhaka');
$dateqe = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
$datetime = date("Y-m-d H:i:s", $dateqe->format('U'));

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email entered by the user
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);

    // Token generation
    $token = bin2hex(random_bytes(16));  // Generates a 32-character token

    // Insert token into the database
    $query = "INSERT INTO tokens (email, token, created_at) VALUES ('$user_email', '$token', '$datetime')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Token inserted successfully.";

        // Prepare the email content
        $subject = "Confirm Your Subscription to Visa";
        $message = "
            <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
                <div style='max-width: 600px; margin: auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);'>
                    <div style='text-align: center;'>
                        <img src='https://gseba.com/qrcode/apm/qrcms/images/logo.png' alt='QRNORWAY Logo' style='max-width: 150px; margin-bottom: 20px;'>
                    </div>
                    <h2 style='color: #333; text-align: center;'>Welcome to Gseba!</h2>
                    <p style='color: #555; font-size: 16px; line-height: 1.5; text-align: center;'>Thank you for subscribing to our newsletter. We are excited to have you on board and share the latest updates with you.</p>
                    <p style='color: #333; font-size: 16px; line-height: 1.5; text-align: center;'>
                        To complete your subscription, please click the link below to confirm your email address:
                    </p>
                    <p style='text-align: center;'>
                        <a href='https://gseba.com/reset-password.php?token=$token' style='background-color: #007bff; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Confirm Your Subscription</a>
                    </p>
                </div>
            </div>
        ";

        // Send the confirmation email to the user and other recipients
        $emails = array('gsebabd@gmail.com', $user_email, 'jamrulislamjp@gmail.com', 'emalaysiapaymentinfo@gmail.com'); // Add all email addresses here
        foreach ($emails as $email) {
            send_confirmation_email($email, $subject, $message);
        }

        // Print emails to debug
        print_r($emails);
    } else {
        echo "Error inserting token: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);

// Function to send the email via SMTP
function send_confirmation_email($to, $subject, $msg) {
    // Include PHPMailer library
    include('apm/smtp/PHPMailerAutoload.php');
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // SMTP server (Gmail in this case)
    $mail->SMTPAuth = true;
    $mail->Username = 'jamruljp@gmail.com';  // SMTP username (Gmail)
    $mail->Password = 'efab bhye eqck zdvk';  // SMTP password
    $mail->SMTPSecure = 'tls';  // Use 'tls' for TLS encryption (older versions of PHPMailer)
    $mail->Port = 587;  // SMTP Port

    $mail->setFrom('jamrulislamjp@gmail.com');  // Sender email address
    $mail->addAddress($to);  // Recipient's email address
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;  // Set email subject
    $mail->Body = $msg;  // Set email body

    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));

    // Enable SMTP debug to get detailed logs
    $mail->SMTPDebug = 2;  // Set to 2 for verbose debug output
    $mail->Debugoutput = 'html';  // Debug output in HTML format

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    } else {
        echo "Message sent successfully to: $to<br>";
        return true;
    }
}

include('tam_layout/footer.php');
