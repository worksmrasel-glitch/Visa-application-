<?php 
include('tam_layout/header.php'); 

$invoice = $_GET['ref'] ?? null;
if ($id === null) {
 $id = $_GET['id'];
}


if (isset($_POST['update'])) {
 // Get all form values and sanitize them
$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$passport_number = mysqli_real_escape_string($conn, $_POST['passport_number']);
$citizenship = mysqli_real_escape_string($conn, $_POST['citizenship']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

// Construct dates from components
$dob = mysqli_real_escape_string($conn, $_POST['doby'].'-'.$_POST['dobm'].'-'.$_POST['dobd']);
$passport_issue_date = mysqli_real_escape_string($conn, $_POST['piy'].'-'.$_POST['pim'].'-'.$_POST['pid']);
$passport_expiry_date = mysqli_real_escape_string($conn, $_POST['pey'].'-'.$_POST['pem'].'-'.$_POST['ped']);

// Other fields
$picountry = mysqli_real_escape_string($conn, $_POST['picountry']);
$afcountry = mysqli_real_escape_string($conn, $_POST['afcountry']);
$travel_date = mysqli_real_escape_string($conn, $_POST['travel_date']);
$exit_date = mysqli_real_escape_string($conn, $_POST['exit_date']);
$paddress = mysqli_real_escape_string($conn, $_POST['paddress']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$pcode = mysqli_real_escape_string($conn, $_POST['pcode']);
$state = mysqli_real_escape_string($conn, $_POST['state']);

// Build the UPDATE query following your pattern
$query = "UPDATE `v_order_list` SET 
          `o_fname` = '$first_name',
          `o_lname` = '$full_name',
          `passport_number` = '$passport_number',
          `nationality` = '$citizenship',
          `gender` = '$gender',
          `dob` = '$dob',
          `passport_issue_date` = '$passport_issue_date',
          `passport_expiry_date` = '$passport_expiry_date',
          `passport_issuing_country` = '$picountry',
          `applying_from` = '$afcountry',
          `travel_date` = '$travel_date',
          `exit_date` = '$exit_date',
          `present_address` = '$paddress',
          `city` = '$city',
          `postcode` = '$pcode',
          `state` = '$state',
          `updated_at` = NOW()
          WHERE `o_invoice` = '$invoice' AND `void` = '$id'";

$result = mysqli_query($conn, $query);
}





if (isset($_POST['uploadPhoto']) && isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    $photoPath = 'uploads/photos/' . time() . '_' . basename($photo['name']);
    if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
        mysqli_query($conn, "UPDATE v_order_list SET photograph = '$photoPath' WHERE o_invoice = '$invoice' AND void = '$id'");
    }
}



if (isset($_POST['uploadPassport']) && isset($_FILES['passport_biodata'])) {
    $passport = $_FILES['passport_biodata'];
    $passportPath = 'uploads/passports/' . time() . '_' . basename($passport['name']);
    if (move_uploaded_file($passport['tmp_name'], $passportPath)) {
        mysqli_query($conn, "UPDATE v_order_list SET passport_biodata = '$passportPath' WHERE o_invoice = '$invoice' AND void = '$id'");
    }
}

// File upload directory
$uploadDir = 'uploads/';

// Handle Flight Ticket Upload
if (isset($_POST['uploadFlightTicket']) && isset($_FILES['flight_ticket'])) {
    $file = $_FILES['flight_ticket'];
    $filePath = $uploadDir .'flight_tickets/' . time() . '_' . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $query = "UPDATE v_order_list SET Flight_ticket = '$filePath' WHERE o_invoice = '$invoice' AND void = '$id'";
        mysqli_query($conn, $query);
    }
}

// Handle Accommodation Booking Upload
if (isset($_POST['uploadaccommodations']) && isset($_FILES['accommodation_booking'])) {
    $file = $_FILES['accommodation_booking'];
    $filePath = $uploadDir . 'accommodations/' . time() . '_' . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $query = "UPDATE v_order_list SET accommodation_booking = '$filePath' WHERE o_invoice = '$invoice' AND void = '$id'";
        mysqli_query($conn, $query);
    }
}

// Handle Bank Statement Upload
if (isset($_POST['uploadBankStatement']) && isset($_FILES['bank_statement'])) {
    $file = $_FILES['bank_statement'];
    $filePath = $uploadDir . 'bank_statements/' . time() . '_' . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $query = "UPDATE v_order_list SET bank_statement = '$filePath' WHERE o_invoice = '$invoice' AND void = '$id'";
        mysqli_query($conn, $query);
    }
}

