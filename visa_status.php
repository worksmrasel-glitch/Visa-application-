<?php include('tam_layout/header.php'); ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">

        
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center"><strong> Malaysia eVisa Status Check Online by Passport / Reference
                    </strong></h3>

                <hr>

                    <!-- Step 1: Personal Information -->
                        <form id="step1Form" method="POST" action="invoice_status.php">
                            <div class="row g-3">
                            <div class="col-md-2"> </div>

                            <div class="col-md-8">
    <input type="text" class="search" id="search-inp" value="<?php echo isset($_GET['reference']) ? $_GET['reference'] : ''; ?>
" name="invoice" placeholder="Search...">

    <button class="search-btn" type="submit"  id="search-inp-btn">&#x027A4;</button>

</div>


<div class="col-12 text-dark">
 <h4>  Checking Your Malaysia Visa Status  </h4>  
<p>  If you’ve applied for a Malaysia eVisa, it’s very important to regularly check your visa status. Staying up to date can help avoid any issues or delays.</p>
 <h4>   How Can I Check My Malaysia eVisa Status Online? </h4>
<p> No worries, checking your visa status online is quick and simple. Once you’ve submitted your eVisa application, you can check your visa status using our provided reference number:</p>
 <ul> <li>   	Check by Reference Number: </li>  </ul> 
<p> If you have your visa reference number, you can enter it directly on the status check page. This is especially useful if you applied as a group. The reference number can give you a full update on the group.
</p>
 <h4> Common Issues & Helpful Tips </h4>
<p> Sometimes things don’t go as smoothly as expected but don’t worry, here are a few things we need to know, </p>

 <p>  
 <strong> "No Record Found" Error  </strong>  </p>
<p>
If you get a "No Record Found" message, it could be due to, Incorrect passport or reference number or Your application not being processed yet. </p>
 <h6>What you can do </h6>
Double-check the details you entered. Wait a couple of days and try again.
Still not working? Reach out to the immigration department or your visa service provider. Be sure to include your passport number and personal details.
 <h4 class="mt-3"> Technical Problems  </h4>
If the site isn’t working properly, try these,
Clear your browser’s cache and cookies. Refresh the page and try again. Try using a different browser or device.
If the issue is still going on then don’t hesitate to contact our support center or send a message using our live chat platform. We are always happy to guide you, to get your visa through our agency  without any technical difficulties. Feel free to ask anything you need to know with us. Thank you 

</div>

                            </div>
                            </div>
                        </form>



         

                </div>
            </div>
        </div>

        <!-- Right Sidebar: Display Data -->
    </div>
</div>

<?php include('tam_layout/footer.php'); ?>

<style>
    
.search{
    box-shadow:0px 0px 20px 1px #ffffff ;
    border: 0.5;
    border-radius: 30px 0 0 30px;
    padding: 0 10px 0 10px;
    text-align: center;
    color: black;
    height: 50px;
    width: 500px;
    font-size: 25px;
    font-weight: 1000;
}
.search::selection{
background-color: red;
color: white;
}
.search:focus{
border:  0.5;
outline: 0;
}
.search:hover{
cursor: text;
}





.search-btn{
    transition: 0.2s ease-in-out;
    box-shadow:0px 0px 20px 1px #080853 ;
    border: 0;
    border-radius: 0 30px 30px 0;
    padding: 0 10px 0 10px;
    text-align: center;
    color: whitesmoke;
    position: relative;
    background-color: #080853;
    height: 50px;
    width: 100px;
    font-size: 25px;
    font-weight: 1000;
    align-items: center;
    justify-content: center;
}
.search-btn:hover{
transition: 0.2s ease-in-out;
background-color: green;
box-shadow:0px 0px 20px 1px green ;
font-size: 30px;
font-weight: 800;
cursor: pointer;
}
</style>