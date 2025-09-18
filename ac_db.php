<?php
include('apm/config.php');


if (!isset($_SESSION['visa_insert_done']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
   
    $date = date("dmy");
    $invoiceNumber = rand(100, 999);
    $invoice = "MV"."$date$invoiceNumber"."AL";
    $citzen_of = $_POST['Citzen_Of'];  //1
    $travel_for = $_POST['travel_for'];  //2
    $service_type = $_POST['Service_type'];  //3
    $Request_type = $_POST['Request_type']; // 4
    $visitor_count = $_POST['visitor_count']; //5
    $user_email = $_POST['user_email'];  //6
    $full_name = $_POST['full_name'];  //7
    $Passport = $_POST['Passport'];  //8    
    $phone_number = $_POST['phone_number']; // 9
    $checkboxv = $_POST['checkboxv']; // 10
    

    // Insert into visa_account table
    mysqli_query($conn, "INSERT INTO `visa_account`(`invoice`, `Citzen_Of`, `travel_for`, `Service_type`,`Request_type`, `visitor_count`,`user_email`,`full_name`,`Passport`, `phone_number`,`checkboxv`, `v_datetime`) 
                         VALUES ('$invoice','$citzen_of','$travel_for','$service_type','$Request_type','$visitor_count','$user_email','$full_name','$Passport','$phone_number','$checkboxv','$datetime')")
                         or die(mysqli_error($conn));

    // Get the last inserted ID for the visa_account
    $visa_account_id = mysqli_insert_id($conn);


    $chinvoice = mysqli_query($conn, "SELECT o_invoice FROM v_order_list WHERE  o_invoice='$invoice' LIMIT 1");
    if (mysqli_num_rows($chinvoice) > 0 ) {
      //  echo 'is duplicate';
      header("Location: index.php?error=true");

    } else {
     
 

 // Check if the invoice already exists in the visa_order_list
$check_invoice_query = "SELECT COUNT(*) FROM `v_order_list` WHERE `o_invoice` = '$invoice'";
$result = mysqli_query($conn, $check_invoice_query);
$row = mysqli_fetch_array($result);

// If the invoice does not exist, proceed to insert into visa_order_list
if ($row[0] == 0) {
    // Loop to insert multiple rows into visa_order_list based on visitor_count
    for ($i = 1; $i <= $visitor_count; $i++) {
        // Generate random data for each visitor
        $o_fname = "Visitor " . $i;
        $o_amount = rand(100, 500);  // Example amount for each visitor
        $o_datetime = $datetime;

        // If it's the first row, insert the passport number; otherwise, leave it empty (NULL)
        if ($i == 1) {
            $full_name_value = $full_name;  // Use actual passport number for the first row
        } else {
            $full_name_value = '';  // Empty value for other rows (or you can use NULL depending on the DB schema)
        }


        if ($i == 1) {
            $passport_value = $Passport;  // Use actual passport number for the first row
        } else {
            $passport_value = '';  // Empty value for other rows (or you can use NULL depending on the DB schema)
        }

        // Insert data into visa_order_list table
        mysqli_query($conn, "INSERT INTO `v_order_list`(`o_vacid`, `o_invoice`, `o_fname`, `passport_number`, `created_at`) 
                             VALUES ('$visa_account_id', '$invoice', '$full_name_value', '$passport_value', '$o_datetime')")
                             or die(mysqli_error($conn));
    }
} else {
   
}


    header("Location: submit_1.php?invoice=$invoice");
    exit();

}
    
    
}
?>