// Handle Supporting Document Upload
if (isset($_POST['uploadSupportingDoc']) && isset($_FILES['supporting_doc'])) {
    $file = $_FILES['supporting_doc'];
    $filePath = $uploadDir . 'supporting_docs/' . time() . '_' . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $query = "UPDATE v_order_list SET supporting_documents = '$filePath' WHERE o_invoice = '$invoice' AND void = '$id'";
        mysqli_query($conn, $query);
       
    }
}

// Handle File Deletions
if (isset($_GET['delete'])) {
    $type = $_GET['type'];
    $column = '';
    $subdir = '';
    
    switch ($type) {
        case 'flight_ticket':
            $column = 'flight_ticket';
            $subdir = 'flight_tickets/';
            break;
        case 'accommodation':
            $column = 'accommodation_booking';
            $subdir = 'accommodations/';
            break;
        case 'bank_statement':
            $column = 'bank_statement';
            $subdir = 'bank_statements/';
            break;
        case 'supporting_doc':
            $column = 'supporting_documents';
            $subdir = 'supporting_docs/';
            break;
        default:
            die("Invalid file type");
    }
    
    // Get current file path
    $result = mysqli_query($conn, "SELECT $column FROM v_order_list WHERE o_invoice = '$invoice' AND void = '$id'");
    $row = mysqli_fetch_assoc($result);
    $filePath = $row[$column];
    
    // Delete file from server
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    
    // Update database
    mysqli_query($conn, "UPDATE v_order_list SET $column = NULL WHERE o_invoice = '$invoice' AND void = '$id'");
    header("Location: ".$_SERVER['PHP_SELF']."?ref=$invoice&id=$id");
    exit();
}




$invoice = mysqli_real_escape_string($conn, $invoice);
$id = mysqli_real_escape_string($conn, $id);
 if($id!=null){
$query = "SELECT * FROM `v_order_list` WHERE `o_invoice` = '$invoice' AND `void` = '$id'";
$result = mysqli_query($conn, $query);
 }
else{
 $query = "SELECT * FROM `v_order_list` WHERE `o_invoice` = '$invoice'  ORDER BY void ASC LIMIT 1" ;
$result = mysqli_query($conn, $query);   
}

$queryall = "SELECT * FROM `v_order_list` WHERE  `o_invoice` = '$invoice'  ORDER BY void ASC";
$resultall = mysqli_query($conn, $queryall);


$countryq = mysqli_query($conn, "SELECT * FROM countries") or die(mysqli_error($conn));
$i=1;
 while ($rcont = mysqli_fetch_assoc($countryq)) {
     $country[$i]=$rcont['name'];
     $i++;
 }


?>


 <!-- Blue Banner -->
  <div class="w-100 position-relative sidebar-header-logo" style="height:500px;">
  <div class="h-100 d-flex justify-content-center align-items-center text-white text-center">

  </div>
