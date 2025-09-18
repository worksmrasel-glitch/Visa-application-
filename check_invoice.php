<?php
// Include the database connection
include('apm/config.php');

// Check if the invoice is set in the POST request

if (isset($_POST['invoice'])) {
    $invoice = mysqli_real_escape_string($conn, $_POST['invoice']);
    
    // Query to fetch the data from the database based on the invoice
    $query = "SELECT status, o_invoice, o_fname FROM visa_account WHERE o_invoice = '$invoice'";
    $result = mysqli_query($conn, $query);

    // Check if data is found for the given invoice
    if (mysqli_num_rows($result) > 0) {
        // Fetch the data
        $row = mysqli_fetch_assoc($result);
        
        // Return data as JSON
        echo json_encode([
            'status' => 'success',
            'data' => [
                'status' => $row['status'],       // Current status
                'o_fname' => $row['o_fname'],     // Full name
                'o_invoice' => $row['o_invoice'], // Invoice number
            ]
        ]);
    } else {
        // If no data found, return a failure response
        echo json_encode(['status' => 'error']);
    }
} else {
    // If invoice is not set, return an error
    echo json_encode(['status' => 'error']);
}
?>
