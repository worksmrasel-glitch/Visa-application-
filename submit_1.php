<?php 

include('tam_layout/header.php');
   $invoice = $_GET['invoice'];
   
$row_counnt = isset($_GET['rowselect']) ? $_GET['rowselect'] + 1 : 0;

   function canProceedToNextStep($conn, $invoice, $void) {
    $query_blank_testing = "
    SELECT 
        CONCAT(
            IF(`o_lname` IS NULL OR `o_lname` = '', 'o_lname, ', ''),
            IF(`passport_number` IS NULL OR `passport_number` = '', 'passport_number, ', ''),
            IF(`nationality` IS NULL OR `nationality` = '', 'nationality, ', ''),
            IF(`gender` IS NULL OR `gender` = '', 'gender, ', ''),
            IF(`dob` IS NULL OR `dob` = '', 'dob, ', ''),
            IF(`passport_issue_date` IS NULL OR `passport_issue_date` = '', 'passport_issue_date, ', ''),
            IF(`passport_expiry_date` IS NULL OR `passport_expiry_date` = '', 'passport_expiry_date, ', ''),
            IF(`passport_issuing_country` IS NULL OR `passport_issuing_country` = '', 'passport_issuing_country, ', ''),
            IF(`applying_from` IS NULL OR `applying_from` = '', 'applying_from, ', ''),
            IF(`travel_date` IS NULL OR `travel_date` = '', 'travel_date, ', ''),
            IF(`exit_date` IS NULL OR `exit_date` = '', 'exit_date, ', ''),
            IF(`present_address` IS NULL OR `present_address` = '', 'present_address, ', ''),
            IF(`postcode` IS NULL OR `postcode` = '', 'postcode, ', ''),
            IF(`city` IS NULL OR `city` = '', 'city, ', ''),
            IF(`state` IS NULL OR `state` = '', 'state, ', ''),
            IF(`photograph` IS NULL OR `photograph` = '', 'photograph, ', ''),
            IF(`passport_biodata` IS NULL OR `passport_biodata` = '', 'passport_biodata, ', ''),
            IF(`visa_approval` IS NULL OR `visa_approval` = '', 'visa_approval, ', ''),
            IF(`supporting_documents` IS NULL OR `supporting_documents` = '', 'supporting_documents, ', ''),
            IF(`complete_visa_upload` IS NULL OR `complete_visa_upload` = '', 'complete_visa_upload, ', ''),
            IF(`status` IS NULL OR `status` = '', 'status, ', ''),
            IF(`created_at` IS NULL OR `created_at` = '', 'created_at, ', ''),
            IF(`updated_at` IS NULL OR `updated_at` = '', 'updated_at, ', '')
        ) AS blank_columns
    FROM `v_order_list`
    WHERE `void` = '$void' AND `o_invoice` = '$invoice' ORDER BY void ASC";

    
    $check_row = mysqli_query($conn, $query_blank_testing);
    if ($check_row) {
        $row_result = mysqli_fetch_assoc($check_row);
        $blankColumnList = rtrim($row_result['blank_columns'], ', '); // Get the blank columns

        // Convert blank columns to an array for comparison
        $blankColumnsArray = explode(', ', $blankColumnList);

        // Required fields that must not be blank
        $requiredFields = ['o_lname', 'passport_number'];

        // Check if any required fields are missing
        $missingRequiredFields = array_intersect($requiredFields, $blankColumnsArray);

        // Return true if no required fields are missing, otherwise false
        return empty($missingRequiredFields);
    } else {
        // Handle query error
        return false;
    }
}


         $query = "SELECT * FROM `v_order_list` WHERE  `o_invoice` = '$invoice'   ORDER BY void ASC  ";
         $result = mysqli_query($conn, $query);
         // Fetch the rows
         $tableData = [];
         $serialNumber = 1;  // Initialize serial number for the rows
         while ($row = mysqli_fetch_assoc($result)) {
             $tableData[] = [
                 'Sl' => $serialNumber++,  // Assign the current serial number and increment it
                 'o_invoice' => $row['o_invoice'],
                 'void' => $row['void'],
                 'o_fname' => $row['o_fname'],
                 'status' => $row['status']  // Assuming 'o_status' is the status field
             ];
         }
         // Calculate the row count
         $rowCount = count($tableData);
         
         // Define the total value (this could be dynamic, depending on your business logic)
         // Calculate the percentage
         $doneCount = $doneCount; // Counter for rows marked as "Done"

         // Iterate through table data to calculate the "Done" count
         foreach ($tableData as $row) {
             if (canProceedToNextStep($conn, $row['o_invoice'], $row['void'])) {
                 $doneCount++;
             }
         }
 
         $percentageSSSS=20;

         $percentage = ($rowCount > 0) ? (($doneCount / $rowCount) * 60) + $percentageSSSS : 0;
         
         
         
         
         $countryq = mysqli_query($conn, "SELECT * FROM countries") or die(mysqli_error($conn));
        $i=1;
         while ($rcont = mysqli_fetch_assoc($countryq)) {
             $country[$i]=$rcont['name'];
             $i++;
         }
         
          $xquery = "SELECT * FROM `visa_account` WHERE `invoice` = '$invoice'  ORDER BY id ASC LIMIT 1" ;
          $xresult = mysqli_query($conn, $xquery); 

   ?>




 <!-- Blue Banner -->
  <div class="w-100 position-relative sidebar-header-logo" style="height:500px;">
  <div class="h-100 d-flex justify-content-center align-items-center text-white text-center">

  </div>
