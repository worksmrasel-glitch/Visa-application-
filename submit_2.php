<?php
include('apm/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include Composer's autoloader or PHPMailer files
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitorId = $_POST['visitorId'];
    $visitorName = $_POST['visitorName'];
    $visitorStatus = $_POST['visitorStatus'];
    $visitorInvoice = $_POST['visitorInvoice'];

    // Handle file uploads
    $uploadDirectory = 'apm/uploads/pdf/';
    $pdfFile = '';
    $imageFile = '';

    // Upload PDF
    if (isset($_FILES['visitorPdf']) && $_FILES['visitorPdf']['error'] === UPLOAD_ERR_OK) {
        $pdfFile = $uploadDirectory . basename($_FILES['visitorPdf']['name']);
        move_uploaded_file($_FILES['visitorPdf']['tmp_name'], $pdfFile);
    }

    // Upload Image
    if (isset($_FILES['visitorImage']) && $_FILES['visitorImage']['error'] === UPLOAD_ERR_OK) {
        $imageFile = $uploadDirectory . basename($_FILES['visitorImage']['name']);
        move_uploaded_file($_FILES['visitorImage']['tmp_name'], $imageFile);
    }

    // Update the visitor information in the database
    $query = "UPDATE visa_order_list 
              SET o_fname = '$visitorName', status = '$visitorStatus', o_invoice = '$visitorInvoice', pdf_file = '$pdfFile', image_file = '$imageFile' 
              WHERE void = '$visitorId'";

if (mysqli_query($conn, $query)) {
    // If database update is successful, send an email
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jamruljp@gmail.com'; // Gmail username
        $mail->Password = 'eltr ikzr vemf xobg'; // Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('jamruljp@gmail.com', 'Gseba Visa Takers');
        $mail->addAddress('jamrulislamjp@gmail.com', 'Jamrul Islam');
        $mail->addAddress('visatakers@gmail.com', 'Second Recipient');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Visitor Information Updated';
        $mail->Body = '
            <html>
            <body>
                <h1>Visitor Information Updated</h1>
                <p><strong>Name:</strong> ' . $visitorName . '</p>
                <p><strong>Status:</strong> ' . $visitorStatus . '</p>
                <p><strong>Invoice:</strong> ' . $visitorInvoice . '</p>
                <p>PDF File: <a href="https://yourwebsite.com/' . $pdfFile . '">Download PDF</a></p>
                <p>Image: <img src="https://yourwebsite.com/' . $imageFile . '" alt="Visitor Image" style="max-width: 150px;"></p>
            </body>
            </html>
        ';
        $mail->AltBody = 'Visitor Information Updated: Name: ' . $visitorName . ', Status: ' . $visitorStatus . ', Invoice: ' . $visitorInvoice;

        // Send the email
        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Data updated and email sent successfully.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Data updated but email sending failed: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
}
} else {
echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}


?>
