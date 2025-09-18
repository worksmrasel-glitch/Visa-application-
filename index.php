<?php

include('tam_layout/header.php'); 

function generateInvoiceNumber() {
    $prefix = "eMV";
    $date = date("dmy");
    $invoiceNumber = rand(100, 999);
    $invoice = "$prefix$date$invoiceNumber";
    return $invoice;
}
?>
<style>
  .bg-default {
    background: #f2f2f2;
}

</style>

<!-- Blue Banner -->
    <div class="w-100 position-relative sidebar-header-logo" style="height: 500px">
      <div class="h-100 d-flex justify-content-center align-items-center text-white text-center">
          
      </div>
    </div>
<!-- Blue Banner end-->    







   <div class="container" style="margin-top: -450px; z-index: 10; position: relative">
      <div class="main-card row g-0">
        <!-- Right Section (Form) -->
        <div class="right-section col-md-12 col-lg-8 order-1 order-lg-2">
          <center>
            <img
              src="assets/malaysia-travel-evisa.webp"
              alt="Malaysia eVisa"
              class="img-fluid mb-4"
            />
            <h3 class="mb-3">Malaysia eVisa Online Application</h3>
            <hr />
            <p class="text-muted">
              Let's start your application with basic information. Next page you
              have to provide your passport data page details for make the
              application complete.
            </p>
          </center>
          
          
          
          
          
          
          <form id="step1Form" method="POST" action="ac_db.php">
                            <input type="hidden" readonly='true' name="invoice" value="<?php echo $invoiceNumber = generateInvoiceNumber();?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="Citzen_Of" class="form-label text-dark">1. I'm a Citizen of  *</label>
                                    <select name="Citzen_Of" id="Citzen_Of" class="form-control form-control-md" required>
                                    <option value=""> Please Select </option>
                                        
                                        <?php 
                                        $v_country_query = mysqli_query($conn, "SELECT * FROM `countries` WHERE status=1");
                                        while ($row_c = mysqli_fetch_assoc($v_country_query)) { ?>
                                            <option value="<?php echo $row_c['id']; ?>">   
                                                <?php echo $row_c['name']; ?>  <!-- Assuming the column for country name is 'name' -->
                                            </option>
                                        <?php } ?>
                                    </select>

                                </div>

                                <div class="col-md-6">
                                    <label for="travel_for" class="form-label text-dark"> 2. Travelling as   *</label>
                                    <select name="travel_for" id="travel_for" class="form-control form-control-md" required>
                                    <option value="">Please Select</option>
                                        <option value="1">Tourist eVisa</option>
                                        <option value="2">Student eVisa</option>
                                        <option value="3">Medical eVisa</option>
                                        <option value="4">Expatriate eVisa</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Service_type" class="form-label text-dark"> 3. E-Visa Type     *</label>
                                    <select name="Service_type" id="Service_type" class="form-control form-control-md" required>
                                        <option value="">Please Select</option>
                                        <option value="1">Single Entry Visa ( SEV )</option>
                                        <option value="2">Multiple Entry Visa (MEV )</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="Request_type" class="form-label text-dark">  4. Request for     *</label>
                                    <select name="Request_type" id="Request_type" class="form-control form-control-md" required>
                                        <option value="">Please Select</option>
                                       
                                    <?php 
                                        $v_service_query = mysqli_query($conn, "SELECT * FROM `visa_service` WHERE service_status=1");
                                        while ($row_s = mysqli_fetch_assoc($v_service_query)) { ?>
                                            <option value="<?php echo $row_s['v_sid']; ?>">   
                                                <?php echo $row_s['service_name']; ?>  <!-- Assuming the column for country name is 'name' -->
                                            </option>
                                        <?php } ?>
                                                              
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="visitor_count" class="form-label text-dark"> 5. No. of Visitors    *</label>
                                    <select name="visitor_count" id="visitor_count" class="form-control form-control-md" required>
                                        <option value="">Please Select</option>
                                        <option value="1">1 Visitor</option>
                                          <?php for ($i = 2; $i <= 30; $i++) { ?>
                                          <option value="<?php echo $i; ?>"><?php echo $i; ?> Visitors</option>
                                          <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="user_email" class="form-label text-dark">6. Contact Email  *</label>
                                    <input type="email" class="form-control form-control-md"  id="user_email" name="user_email" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="full_name" class="form-label text-dark"> 7. Full Name                                    *</label>
                                    <input type="text" class="form-control form-control-md"  id="full_name" name="full_name" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="Passport" class="form-label text-dark">8. Passport   * </label>
                                    <input type="text" class="form-control form-control-md" id="Passport" name="Passport" placeholder="Enter Passport" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="phone_number" class="form-label text-dark"> 9. Phone Number</label>
                                    <input type="text" class="form-control form-control-md" id="phone_number" name="phone_number" required>
                                </div>

                                </div>
                                <div class="row g-3">
                                <div class="col-md-6 col-sm-12 mt-5">
                                    <div class="tacbox">
                                        <input id="checkbox" type="checkbox"  name="checkboxv" required="true" />
                                        <label for="checkbox text-dark"> I agree to these <a href="https://emalaysiavisa.com/terms-and-conditions/">Terms and Conditions</a>.</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 mt-5">
                                    <button type="submit" name="submit" id="registration-validity" class="btn btn_primary w-100">
                                      
                                        CONTINUE TO APPLY  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        

          <div class="m-5"></div>

          <section class="py-5 bg-light">
            <div class="container">
              <div class="text-center mb-5">
                <h2 class="fw-bold">
                  How Do I Fill Out the Malaysia eVisa Application Form?
                </h2>
                <p class="text-muted">
                  Completing the eVisa form takes just a few minutes. Here's how
                  to apply step by step.
                </p>
              </div>

              <div class="row g-4">
                <!-- Step 1 -->
                <div class="col-md-6">
                  <div class="p-4 bg-white shadow rounded h-100">
                    <h5 class="fw-bold">1. Personal Information</h5>
                    <p>
                      Select nationality and purpose of travel, choose visa
                      type, indicate number of travelers, and provide email,
                      phone, and accommodation address.
                    </p>
                  </div>
                </div>

                <!-- Step 2 -->
                <div class="col-md-6">
                  <div class="p-4 bg-white shadow rounded h-100">
                    <h5 class="fw-bold">2. Passport Details</h5>
                    <p>
                      Enter passport number, issue/expiry dates, and country of
                      issue. Ensure your passport is valid for at least 6 months
                      from your arrival date.
                    </p>
                  </div>
                </div>

                <!-- Step 3 -->
                <div class="col-md-6">
                  <div class="p-4 bg-white shadow rounded h-100">
                    <h5 class="fw-bold">3. Documents Attachment</h5>
                    <p>
                      Upload passport biodata page, photo, bank statement,
                      flight ticket, proof of accommodation, and any other
                      required documents.
                    </p>
                  </div>
                </div>

                <!-- Step 4 -->
                <div class="col-md-6">
                  <div class="p-4 bg-white shadow rounded h-100">
                    <h5 class="fw-bold">4. Travel and Accommodation Details</h5>
                    <p>
                      Enter arrival and return dates, travel reason, and
                      accommodation information including hotel name, address,
                      and contact number.
                    </p>
                  </div>
                </div>

                <!-- Step 5 -->
                <div class="col-12">
                  <div class="p-4 bg-white shadow rounded">
                    <h5 class="fw-bold">5. Submit the Application</h5>
                    <p>
                      Review all entries and ensure documents are uploaded. Once
                      submitted, you’ll receive a confirmation of your
                      application.
                    </p>
                  </div>
                </div>

                <div class="alert-box my-4 p-4">
                  <p class="fw-bold mb-2">Nationality Not Listed</p>
                  <p class="fst-italic text-secondary mb-0">
                    If your nationality is not listed, you will need to contact
                    a Malaysian embassy or the Department of Immigration of
                    Malaysia to obtain your visa.
                  </p>
                </div>
              </div>
            </div>
          </section>
        </div>

        <!-- Left Section (Why Choose Us) -->
        <div class="left-section col-md-8 col-lg-4 order-2 order-lg-1">
          <div>
            <h5 class="mb-3 p-3 btn_default">
              <i class="fa-lg fab fa-telegram me-1"></i> WHY CHOOSE US?
            </h5>
            <ul class="list-unstyled">
              <li>
                <i class="far fa-check-circle me-2 text-success"></i> Assisting
                in filling up the form correctly.
              </li>
              <li>
                <i class="far fa-check-circle me-2 text-success"></i> Sending
                details to email within 15 minutes.
              </li>
              <li>
                <i class="far fa-check-circle me-2 text-success"></i> Sending
                the eVisa in PDF format by email.
              </li>
              <li>
                <i class="far fa-check-circle me-2 text-success"></i> 24/7 email
                assistance.
              </li>
              <li>
                <i class="far fa-check-circle me-2 text-success"></i>
                Notification of progress.
              </li>
              <li>
                <i class="far fa-check-circle me-2 text-success"></i> Simple and
                intuitive interface.
              </li>
            </ul>
          </div>

          <div class="m-5"></div>

          <h5>Malaysia eVisa Photo Guidelines</h5>
          <center><p>View Photo Guidelines</p></center>
          <hr />
          <a href="assets/img/card1.webp">
            <img
              src="assets/img/card1.webp"
              alt="Photo Guidelines"
              class="img-fluid mb-3"
            />
          </a>

          <div class="m-3"></div>

          <h5>Malaysia eVisa Passport Specification</h5>
          <center><p>Passport Specification</p></center>
          <hr />
          <a href="assets/img/card2.webp">
            <img
              src="assets/img/card2.webp"
              alt="Photo Guidelines"
              class="img-fluid mb-3"
            />
          </a>

          <div class="m-3"></div>

          <h5>Malaysia eVisa Passport Specification</h5>
          <center><p>Passport Specification</p></center>
          <hr />
          <a href="assets/img/malaysia-evisa-malaysia-sample-copy.webp">
            <img
              src="assets/img/malaysia-evisa-malaysia-sample-copy.webp"
              alt="Photo Guidelines"
              class="img-fluid mb-3"
            />
          </a>
        </div>
      </div>
    </div>








<?php include('tam_layout/footer.php'); ?>