</div>

  <div class="container " style="margin-top: -450px; z-index: 10; position: relative;">
    <div class="main-card row g-0">
      




      <!-- Right Section (Form) -->
      <div class="right-section col-md-12 col-lg-8 order-1 order-lg-2">

        <div class="container my-5 p-4 bg-white shadow-sm border rounded">
  <!-- Application Reference -->
  <div class="text-center mb-4">
    <h5 class="text-uppercase fw-bold">Application Reference Number :
      <span class="text-success"><?php echo $invoice ;?></span>
    </h5>
    <h6 class="text-warning">Preview – Information</h6>
    <p class="text-muted">
      You are responsible for the accuracy of the information you provide. Make sure the applicant details are 100% correct, or your application may be delayed or rejected by the Malaysian Government.
    </p>
  </div>

  <!-- Passport Information -->
  <h5 class="text-primary fw-bold">Passport Information</h5>
  <div class="row row-cols-1 row-cols-md-2 g-3 border-bottom pb-3 mb-4">
  
  
  <?php 

 while ($row = mysqli_fetch_assoc($result)) {
      $id=$row['void'];
            ?>
              
    <div class="col"><strong>Passport Number:</strong> <?php echo $row['passport_number']; ?></div>
    <div class="col"><strong>Passport Expiry Date:</strong> <?php echo  $row['passport_expiry_date']; ?></div>
    <div class="col"><strong>Surname:</strong> <?php echo  $row['o_fname']; ?></div>
    <div class="col"><strong>Applying From:</strong> <?php $c=$row['applying_from']; echo $country[$c] ; ?></div>
    <div class="col"><strong>Given Name:</strong> <?php echo  $row['o_lname']; ?></div>
    <div class="col"><strong>Approx Travel Date:</strong> <?php echo  $row['travel_date']; ?> </div>
    <div class="col"><strong>Nationality:</strong> <?php $isc=$row['nationality']; echo $country[$isc] ; ?></div>
    <div class="col"><strong>Approx Exit Date:</strong> <?php echo  $row['exit_date']; ?></div>
    <div class="col"><strong>Gender:</strong> <?php echo  $row['gender']; ?></div>
    <div class="col"><strong>Passport Issue Date:</strong> <?php echo  $row['passport_issue_date']; ?></div>
    <div class="col"><strong>Date Of Birth:</strong> <?php echo  $row['dob']; ?></div>
    <div class="col"><strong>Present Address:</strong> <?php echo  $row['present_address']; ?></div>
    <div class="col"><strong>Issuing Country:</strong> <?php $isc=$row['passport_issuing_country']; echo $country[$isc] ; ?></div>
    <div class="col"><strong>Date Of Issue:</strong> <?php echo  $row['passport_issue_date']; ?></div>
  
 
           
  
  
  </div>

  <!-- File Uploads -->
  <div class="row g-4">
      
      <h4 class="text-center">Please upload the following documents</h4>
      
   <!--photo uploaad-->
     <div class="col-md-6">
       <form method="POST" action="preview.php?ref=<?php echo $invoice; ?>&id=<?php echo $id; ?>" enctype="multipart/form-data">
        <label class="form-label">Photographs <span class="text-danger"></span></label>
        <input type="file" class="form-control mb-1" name="photo" required />
        <small class="text-success">Recent passport-sized photograph</small>
           <div class="d-flex gap-2 mt-2">
          <!-- View Button (only if photograph exists) -->
              <?php if (!empty($row['photograph'])) { ?>
                             <a href="<?= $row['photograph'] ?>" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
                  <i class="fas fa-eye me-2"></i> View
                </a>
                
              <?php }else{ ?>
              <button type="submit" name="uploadPhoto" class="btn btn-sm btn_primary d-flex align-items-center">
                <i class="fas fa-upload me-2"></i> Upload
              </button>
              <?php } ?>
            </div>
        </form>
      </div>





    <div class="col-md-6">
  <form method="POST" action="preview.php?ref=<?= $invoice ?>&id=<?= $id ?>" enctype="multipart/form-data">
    <!-- Passport Biodata Upload -->
    <label class="form-label">Passport Copy <span class="text-danger"></span></label>
    <input type="file" class="form-control mb-1" name="passport_biodata" required />
    <small class="text-success">Passport bio. with validity of at least more than 6 months</small>

    <div class="d-flex gap-2 mt-2">
      <!-- Upload button -->
      <?php if (!empty($row['passport_biodata'])) { ?>
                      <a href="<?= $row['passport_biodata'] ?>" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
                  <i class="fas fa-eye me-2"></i> View
                </a>
                
                </a>
              <?php }else{ ?>
              <button type="submit" name="uploadPassport" class="btn btn-sm btn_primary d-flex align-items-center">
                <i class="fas fa-upload me-2"></i> Upload
              </button>
              <?php } ?>
    </div>
  </form>
</div>






  
  <!-- Flight Ticket -->
  <div class="col-md-6">
    <form method="POST" action="preview.php?ref=<?= $invoice ?>&id=<?= $id ?>" enctype="multipart/form-data">
      <label class="form-label">Flight Ticket <span class="text-danger"></span></label>
      <input type="file" class="form-control mb-1" name="flight_ticket" required />
      <small class="text-success">Round Trip Ticket</small>
      
      <div class="d-flex gap-2 mt-2">
        <?php if (!empty($row['Flight_ticket'])) { ?>
                  <a href="<?= $row['Flight_ticket'] ?>" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
            <i class="fas fa-eye me-2"></i> View
          </a>
      
          </a>
        <?php } else { ?>
          <button type="submit" name="uploadFlightTicket" class="btn btn-sm btn_primary d-flex align-items-center">
            <i class="fas fa-upload me-2"></i> Upload
          </button>
        <?php } ?>
      </div>
    </form>
  </div>


  <!-- Accommodation Booking -->
  <div class="col-md-6">
      <form method="POST" enctype="multipart/form-data">
    <form method="POST" action="preview.php?ref=<?= $invoice ?>&id=<?= $id ?>" enctype="multipart/form-data">
      <label class="form-label">Accommodation Booking <span class="text-danger"></span></label>
      <input type="file" class="form-control mb-1" name="accommodation_booking" required />
      <small class="text-success">Hotel booking or others proof of accommodation</small>
      
      <div class="d-flex gap-2 mt-2">
        <?php if (!empty($row['Accommodation_booking'])) { ?>
                  <a href="<?= $row['Accommodation_booking'] ?>" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
            <i class="fas fa-eye me-2"></i> View
          </a>
          
         </a>
        <?php } else { ?>
          <button type="submit" name="uploadaccommodations" class="btn btn-sm btn_primary d-flex align-items-center">
            <i class="fas fa-upload me-2"></i> Upload
          </button>
        <?php } ?>
      </div>
    </form>
  </div>



  <!-- Bank Statement -->
  <div class="col-md-6">
    <form method="POST" action="preview.php?ref=<?= $invoice ?>&id=<?= $id ?>" enctype="multipart/form-data">
      <label class="form-label">Bank Statement</label>
      <input type="file" class="form-control mb-1" name="bank_statement" />
      <small class="text-success">Latest 03 months</small>
      
      <div class="d-flex gap-2 mt-2">
        <?php if (!empty($row['Bank_Statement'])) { ?>
                  <a href="<?= $row['Bank_Statement'] ?>" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
            <i class="fas fa-eye me-2"></i> View
          </a>
         
        <?php } else { ?>
          <button type="submit" name="uploadBankStatement" class="btn btn-sm btn_primary d-flex align-items-center">
            <i class="fas fa-upload me-2"></i> Upload
          </button>
        <?php } ?>
      </div>
    </form>
  </div>

  <!-- Other Supporting Document -->
  <div class="col-md-6">
    <form method="POST" action="preview.php?ref=<?= $invoice ?>&id=<?= $id ?>" enctype="multipart/form-data">
      <label class="form-label">Other Supporting Document</label>
      <input type="file" class="form-control mb-1" name="supporting_doc" />
      <small class="text-success">Additional Document</small>
      
      <div class="d-flex gap-2 mt-2">
                  <?php if (!empty($row['supporting_documents'])) { ?>
                   <a href="<?= $row['supporting_documents'] ?>" target="_blank" class="btn btn-sm btn-success d-flex align-items-center">
            <i class="fas fa-eye me-2"></i> View
          </a>
          
        <?php } else { ?>
          <button type="submit" name="uploadSupportingDoc" class="btn btn-sm btn_primary d-flex align-items-center">
            <i class="fas fa-upload me-2"></i> Upload
          </button>
        <?php } ?>
      </div>
    </form>
  </div>


  </div>


<?php } ?>
         
        







