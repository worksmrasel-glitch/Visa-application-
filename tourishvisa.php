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
            <h3 class="mb-3">Tourist eVISA for Malaysia</h3>
            <hr />
            <p class="text-muted">
              Let's start your application with basic information. Next page you
              have to provide your passport data page details for make the
              application complete.
            </p>
          </center>
          
              
          <div class="m-5"></div>

          <section class="py-5 bg-light">
            <div class="container">
              <div class="text-center mb-5">
                <h2 class="elementor-heading-title elementor-size-default">Requirements for Tourist eVisa and Online Application Process</h2>
The eVisa Malaysia allows international travelers to apply for visas online. Tourists no longer need to visit Malaysian embassies or consulates in person. 

This change makes the visa process quicker and simpler. Travelers can focus more on planning their trips instead of dealing with paperwork.

Citizens of 36 countries need an eVisa for a single trip to Malaysia for tourism. The system allows tourists to enjoy without hassle.

Who is Eligible to Apply for Malaysia Tourist eVisa?
Citizens of the following nationalities can apply for a tourist eVisa:
                </h2>
                <div class="elementor-element elementor-element-33f0510 e-con-full e-flex e-con e-child" data-id="33f0510" data-element_type="container" data-settings="{"&quot;background_background&quot;:&quot;classic&quot";}" >
                
                <p class="text-muted">
                  Completing the eVisa form takes just a few minutes. Here's how
                  to apply step by step.
                </p>
              </div>

              <div class="row g-4">

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