</div>

  <div class="container " style="margin-top: -450px; z-index: 10; position: relative;">
    <div class="main-card row g-0">
      






      <!-- Left Section progress -->
      <div class="left-section col-lg-4 order-2 order-lg-1">
        <div class="card progress-card">
  <div class="progress-header">
    <h5 class="mb-0">APPLICATION</h5>
    <small>PROGRESS</small>
  </div>
  <div class="card-body text-center bg-light">
      
      <style>
         .circ{
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin: 30px auto;
      display: flex;
      align-items: center;
      justify-content: center;
      background: conic-gradient(#4CAF50 0% <?php echo $percentage;?>%, #ccc <?php echo $percentage;?>% 100%);
         }
      </style>
    <div class="circ">
      <div class="progress-inner">
        <span><?php echo $percentage;?> %</span>
      </div>
    </div>
  </div>
  <div class="progress-footer">
    <i class="fas fa-thumbs-up"></i>
    - 45647564
  </div>
</div>



 
            <!-- Table -->
            <div class="table-responsive">
               <table class="table table-md table-head-fixed" id="visitorTable">
                  <thead>
                 <tr>
                    <th class="text-left">Num of Visitor</th>
                    <th class="text-left">Visitor</th>
                      <th class="text-center">Status</th>
                    </tr> 
                  </thead>
                  
<tbody>
    <?php
    $allRowsDone = true; 
    $errorRows = [];
    foreach ($tableData as $rowIndex => $row): ?>
    <tr class="visitor-row" 
        data-id="<?php echo $row['void']; ?>"
        data-name="<?php echo $row['o_fname']; ?>"
        data-status="<?php echo $row['status']; ?>"
        data-invoice="<?php echo $row['o_invoice']; ?>"
        data-abcd="<?php echo $rowIndex ; ?>"
        
        
        style="cursor: pointer;">
        <td class="text-center"><?php echo $row['Sl']; ?> 
         </td>
        <td class="text-left"><?php echo $row['o_fname']; ?></td>
        <td class="text-center">
            <?php
            // Check the status of the row
            $result = canProceedToNextStep($conn, $row['o_invoice'], $row['void']);
            if ($result) {
                echo "<span class='bg-success text-white p-2'><i class='fa fa-check'></i> Done</span>";
            } else {
                echo "<span class='text-success  p-2'><i class='fa fa-edit'></i> </span>";
                $allRowsDone = false; // Mark that not all rows are "Done"
                $errorRows[] = $rowIndex + 1; // Store the 1-based index of the row with error
            }
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
 </table>



            </div>
       
        
 
    
    </div>

    <!-- end progress  -->




      <!-- Right Section (Form) -->
      <div class="right-section col-md-12 col-lg-8 order-1 order-lg-2">

        <div class="card mb-5">
            <div class="card-body ">
             <h3 class="text-center">
                <?php 
                while ($row = mysqli_fetch_assoc($xresult)) {
                    $isc = $row['Citzen_Of'];
                    echo '<span style="color: green; text-transform: uppercase;">' . $country[$isc] . '</span> ';
                }
                ?>
                <strong style="color: #1e90ff; text-transform: uppercase;">TO MALAYSIA</strong>
                               
            </h3>
               <p style="font-weight: normal;">Please provide the requested details exactly as they appear in your passport. Need help filling out the form? Use our website’s live chat support — our visa expert team is ready to assist you.<p>
               <p style="text-align: center;"> (ALL INPUT FIELDS ARE REQUIRED)<p></p>
               <hr>
               <!-- Step 1: Personal Information -->
               <div id="step2<?php echo $invoice ?>">
                  <!-- other page loadr -->
               </div>
            </div>


<!-- Table rendering here -->
<?php
if ($allRowsDone) {
    echo '<script>window.location.href = "preview.php?ref=' . urlencode($invoice) . '";</script>';
}
?>

    <!--<div class="card-body mt-2 mb-4 text-center">-->
    <!--    <a href="next_step_payment.php?invoice=<?php echo $invoice; ?>" class="btn btn-success btn-lg">-->
    <!--    CONTINUE TO PAYMENT  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>-->

    <!--    </a>-->
    <!--</div>-->
    



         </div>
      </div>
    </div>
  </div>













<?php include('tam_layout/footer.php'); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            document.getElementById("errorBox").style.display = "block";
        }, 5000);
    });