<div class="row mt-5 g-3">
  <!-- Modify Button -->
  <div class="col-12 col-md-6">
    <button class="btn btn-warning w-100" onclick="window.location.href='modify.php?id=<?php echo $id; ?>'">
      <i class="bi bi-pencil-square"></i> Back to Modify
    </button>
  </div>

  <!-- Submit Form Button -->
  <div class="col-12 col-md-6">
    <form method="post" action="next_step_payment.php?invoice=<?php echo $invoice; ?>">
      <button type="submit" name="submit" class="btn btn-success w-100">
        <i class="bi bi-save2-fill"></i> Save & Next
      </button>
    </form>
  </div>
</div>

</div>
      
      </div>






      <!-- Left Section progress -->
      <style>
          
          .progress-card .row {
  transition: background-color 0.3s, color 0.3s;
  cursor: pointer;
}

.progress-card .row:hover {
  background-color:	#FF8886;
}

.progress-card .row.active {
  background-color:#90f592;
 
}
.custom-link {
  color: black;
  text-decoration: none;
}

.custom-link:hover {
  color: blue; 
}
      </style>
      <div class="left-section col-lg-4 order-2 order-lg-1">
        <div class="card progress-card">
  <div class="progress-header">
    <h5 class="mb-0">APPLICATION</h5>
    <small>PROGRESS</small>
  </div>
  <div class="card-body text-center bg-light">
    <div id="progress-circle90">
      <div class="progress-inner">
        <span>90 %</span>
      </div>
    </div>
  </div>
  <div class="progress-footer">
    <i class="fas fa-thumbs-up"></i>
    - 45647564
  </div>
</div>


<div class="card progress-card">
       <?php
       $i=1;
        while ($row2 = mysqli_fetch_assoc($resultall)) {
            ?>
       
        <a href="<?php echo "?ref=".$invoice.'&id='.$row2['void']; ?>" class="custom-link"> 
        <div class="row p-3 <?php if($row2['void']==$id){echo 'active';} ?>">
           <div class="col-1"><?php echo $i; ?></div>
           <div class="col-7"><?php echo $row2['o_fname']; ?></div>
           <div class="col-4"><i class="fa fa-eye pe-2" aria-hidden="true"></i>view</div>
       </div></a>
       <?php $i++; } ?>
        
 </div>      
        
 
    
    </div>

    <!-- end progress  -->

    </div>
  </div>


<?php include('tam_layout/footer.php'); ?>
