
<?php
include('apm/config.php');
// $invoice = $_GET['invoice'];

$void = $_GET['visitorId'];
$abcd = $_GET['abcd'];

$query = "SELECT * FROM v_order_list  WHERE void = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $void);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$nationality_show1 =  $row['nationality'];
$national_query = mysqli_query($conn, "SELECT name FROM countries WHERE id='$nationality_show1' LIMIT 1 ") or die(mysqli_error($conn));
$row_national_set = mysqli_fetch_assoc($national_query);


$passport_issuing_country_show =  $row['passport_issuing_country'];
$national_query2 = mysqli_query($conn, "SELECT name FROM countries WHERE id='$passport_issuing_country_show' LIMIT 1 ") or die(mysqli_error($conn));
$row_Issuing_Country_set = mysqli_fetch_assoc($national_query2);


$applying_from_show =  $row['applying_from'];
$national_query3 = mysqli_query($conn, "SELECT name FROM countries WHERE id='$applying_from_show' LIMIT 1 ") or die(mysqli_error($conn));
$row_applying_from_set = mysqli_fetch_assoc($national_query3);




?>
<legend><?php echo $row['o_fname']; ?></legend>

<form id="updateVisaForm" method="POST" action="update_visa.php" enctype="multipart/form-data">
    
    <input type="hidden" name="rowselect" value="<?php echo $abcd; ?>">

    <input type="hidden" name="void" value="<?php echo $void; ?>">
    <input type="hidden" name="invoice" value="<?php echo $row['o_invoice']; ?>">

    
    <div class="row">
        <!-- 1. Given Name -->
        <div class="col-md-6">
            <label for="o_fname" class="form-label">Given Name</label>
            <input type="text" class="form-control" id="o_fname" name="o_fname" value="<?php echo $row['o_fname']; ?>" required>
        </div>

        <!-- 2. Surname -->
        <div class="col-md-6">
            <label for="o_lname" class="form-label">Surname</label>
            <input type="text" class="form-control" id="o_lname" name="o_lname" value="<?php echo $row['o_lname']; ?>" required>
        </div>

        <!-- 3. Passport Number -->
        <div class="col-md-6 mt-3">
            <label for="passport_number" class="form-label">Passport Number</label>
            <input type="text" class="form-control" id="passport_number" name="passport_number" value="<?php echo $row['passport_number']; ?>" required>
        </div>


 
                
              
            

        <!-- 4. Nationality -->
        <div class="col-md-6 mt-3">
            <label for="nationality" class="form-label">Nationality</label>
            <select class="form-select" id="nationality" name="nationality" required>
                <?php if($row['nationality'] == 0 ) {   ?>
                    <option value=""> Please Select   </option>
                    
                                    <option value="<?php echo @$row['nationality']; ?>"><?php echo @$row_national_set['name']; ?></option>
                <?php 
    $v_country_query = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
    while ($row_c = mysqli_fetch_assoc($v_country_query)) { ?>
        <option value="<?php echo $row_c['id']; ?>">   
            <?php echo $row_c['name']; ?>  <!-- Assuming the column for country name is 'name' -->
        </option>
    <?php } ?>
                    
                    
                <?php  }else{ ?>
                    
                        <option value="<?php echo @$row['nationality']; ?>"><?php echo @$row_national_set['name']; ?></option>
                <?php 
    $v_country_query = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
    while ($row_c = mysqli_fetch_assoc($v_country_query)) { ?>
        <option value="<?php echo $row_c['id']; ?>">   
            <?php echo $row_c['name']; ?>  <!-- Assuming the column for country name is 'name' -->
        </option>
    <?php } ?>

    
            <?php   } ?>
            
            
            </select>
        </div>

        <!-- 5. Gender -->
          
        <div class="col-md-6 mt-3 ">
            <label for="Gender" class="form-label">Gender</label>
<select class="form-select" id="gender" name="gender" required>
  <option value="" disabled selected>Please Select</option>
  <option value="Male" <?php if (isset($row['gender']) && $row['gender'] === 'Male') echo 'selected'; ?>>Male</option>
  <option value="Female" <?php if (isset($row['gender']) && $row['gender'] === 'Female') echo 'selected'; ?>>Female</option>
</select>
        </div>
        
  <!-- 6. Passport Issue Date -->
        <div class="col-md-6 mt-3">
        <!-- <label class="font-normal">Date Of Brith</label> -->

        <?php   $new_date =$row['dob'];
        list($current_year, $current_month, $current_day) = explode('-', $new_date);

        ?>
