<?php 
include('tam_layout/header.php');

 $countryq = mysqli_query($conn, "SELECT * FROM countries") or die(mysqli_error($conn));
        $i=1;
         while ($rcont = mysqli_fetch_assoc($countryq)) {
             $country[$i]=$rcont['name'];
             $i++;
         }

?>

   <div class="container">
  <div class="w-75 mx-auto mt-4">
      
      <h4 class="p-3 btn_default text-center">Malaysia eVisa Status Cheak Online</h4>
      <style>
        .text-content{
        margin-top: 10px;
        background-color: #d1ecf1;
        max-width: 100%;
        padding: 10px;
        border-radius: 10px;
     }
      </style>
      <div class="text-content">
                            <h6 style="margin-bottom: 5px">Note: Visa Type: Tourist | Student | Expatriate | Transit | Medical</h6>
                            <ol>
                                <li>Input your Visa Application Reference. Number To check the status of your
                                    Malaysian visa, you can typically use the reference number provided during the
                                    application process. Please check your email inbox to get application ref.
                                    number through the payment confirmation email. You'll usually need to enter
                                    the reference number to view your application's status such as (Approved/
                                    Processing/Amendment/Rejected/ Further Processing/On Hold)</li>
                                
                            </ol>
                        </div>
                        
                        
<div class="container mt-4">  
  <form action="cheak_status.php" method="POST" enctype="multipart/form-data">
    <div class="row g-3 mx-5">
      <div class="col-md-8">
        <input
          type="text"
          name="reference_number"
          class="form-control"
          placeholder="Enter your reference number"
          required
        />
      </div>
      <div class="col-md-4">
        <button type="submit" name="check" class="btn btn-secondary w-100 d-flex align-items-center justify-content-center">
          CHECK NOW&nbsp;<i class="fas fa-question-circle"></i>
        </button>
      </div>
    </div>
  </form>
</div> 


<?php 
if (isset($_POST['check'])) {
    $ref = trim($_POST['reference_number']);

    // Make sure $ref is safe (basic escaping)
    $ref = mysqli_real_escape_string($conn, $ref);

    $query = "SELECT * FROM visa_account WHERE invoice = '$ref'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
        
        <!-- START HTML OUTPUT -->
        <div class="container mt-5">
          <div class="row">
            <!-- Left Column: Application Details -->
            <div class="col-md-7">
              <h5><strong>Application Details</strong></h5>
              <table class="table table-bordered">
                <tbody>
                  <tr><th>Reference Number</th><td><?php echo $row['invoice']; ?></td></tr>
                  <tr><th>Num. of Visitors</th><td><?php echo $row['visitor_count']; ?></td></tr>
                  <tr><th>Contact Email</th><td><?php echo $row['user_email']; ?></td></tr>
                  <tr><th>Contact Phone</th><td><?php echo $row['phone_number']; ?></td></tr>
                  <tr><th>Country</th><td> <?php $isc=$row['Citzen_Of']; echo $country[$isc] ; ?></td></tr>
                  <tr>
                    <th>Payment Status</th>
                    <td>
                      <span class="text-danger fw-bold"><?php echo $row['payment_status']; ?></span>
                      <button class="btn btn-primary btn-sm ms-2" onclick="window.location.href='next_step_payment.php?invoice=<?php echo $row['invoice']; ?>'">
                          PAY NOW <i class="fas fa-paper-plane ms-1"></i>
                      </button>
                    </td>
                  </tr>
                  <tr><th>Apply Date</th><td><?php echo $row['v_datetime']; ?></td></tr>
                </tbody>
              </table>
            </div>

            <!-- Right Column: Visa Status Table -->
            <div class="col-md-5">
              <h5><strong>Applicant Visa Status</strong></h5>
              <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                  <tr>
                    <th>#</th><th>VISITOR</th><th>STATUS</th><th><i class="fas fa-file-pdf"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><strong><?php echo $row['full_name']; ?></strong><br><strong><?php echo $row['first_name']; ?></strong></td>
                    <td><span class="text-danger fw-bold"><?php echo $row['payment_status']; ?></span></td>
                    <td>
                        <?php if (!empty($row['file'])): ?>
                            <a href="apm/adman/<?php echo htmlspecialchars($row['file']); ?>" target="_blank">
                                <i class="fas fa-file-pdf" style="color:red;"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
              <?php if (strtolower($row['payment_status']) === 'approved') : ?>
    <p>
        <strong>Remark :</strong> 
        Click the PDF icon beside your name to download your eVisa. Enjoy your journey, thank you.
    </p>
<?php else : ?>
    <p>
        <strong>Remark :</strong> <?php echo $row['checkboxv']; ?>
    </p>
<?php endif; ?> 
            </div>
          </div>
        </div>
        <!-- END HTML OUTPUT -->

<?php
        }
    } else {
        echo "<div class='container mt-4 mx-5 alert alert-warning'>";
        echo "No record found for reference number: <strong>" . htmlspecialchars($ref) . "</strong>";
        echo "</div>";
    }
}
?>








 
 <hr>

 <div class="m-5 p-5"></div>
 

   
  </div>
</div>

    
    
    
    


  <?php 
include('tam_layout/footer.php');
?>