</script>


<script>
    $("select").select2();
    $(document).ready(function () {
        // Automatically load the first visitor's information on page load
        const firstVisitorRow = $('#visitorTable .visitor-row').first();
        const sendVisitorRow = $('#visitorTable .visitor-row').last();

        if (firstVisitorRow.length > 0) {
            const visitorId = firstVisitorRow.data('id');
            const abcd = firstVisitorRow.data('abcd');  // Use data from the first row

            console.log(abcd); // This should log the abcd value of the first row

            const invoice = '<?php echo $invoice; ?>';
            const url = `visiter_information.php?invoice=${invoice}&visitorId=${visitorId}&abcd=${0}`;

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Update the DOM with the fetched data
                    document.querySelector(`#step2${invoice}`).innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            // Optionally highlight the first row
            firstVisitorRow.addClass('active');
        }

        // Add click event to load visitor information when a row is clicked
        $('#visitorTable').on('click', '.visitor-row', function () {
            // Remove active class from other rows
            $('#visitorTable .visitor-row').removeClass('active');

            // Add active class to the clicked row
            $(this).addClass('active');

            // Get the visitor data from the clicked row
            const visitorId = $(this).data('id');
            const invoice = '<?php echo $invoice; ?>';
            const abcd = $(this).data('abcd');  // Get the abcd value from the clicked row

            console.log(abcd); // This will log the abcd value of the clicked row
            
            const url = `visiter_information.php?invoice=${invoice}&visitorId=${visitorId}&abcd=${abcd}`;

            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Update the DOM with the fetched data
                    document.querySelector(`#step2${invoice}`).innerHTML = data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Automatically click on the second row if it exists
        const secondVisitorRow = $('#visitorTable .visitor-row').eq(<?php echo $row_counnt;?>);  // Select the second row (index 1)

        if (secondVisitorRow.length > 0) {
            secondVisitorRow.trigger('click'); 
        }
    });
</script>
