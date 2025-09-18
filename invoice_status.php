<?php include('tam_layout/header.php'); ?>
<?php
include('apm/config.php');
// Ensure that the invoice ID is provided
if (isset($_POST['invoice']) && !empty($_POST['invoice'])) {
     $new_invoice = $_POST['invoice'];
   $accounr_query22 = "SELECT * FROM `visa_account` WHERE `invoice` = '$new_invoice' LIMIT 1";
   $result_acccc = mysqli_query($conn, $accounr_query22); // Execute the query
   $accout_row = mysqli_fetch_assoc($result_acccc); // Fetch the row as an associative array
   

   $v_order_list_query = "SELECT * FROM `v_order_list` WHERE  `o_invoice` = '$new_invoice'";
            $result_v_order_list = mysqli_query($conn, $v_order_list_query);


            $row_count = mysqli_num_rows($result_v_order_list);


}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <h3> Applicant Information</h3>
        <div id="card1" class="card four col">
      <h3 class="name">Ref: <?php  echo $_POST['invoice']; ?></h3>

      <div class="options">
        <ul>
          <li><span class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></span> <?php  echo $accout_row['v_datetime'];?>    </li>
          <li><span class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></span> <?php  echo $accout_row['user_email'];?></li>
        </ul>
      </div>
    </div>
       
        </div>
        <div class="col-md-8">

<!--  -->

<table class="table table-responsive-sm table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Visitor</th>
      <th scope="col">Status</th>
      <th scope="col">File</th>
    </tr>
  </thead>
  <tbody>
  <?php 
// Check if any rows exist
if ($row_count > 0) {
    // Loop through the result set
    $i=0;
    while ($row = mysqli_fetch_assoc($result_v_order_list)) {?>
    <tr>
      <th scope="row"><?php echo ++$i;?>  </th>
      <td>  <?php echo $row['o_fname']; ?></td>
      <td>
        
      
      <?php
// Pending, Approved, Reject, Unpaid,

     $set_status =  $row['status'];
     if($set_status==0){
         $current_status = 'Pendding ';
     }elseif($set_status==1){
          $current_status = 'Paid Application'; 
     }elseif($set_status==2){
      $current_status = 'Paid Application'; 
     } elseif($set_status==3){
          $current_status = 'Pending Payment Application';
     }elseif($set_status==4){
          $current_status = 'Approved Application';
      }elseif($set_status==5){
          $current_status = 'Processing Application';
      }elseif($set_status==6){
          $current_status = 'Further Processing Application';
      }elseif($set_status==7){
        $current_status = 'On Hold Application';
      }elseif($set_status==8){
        $current_status = 'Refund Application';
      }elseif($set_status==9){          
        $current_status = 'Rejected Application';           
      }

      echo  $current_status;

      ?>
    
    
    
    </td>
      <td>
    <?php 
  if($set_status==4){
    $file_path = 'apm/adman/assets/uploads/complete/' . $row['complete_visa_upload'];
    if (file_exists($file_path)) { 
      echo '<a href="' . $file_path . '" download="' . $row['complete_visa_upload'] . '">  Download PDF</a>';
    } 


  }else{
    echo 'File not available';
  }





    ?>
</td>

    </tr>
    <?php } }?>

  </tbody>
</table>



    </div>



    </div>
</div>

<?php include('tam_layout/footer.php'); ?>

<style>
 .item {
  display: flex;
  max-width: 1000px;
  margin: 0 auto;
  
  .image {
    padding: 1em 2em;
    
    > div {
      position: relative;
      text-align: center;
      font-size: 0.8em;

      &::after {
        content: '';
        width: 100%;
        height: 0;
        border-bottom: 1px solid #232b50;
        position: absolute;
        top: 2.75em;
        left: 2.5em;
        z-index: -1;
      }
    }
    
    img {
      border-radius: 50%;
      height: 5em;
      border: 0.35em solid #5ed3bf;
    }
    span {
      display: block;
      clear: both;
      padding: 0.25em 0;
      margin: 0.5em 0;
      background: #3b4262;
    }
  }
  
  .details {
    position: relative;
    flex-grow: 1;

    > div {
      border: 1px solid #232b50;
      border-radius: 0.5em;
      padding: 1.5em;
      margin: 1em 0;
      
      h1 {
        color: #5ed3bf;
        font-size: 1.4em;
        margin: 0;
        padding: 0 0 0.5em 0;
        letter-spacing: 0.1em;
      }
      
      p {
        margin: 0;
        padding: 0;
        line-height: 150%;
      }
    }

    &::before {
      content: '';
      width: 0;
      height: 100%;
      border-left: 1px solid #232b50;
      position: absolute;
      top: 0;
      left: -4.35em;
      z-index: -1;
    }
    
  }
  
}
#card1{
	text-align: center;
	color: #2c3e50;
	padding: 15px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}



#card1 .info .four{
	text-align: center;
	border-right: 1px solid #2c3e50;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

#card1 .info .four:last-of-type{
	border-right: none;
}

#card1 .info .four .number{
	display: block;
	font-size: 20px;
	padding: 3px 0;
	font-weight: 700;
}

#card1 .options{
	margin-top: 30px;
	text-align: left;
}

#card1 .options ul{
	list-style-type: none;
	padding: 0;
	margin: 0;
}

#card1 .options ul .icon{
	display: inline-block;
	width: 30px;
	height: 30px;
	background-color: #3498db;
	border-radius: 100%;
	margin-right: 8px;
	vertical-align: middle;
	color: #fff;
	line-height: 30px;
	text-align: center;
}

#card1 .options ul li{
	margin: 12px 0;
}
</style>