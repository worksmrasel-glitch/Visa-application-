<?php
$conn = mysqli_connect('localhost', 'salesbaz_visa', 'L=(wUEQVbbYa', 'salesbaz_visa');
mysqli_set_charset($conn, "utf8");





include('apm/smtp/PHPMailerAutoload.php');

 $to = 'gsebabd@gmail.com';          // Default email address
    $full_name = 'Customer Name';        // Default full name
    $amount = 0.00;                    // Default amount
    $currency = 'USD';                  // Default currency
    $invoice = 'INV12345';                 // Default invoice number
    
    
// Email function to send payment details
function send_payment_email($to, $full_name, $amount, $currency, $invoice) {
    $subject = "Payment Confirmation for Invoice #$invoice";

    // Prepare email content
    $html = "
    <div>
        <h2> New Payment Successful  </h2>
        <p>Dear $full_name,</p>
        <p>Your payment of <strong>$amount $currency</strong> for invoice <strong>#{$invoice}</strong> has been successfully processed.</p>
        <p>Thank you for using our services!</p>
    </div>";

    // Create PHPMailer object
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "travelnews24as@gmail.com";  // Your SMTP username
    $mail->Password = "cmgd zyfa oieg hiae";  // Your SMTP password
    $mail->SetFrom('jamrulislamjp@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $html;
    $mail->AddAddress($to);  // Send to the user

    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Payment email sent successfully.";
    }
}
?>
<script>
    // Delay the redirection by 2 seconds
    // setTimeout(function() {
    //     window.location.href = "index.php";
    // }, 2000);
</script>