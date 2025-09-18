<?php 
session_start();
include('tam_layout/header.php'); 

$countryq = mysqli_query($conn, "SELECT * FROM countries") or die(mysqli_error($conn));
$i=1;
 while ($rcont = mysqli_fetch_assoc($countryq)) {
     $country[$i]=$rcont['name'];
     $i++;
 }




$id = $_GET['id'] ?? null;
$query = "SELECT * FROM `v_order_list` WHERE  `void` = '$id'  ";
$result = mysqli_query($conn, $query);
 

?>

 <!-- Blue Banner -->
  <div class="w-100 position-relative sidebar-header-logo" style="height:400px;">
  <div class="h-100 d-flex justify-content-center align-items-center text-white text-center">

  </div>
</div>

  <div class="container " style="margin-top: -370px; z-index: 10; position: relative;">
    <div class="main-card row g-0">
      


 <?php 
 while ($row = mysqli_fetch_assoc($result)) {
            ?>


      <!-- Right Section (Form) -->
      <div class="right-section col-md-12 col-lg-8 order-1 order-lg-2">

        <div class="container form-section">
  <div class="form-title mb-3 text-uppercase"><?php $nationality=$row['nationality'];  echo  $country[$nationality]; ?> TO <span>MALAYSIA</span></div>
  <p class="text-center text-muted mb-4">
    Please provide the details exactly as they appear in your passport.
    For help please click here <a href="#"><strong>RULES / HELP <i class="bi bi-info-circle"></i></strong></a>
  </p>

   <form action="preview.php?ref=<?php echo $row['o_invoice']."&id=".$row['void']; ?>" method="POST" enctype="multipart/form-data">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Given Name *</label>
        <input type="text" name="first_name" value="<?php echo  $row['o_fname']; ?>" class="form-control" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">Surname *</label>
        <input type="text" name="full_name" value="<?php echo  $row['o_lname']; ?>" class="form-control" required />
      </div>

      <div class="col-md-6">
        <label class="form-label">Passport Number *</label>
        <input type="text" name="passport_number" value="<?php echo $row['passport_number'];?>" class="form-control" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">Nationality *</label>
        <select name="citizenship" class="form-select" required>
          <option value="<?php $nationality=$row['nationality'];  echo  $country[$nationality];  ?>" selected ><?php echo  $country[$nationality]; ?></option>
          <?php foreach ($countryq as $country): ?>
      
                  <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                  
                  <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Gender *</label>
        <select name="gender" class="form-select" required>
          <option disabled <?php if (empty($row['gender'])) echo 'selected'; ?>>Please Select</option>
          <option value="Male" <?php if (isset($row['gender']) && $_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
          <option value="Female" <?php if (isset($row['gender']) && $_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
        </select>
      </div>

                          <div class="col-md-6">
                            <label class="form-label">Date of Birth *</label>
                           <?php  
                      $dobd = date('d', strtotime($row['dob'])); 
                      $dobm = date('m', strtotime($row['dob'])); 
                      $doby = date('Y', strtotime($row['dob'])); 
                    ?>
                    <div class="row g-2">
                      <!-- Day -->
                      <div class="col">
                        <select name="dobd" class="form-select" required>
                          <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Day</option>
                          <?php for ($d = 1; $d <= 31; $d++): ?>
                            <option value="<?= $d ?>" <?= ((int)$d === (int)$dobd) ? 'selected' : '' ?>>
                              <?= $d ?>
                            </option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    
                      <!-- Month -->
                      <div class="col">
                        <select name="dobm" class="form-select" required>
                          <option value="" disabled <?= empty($dobm) ? 'selected' : '' ?>>Month</option>
                          <?php
                            $months = [
                              1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                              5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                              9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                            ];
                            foreach ($months as $num => $name):
                          ?>
                            <option value="<?= $num ?>" <?= ((int)$num === (int)$dobm) ? 'selected' : '' ?>><?= $name ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    
                      <!-- Year -->
                      <div class="col">
                        <select name="doby" class="form-select" required>
                          <option value="" disabled <?= empty($doby) ? 'selected' : '' ?>>Year</option>
                          <?php
                            $currentYear = date('Y');
                            for ($y = $currentYear; $y >= 1950; $y--):
                          ?>
                            <option value="<?= $y ?>" <?= ((int)$y === (int)$doby) ? 'selected' : '' ?>><?= $y ?></option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                 </div>

                     <div class="col-md-6">
                  <label class="form-label">Passport Date of Issue *</label>
                  <div class="row g-2">
                    <?php 
                      $pid = date('d', strtotime($row['passport_issue_date'])); 
                      $pim = date('m', strtotime($row['passport_issue_date'])); 
                      $piy = date('Y', strtotime($row['passport_issue_date'])); 
                    ?>
                
                    <!-- Day -->
                    <div class="col">
                      <select name="pid" class="form-select" required>
                        <option value="" disabled <?= empty($pid) ? 'selected' : '' ?>>Day</option>
                        <?php for ($d = 1; $d <= 31; $d++): ?>
                          <option value="<?= $d ?>" <?= ((int)$d === (int)$pid) ? 'selected' : '' ?>><?= $d ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                
                    <!-- Month -->
                    <div class="col">
                      <select name="pim" class="form-select" required>
                        <option value="" disabled <?= empty($pim) ? 'selected' : '' ?>>Month</option>
                        <?php
                          $months = [
                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                          ];
                          foreach ($months as $num => $name):
                        ?>
                          <option value="<?= $num ?>" <?= ((int)$num === (int)$pim) ? 'selected' : '' ?>><?= $name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                
                    <!-- Year -->
                    <div class="col">
                      <select name="piy" class="form-select" required>
                        <option value="" disabled <?= empty($piy) ? 'selected' : '' ?>>Year</option>
                        <?php
                          $currentYear = date('Y');
                          for ($y = $currentYear; $y >= 1950; $y--):
                        ?>
                          <option value="<?= $y ?>" <?= ((int)$y === (int)$piy) ? 'selected' : '' ?>><?= $y ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                  </div>
                </div>


                          <div class="col-md-6">
                      <label class="form-label">Passport Expiry Date *</label>
                      <div class="row g-2">
                        <?php 
                          $ped = date('d', strtotime($row['passport_expiry_date'])); 
                          $pem = date('m', strtotime($row['passport_expiry_date'])); 
                          $pey = date('Y', strtotime($row['passport_expiry_date'])); 
                        ?>
                    
                        <!-- Day -->
                        <div class="col">
                          <select name="ped" class="form-select" required>
                            <option value="" disabled <?= empty($ped) ? 'selected' : '' ?>>Day</option>
                            <?php for ($d = 1; $d <= 31; $d++): ?>
                              <option value="<?= $d ?>" <?= ((int)$d === (int)$ped) ? 'selected' : '' ?>><?= $d ?></option>
                            <?php endfor; ?>
                          </select>
                        </div>
                    
                        <!-- Month -->
                        <div class="col">
                          <select name="pem" class="form-select" required>
                            <option value="" disabled <?= empty($pem) ? 'selected' : '' ?>>Month</option>
                            <?php
                              $months = [
                                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                                5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                                9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                              ];
                              foreach ($months as $num => $name):
                            ?>
                              <option value="<?= $num ?>" <?= ((int)$num === (int)$pem) ? 'selected' : '' ?>><?= $name ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                    
                        <!-- Year -->
                        <div class="col">
                          <select name="pey" class="form-select" required>
                            <option value="" disabled <?= empty($pey) ? 'selected' : '' ?>>Year</option>
                            <?php
                              $currentYear = date('Y');
                              for ($y = $currentYear; $y >= 1950; $y--):
                            ?>
                              <option value="<?= $y ?>" <?= ((int)$y === (int)$pey) ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                          </select>
                        </div>
                      </div>
                    </div>


      <div class="col-md-6">
        <label class="form-label">Passport Issuing Country *</label>
        <?php $selectedCountry = $row['passport_issuing_country'] ?? ''; ?>
            <select name="picountry" class="form-select" required>
              <option value="" disabled <?= empty($selectedCountry) ? 'selected' : '' ?>>Please Select</option>
              
              <?php foreach ($countryq as $country): ?>
                <option value="<?= $country['id']; ?>" <?= ($country['name'] === $selectedCountry) ? 'selected' : '' ?>>
                  <?= $country['name']; ?>
                </option>
              <?php endforeach; ?>
            </select>

      </div>
      
      <div class="col-md-6">
        <label class="form-label">Applying From *</label>
       <?php $selectedAfCountry = $row['applying_from'] ?? ''; ?>
            <select name="afcountry" class="form-select" required>
              <option value="" disabled <?= empty($selectedAfCountry) ? 'selected' : '' ?>>Please Select</option>
            
              <?php foreach ($countryq as $country): ?>
                <option value="<?= $country['id']; ?>" <?= ($country['name'] === $selectedAfCountry) ? 'selected' : '' ?>>
                  <?= $country['name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Approximate Travel Date *</label>
        <input name="travel_date" value="<?php echo $row['travel_date']; ?>" type="date" class="form-control" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">Malaysia Exit Date *</label>
        <input name="exit_date" value="<?php echo $row['exit_date']; ?>" type="date" class="form-control" required />
      </div>

      <div class="col-12">
        <label  class="form-label">Present Address *</label>
        <input name="paddress" type="text" value="<?php echo $row['present_address']; ?>" class="form-control" placeholder="ADDRESS LINE" required />
      </div>

      <div class="col-md-4">
        <label  class="form-label">City *</label>
        <input  name="city" type="text" value="<?php echo $row['city']; ?>" class="form-control" required />
      </div>
      <div class="col-md-4">
        <label  class="form-label">PostCode *</label>
        <input name="pcode" type="text" value="<?php echo $row['postcode']; ?>" class="form-control" required />
      </div>
      <div class="col-md-4">
        <label  class="form-label">State *</label>
        <input name="state" type="text" value="<?php echo $row['state']; ?>" class="form-control" required />
      </div>
    </div>

    <div class="text-center mt-4 ">
      <button type="submit" name="update" class="btn btn_primary w-100">
        <i class="bi bi-check2-square"></i> SAVE & PREVIEW
      </button>
    </div>
  </form>
</div>
      </div>

<?php  
           $id=$row['void'];
         }
         
         ?>



      <!-- Left Section progress -->
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
       
        
 
    
    </div>

    <!-- end progress  -->

    </div>
  </div>


<?php include('tam_layout/footer.php'); ?>

