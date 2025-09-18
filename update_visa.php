<?php
include('apm/config.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $void = $_POST['void'];
     $rowselect = $_POST['rowselect'];
     
    $invoice = $_POST['invoice'];
     $o_fname = $_POST['o_fname'];
    $o_lname = $_POST['o_lname'];
    $passport_number = $_POST['passport_number'];
    $nationality = $_POST['nationality'];
    $gender = $_POST['gender'];
     $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
     $dob = "$year-$month-$day";

    $day2 = $_POST['day2'];
    $month2 = $_POST['month2'];
    $year2 = $_POST['year2'];
     $passport_issue_date = "$year2-$month2-$day2";
     
    $day3 = $_POST['day3'];
    $month3 = $_POST['month3'];
    $year3 = $_POST['year3'];
     $passport_expiry_date = "$year3-$month3-$day3";
     
     
    // $passport_expiry_date = $_POST['passport_expiry_date'];
    $passport_issuing_country = $_POST['passport_issuing_country'];
    $applying_from = $_POST['applying_from'];
    // $travel_date = $_POST['travel_date'];
    
    $day4 = $_POST['day4'];
    $month4 = $_POST['month4'];
    $year4 = $_POST['year4'];
    $travel_date = "$year4-$month4-$day4";
    
    $day5   =  $_POST['day5'];
    $month5 =  $_POST['month5'];
    $year5  =  $_POST['year5'];
    $exit_date = "$year5-$month5-$day5";
    
    // $exit_date = $_POST['exit_date'];
    $present_address = $_POST['present_address'];
    $Flight_ticket = $_POST['Flight_ticket'];
    

    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $status = $_POST['status'];

    // File uploads
    $uploadDir = 'apm/uploads/images/';
    $fileFields = [];
    $fileBindings = [];

    if (!empty($_FILES['photograph']['tmp_name'])) {
        $photographPath = $uploadDir . basename($_FILES['photograph']['name']);
        move_uploaded_file($_FILES['photograph']['tmp_name'], $photographPath);
        $fileFields[] = "photograph = ?";
        $fileBindings[] = $photographPath;
    }

    if (!empty($_FILES['passport_biodata']['tmp_name'])) {
        $biodataPath = $uploadDir . basename($_FILES['passport_biodata']['name']);
        move_uploaded_file($_FILES['passport_biodata']['tmp_name'], $biodataPath);
        $fileFields[] = "passport_biodata = ?";
        $fileBindings[] = $biodataPath;
    }

    if (!empty($_FILES['visa_approval']['tmp_name'])) {
        $visaApprovalPath = $uploadDir . basename($_FILES['visa_approval']['name']);
        move_uploaded_file($_FILES['visa_approval']['tmp_name'], $visaApprovalPath);
        $fileFields[] = "visa_approval = ?";
        $fileBindings[] = $visaApprovalPath;
    }

    if (!empty($_FILES['supporting_documents']['tmp_name'])) {
        $supportingDocsPath = $uploadDir . basename($_FILES['supporting_documents']['name']);
        move_uploaded_file($_FILES['supporting_documents']['tmp_name'], $supportingDocsPath);
        $fileFields[] = "supporting_documents = ?";
        $fileBindings[] = $supportingDocsPath;
    }

    if (!empty($_FILES['Flight_ticket']['tmp_name'])) {
        $supportingDocsPath = $uploadDir . basename($_FILES['Flight_ticket']['name']);
        move_uploaded_file($_FILES['Flight_ticket']['tmp_name'], $supportingDocsPath);
        $fileFields[] = "Flight_ticket = ?";
        $fileBindings[] = $supportingDocsPath;
    }


    
    if (!empty($_FILES['Accommodation_booking']['tmp_name'])) {
        $supportingDocsPath = $uploadDir . basename($_FILES['Accommodation_booking']['name']);
        move_uploaded_file($_FILES['Accommodation_booking']['tmp_name'], $supportingDocsPath);
        $fileFields[] = "Accommodation_booking = ?";
        $fileBindings[] = $supportingDocsPath;
    }

    if (!empty($_FILES['Bank_Statement']['tmp_name'])) {
        $supportingDocsPath = $uploadDir . basename($_FILES['Bank_Statement']['name']);
        move_uploaded_file($_FILES['Bank_Statement']['tmp_name'], $supportingDocsPath);
        $fileFields[] = "Bank_Statement = ?";
        $fileBindings[] = $supportingDocsPath;
    }



    

    // Base query
    $query = "UPDATE v_order_list SET 
        o_fname = ?, 
        o_lname = ?, 
        passport_number = ?, 
        nationality = ?, 
        gender = ?, 
        dob = ?, 
        passport_issue_date = ?, 
        passport_expiry_date = ?, 
        passport_issuing_country = ?, 
        applying_from = ?, 
        travel_date = ?, 
        exit_date = ?, 
        present_address = ?, 
        postcode = ?, 
        city = ?, 
        state = ?, 
        status = ?";

    // Append file-specific updates if any
    if (!empty($fileFields)) {
        $query .= ", " . implode(", ", $fileFields);
    }

    $query .= " WHERE void = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing query: " . $conn->error);
    }

    $bindParams = [
        $o_fname,
        $o_lname,
        $passport_number,
        $nationality,
        $gender,
        $dob,
        $passport_issue_date,
        $passport_expiry_date,
        $passport_issuing_country,
        $applying_from,
        $travel_date,
        $exit_date,
        $present_address,
        $postcode,
        $city,
        $state,
        $status,
    ];

    // Append file bindings and void at the end
    $bindParams = array_merge($bindParams, $fileBindings, [$void]);

    // Generate binding types dynamically
    $types = str_repeat('s', count($bindParams) - 1) . 'i';
    $stmt->bind_param($types, ...$bindParams);

    // Execute and handle result
    if ($stmt->execute()) {
header("Location: submit_1.php?invoice=$invoice&rowselect=$rowselect");
        
        
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method!";
}
?>