<div class="row">  
    <label for="Gender" class="form-label">Date Of Brith</label>
        <div class="col-md-4 col-12">
                <!-- <label for="day" class="form-label">Day:</label> -->
                <select name="day" id="day" class="form-select">
                   <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Day</option>
                          <?php for ($d = 1; $d <= 31; $d++): ?>
                            <option value="<?= $d ?>" <?= ((int)$d === (int)$dobd) ? 'selected' : '' ?>>
                              <?= $d ?>
                            </option>
                          <?php endfor; ?>
                </select>
            </div>

            <!-- Month Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="month" class="form-label">Month:</label> -->
              <select name="month" id="month" class="form-select month-select" >
    
                     <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Month</option>
                    <?php
                    // Month options with names and values
                    $months = [
                        '01' => 'January', '02' => 'February', '03' => 'March',
                        '04' => 'April', '05' => 'May', '06' => 'June',
                        '07' => 'July', '08' => 'August', '09' => 'September',
                        '10' => 'October', '11' => 'November', '12' => 'December'
                    ];

                    foreach ($months as $value => $name) {
                        $selected = ($value == $current_month) ? 'selected' : '';
                        echo "<option value='$value' $selected>$name</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Year Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="year" class="form-label">Year:</label> -->
                <select name="year" id="year" class="form-select">
                     <option value="" disabled >Year</option>
                     <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Year</option>
                    <?php
                    // Generate year options (for example, 2020-2030)
                    for ($i = 1950; $i <= 2035; $i++) {
                        $selected = ($i == $current_year) ? 'selected' : '';
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <style>
    /* Make month dropdown wider on desktop */
    .month-select {
        min-width: 130px;
    }

    /* Full width on mobile */
    @media (max-width: 576px) {
        .month-select {
            width: 100%;
        }
    }
</style>
    <!-- <input type="date" id="dob" name="dob" class="form-control" value="<?php // echo $row['dob']; ?>" > -->
</div>



<div class="col-md-6 mt-3">
        <!-- <label class="font-normal">Date Of Brith</label> -->

        <?php   $new_date2 =$row['passport_issue_date'];
        list($current_year2, $current_month2, $current_day2) = explode('-', $new_date2);

        ?>
<div class="row">  
    <span> Passport Issue Date</span>
        <div class="col-md-4 col-12">
                <!-- <label for="day" class="form-label">Day:</label> -->
                <select name="day2" id="day2" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Day</option>
                    <?php
                  
                    // Loop to generate day options (1 to 31)
                    for ($i = 1; $i <= 31; $i++) {
                        $day_value2 = str_pad($i, 2, '0', STR_PAD_LEFT); // Ensure day is 2 digits
                        $selected2 = ($day_value2 == $current_day2) ? 'selected' : '';
                        echo "<option value='$day_value2' $selected2>$day_value2</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Month Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="month" class="form-label">Month:</label> -->
                    <select name="month" id="month" class="form-select month-select" >
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Month</option>
                    <?php
                    // Month options with names and values
                    $months2 = [
                        '01' => 'January', '02' => 'February', '03' => 'March',
                        '04' => 'April', '05' => 'May', '06' => 'June',
                        '07' => 'July', '08' => 'August', '09' => 'September',
                        '10' => 'October', '11' => 'November', '12' => 'December'
                    ];

                    foreach ($months2 as $value2 => $name2) {
                        $selected2 = ($value2 == $current_month2) ? 'selected' : '';
                        echo "<option value='$value2' $selected2>$name2</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Year Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="year" class="form-label">Year:</label> -->
                <select name="year2" id="year2" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Year</option>
                    <?php
                    // Generate year options (for example, 2020-2030)
                    for ($i = 2020; $i <= 2035; $i++) {
                        $selected2 = ($i == $current_year2) ? 'selected' : '';
                        echo "<option value='$i' $selected2>$i</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
         <style>
    /* Make month dropdown wider on desktop */
    .month-select {
        min-width: 130px;
    }

    /* Full width on mobile */
    @media (max-width: 576px) {
        .month-select {
            width: 100%;
        }
    }
</style>
    <!-- <input type="date" id="dob" name="dob" class="form-control" value="<?php // echo $row['dob']; ?>" > -->
</div>


<div class="col-md-6 mt-3">
        <!-- <label class="font-normal">Date Of Brith</label> -->

        <?php   $new_date3 =$row['passport_expiry_date'];
        list($current_year3, $current_month3, $current_day3) = explode('-', $new_date3);

        ?>
<div class="row">  
    <span> Passport Expiry Date</span>
        <div class="col-md-4 col-12">
                <!-- <label for="day" class="form-label">Day:</label> -->
                <select name="day3" id="day3" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Day</option>
                    <?php
                  
                    // Loop to generate day options (1 to 31)
                    for ($i = 1; $i <= 31; $i++) {
                        $day_value3 = str_pad($i, 2, '0', STR_PAD_LEFT); // Ensure day is 2 digits
                        $selected3 = ($day_value3 == $current_day3) ? 'selected' : '';
                        echo "<option value='$day_value3' $selected3>$day_value3</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Month Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="month" class="form-label">Month:</label> -->
                <select name="month3" id="month3" class="form-select month-select" >
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Month</option>
                    <?php
                    // Month options with names and values
                    $months3 = [
                        '01' => 'January', '02' => 'February', '03' => 'March',
                        '04' => 'April', '05' => 'May', '06' => 'June',
                        '07' => 'July', '08' => 'August', '09' => 'September',
                        '10' => 'October', '11' => 'November', '12' => 'December'
                    ];

                    foreach ($months3 as $value3 => $name3) {
                        $selected3 = ($value3 == $current_month3) ? 'selected' : '';
                        echo "<option value='$value3' $selected3>$name3</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Year Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="year" class="form-label">Year:</label> -->
                <select name="year3" id="year3" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Year</option>
                    <?php
                    // Generate year options (for example, 2020-2030)
                    for ($i = 2020; $i <= 2035; $i++) {
                        $selected3 = ($i == $current_year3) ? 'selected' : '';
                        echo "<option value='$i' $selected3>$i</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
         <style>
    /* Make month dropdown wider on desktop */
    .month-select {
        min-width: 130px;
    }

    /* Full width on mobile */
    @media (max-width: 576px) {
        .month-select {
            width: 100%;
        }
    }
</style>
    <!-- <input type="date" id="dob" name="dob" class="form-control" value="<?php // echo $row['dob']; ?>" > -->
</div>

        <!-- 8. Passport Expiry Date -->
        <!--<div class="col-md-6 mt-3">-->
        <!--    <label for="passport_expiry_date" class="form-label">Passport Expiry Date*</label>-->
        <!--    <input type="date" class="form-control" id="passport_expiry_date" name="passport_expiry_date" 
        value="<?php // echo $row['passport_expiry_date']; ?>" required>-->
        <!--</div>-->

        <!-- 9. Passport Issuing Country -->
        <div class="col-md-6 mt-3">
            <label for="passport_issuing_country" class="form-label">Passport Issuing Country</label>
            
            <select class="form-select" id="passport_issuing_country" name="passport_issuing_country" required>
                <?php if($row['passport_issuing_country'] == 0 ) {   ?>
                    <option value="<?php echo @$row['passport_issuing_country']; ?>"> Please Select   </option>
                    
                                    <option value="<?php echo @$row['passport_issuing_country']; ?>"><?php echo @$row_national_set['name']; ?></option>
                <?php 
    $v_country_query2 = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
    while ($row_c2 = mysqli_fetch_assoc($v_country_query2)) { ?>
        <option value="<?php echo $row_c2['id']; ?>">   
            <?php echo $row_c2['name']; ?>  <!-- Assuming the column for country name is 'name' -->
        </option>
    <?php } ?>
                    
                    
                <?php  }else{ ?>
                    
                        <option value="<?php echo @$row['passport_issuing_country']; ?>"><?php echo @$row_national_set['name']; ?></option>
                <?php 
    $v_country_query2 = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
    while ($row_c2 = mysqli_fetch_assoc($v_country_query2)) { ?>
        <option value="<?php echo $row_c2['id']; ?>">   
            <?php echo $row_c2['name']; ?>  <!-- Assuming the column for country name is 'name' -->
        </option>
    <?php } ?>

    
            <?php   } ?>
            
            
            </select>
            
        
        </div>

        <!-- 10. Applying From -->
        <div class="col-md-6 mt-3">
            <label for="applying_from" class="form-label">Applying From</label>

<select class="form-select" id="applying_from" name="applying_from" required>
                <?php if($row['applying_from'] == 0 ) {   ?>
                    <option value="<?php echo @$row['applying_from']; ?>"> Please Select   </option>
                    
                                    <option value="<?php echo @$row['applying_from']; ?>"><?php echo @$row_national_set['name']; ?></option>
                <?php 
    $v_country_query3 = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
    while ($row_c3 = mysqli_fetch_assoc($v_country_query3)) { ?>
        <option value="<?php echo $row_c3['id']; ?>">   
            <?php echo $row_c3['name']; ?>  <!-- Assuming the column for country name is 'name' -->
        </option>
    <?php } ?>
                    
                    
                <?php  }else{ ?>
                    
                        <option value="<?php echo @$row['applying_from']; ?>"><?php echo @$row_national_set['name']; ?></option>
                <?php 
    $v_country_query3 = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
    while ($row_c3 = mysqli_fetch_assoc($v_country_query3)) { ?>
        <option value="<?php echo $row_c3['id']; ?>">   
            <?php echo $row_c3['name']; ?>  <!-- Assuming the column for country name is 'name' -->
        </option>
    <?php } ?>

    
            <?php   } ?>
            
            
            </select>

        </div>

        <!-- 11. Travel Date -->
    
        <div class="col-md-6 mt-3">
        <!-- <label class="font-normal">Date Of Brith</label> -->

        <?php   $new_date4 =$row['travel_date'];
        list($current_year4, $current_month4, $current_day4) = explode('-', $new_date4);

        ?>
<div class="row">  
    <span> Approx. Malaysia Travel Date </span>
        <div class="col-md-4 col-12">
                <!-- <label for="day" class="form-label">Day:</label> -->
                <select name="day4" id="day4" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Day</option>
                    <?php
                  
                    // Loop to generate day options (1 to 31)
                    for ($i = 1; $i <= 31; $i++) {
                        $day_value4 = str_pad($i, 2, '0', STR_PAD_LEFT); // Ensure day is 2 digits
                        $selected4 = ($day_value4 == $current_day4) ? 'selected' : '';
                        echo "<option value='$day_value4' $selected4>$day_value4</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Month Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="month" class="form-label">Month:</label> -->
                <select name="month4" id="month4" class="form-select month-select" >
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Month</option>
                    <?php
                    // Month options with names and values
                    $months4 = [
                        '01' => 'January', '02' => 'February', '03' => 'March',
                        '04' => 'April', '05' => 'May', '06' => 'June',
                        '07' => 'July', '08' => 'August', '09' => 'September',
                        '10' => 'October', '11' => 'November', '12' => 'December'
                    ];

                    foreach ($months4 as $value4 => $name4) {
                        $selected4 = ($value4 == $current_month4) ? 'selected' : '';
                        echo "<option value='$value4' $selected4>$name4</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Year Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="year" class="form-label">Year:</label> -->
                <select name="year4" id="year4" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Year</option>
                    <?php
                    // Generate year options (for example, 2020-2030)
                    for ($i = 2020; $i <= 2030; $i++) {
                        $selected4 = ($i == $current_year4) ? 'selected' : '';
                        echo "<option value='$i' $selected4>$i</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <style>
    /* Make month dropdown wider on desktop */
    .month-select {
        min-width: 130px;
    }

    /* Full width on mobile */
    @media (max-width: 576px) {
        .month-select {
            width: 100%;
        }
    }
</style>
    <!-- <input type="date" id="dob" name="dob" class="form-control" value="<?php // echo $row['dob']; ?>" > -->
</div>



        <div class="col-md-6 mt-3">
        <!-- <label class="font-normal">Date Of Brith</label> -->
        <?php   
             $new_date5 =$row['exit_date'];
             list($current_year5, $current_month5, $current_day5) = explode('-', $new_date5);

        ?>
<div class="row">  
    <span> Malaysia Exit Date </span>
        <div class="col-md-4 col-12">
                <!-- <label for="day" class="form-label">Day:</label> -->
                <select name="day5" id="day5" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Day</option>
                    <?php
                  
                    // Loop to generate day options (1 to 31)
                    for ($i = 1; $i <= 31; $i++) {
                        $day_value5 = str_pad($i, 2, '0', STR_PAD_LEFT); // Ensure day is 2 digits
                        $selected5 = ($day_value5 == $current_day5) ? 'selected' : '';
                        echo "<option value='$day_value5' $selected5>$day_value5</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Month Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="month" class="form-label">Month:</label> -->
                <select name="month5" id="month5" class="form-select month-select" >
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Month</option>
                    <?php
                    // Month options with names and values
                    $months5 = [
                        '01' => 'January', '02' => 'February', '03' => 'March',
                        '04' => 'April', '05' => 'May', '06' => 'June',
                        '07' => 'July', '08' => 'August', '09' => 'September',
                        '10' => 'October', '11' => 'November', '12' => 'December'
                    ];

                    foreach ($months5 as $value5 => $name5) {
                        $selected5 = ($value5 == $current_month5) ? 'selected' : '';
                        echo "<option value='$value5' $selected5>$name5</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Year Column -->
            <div class="col-md-4 col-12">
                <!-- <label for="year" class="form-label">Year:</label> -->
                <select name="year5" id="year5" class="form-select">
                    <option value="" disabled <?= empty($dobd) ? 'selected' : '' ?>>Year</option>
                    <?php
                    // Generate year options (for example, 2020-2030)
                        for ($i = 2020; $i <= 2030; $i++) {
                            $selected5 = ($i == $current_year5) ? 'selected' : '';
                            echo "<option value='$i' $selected5>$i</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <style>
    /* Make month dropdown wider on desktop */
    .month-select {
        min-width: 130px;
    }

    /* Full width on mobile */
    @media (max-width: 576px) {
        .month-select {
            width: 100%;
        }
    }
</style>
    <!-- <input type="date" id="dob" name="dob" class="form-control" value="<?php // echo $row['dob']; ?>" > -->
</div>
        

        <!-- 12. Exit Date -->
        <!--<div class="col-md-6 mt-3">-->
        <!--    <label for="exit_date" class="form-label">Malaysia Exit Date*</label>-->
        <!--    <input type="date" class="form-control" id="exit_date" name="exit_date" value="<?php // echo $row['exit_date']; ?>" required>-->
        <!--</div>-->

        <!-- 13. Present Address -->
        <div class="col-md-6 mt-3">
            <label for="present_address" class="form-label">Present Address</label>
            
            <input type="text" class="form-control" id="present_address" name="present_address" value="<?php echo $row['present_address']; ?>" required>
        
        </div>

        <!-- 14. Postcode -->
        <div class="col-md-6 mt-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $row['postcode']; ?>" required>
        </div>

        <!-- 15. City -->
        <div class="col-md-6 mt-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo $row['city']; ?>" required>
        </div>

        <!-- 16. State -->
        <div class="col-md-6 mt-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" name="state" value="<?php echo $row['state']; ?>" required>
        </div>


        <div class="row">
        <div class="col-md-12 text-center" style="margin-top: 40px;">
            <button type="submit" id="submitBtn" class="btn btn_primary w-100"> Save And Continue  </button>
        </div>
        </div>




    </div>
</form>




<script>
    function redirectToModalPage(visitorId) {
        // Redirect to another page with visitorId as a URL parameter
        window.location.href = "showModal.php?visitorId=" + <?php echo htmlspecialchars($void, ENT_QUOTES, 'UTF-8'); ?> + "&abc=" + abc;
    }
</script>
<script>
$(document).ready(function() {
    // Listen to form submission
    $('#updateVisaForm').on('submit', function(e) {
        e.preventDefault();  // Prevent the default form submission
        
        // Show loading indicator
        $('#loadingIndicator').show();
        $('#submitBtn').prop('disabled', true);  // Disable the submit button to prevent multiple clicks

        // Initialize FormData object to hold form data
        var formData = new FormData(this);
        
        // Send form data using AJAX
        $.ajax({
            url: 'update_visa.php',  // The URL remains the same for AJAX request
            type: 'POST',
            data: formData,
            contentType: false,  // Don't set content type to avoid issues with file uploads
            processData: false,  // Don't process data
            success: function(response) {
                // Hide the loading indicator
                $('#loadingIndicator').hide();
                $('#submitBtn').prop('disabled', false);  // Re-enable the submit button
                
                // Parse the response (if it's a JSON response)
                var jsonResponse = JSON.parse(response);
                
                if (jsonResponse.success) {
                    // Show success message using Toastr
                    toastr.success('Visa updated successfully!');
                    
                    // Optionally, redirect or reset the form after success
                    // window.location.href = 'success_page.php';
                    // $('#updateVisaForm')[0].reset();  // Reset form
                } else {
                    // Show error message if the submission fails
                    toastr.error(jsonResponse.message || 'An error occurred.');
                }
            },
            error: function(xhr, status, error) {
                // Hide loading indicator on error
                $('#loadingIndicator').hide();
                $('#submitBtn').prop('disabled', false);  // Re-enable the submit button
                
                // Show error message
                toastr.error('An error occurred while submitting the form.');
            }
        });
    });
});

</script>
