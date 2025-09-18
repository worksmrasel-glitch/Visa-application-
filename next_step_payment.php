<?php
include('tam_layout/header.php');

if (isset($_GET['invoice'])) {
    $user_token = htmlspecialchars($_GET['invoice']);
}
else{
    $user_token = "";
}

?>

<style>
      .header {
        text-align: center;
        margin-bottom: 1.25rem;
      }

      .header h1 {
        font-size: 1.5rem;
        color: #333;
        font-weight: 600;
      }

      .header .summary {
        color: #f39c12;
      }

      .reference-info {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 30px;
        text-align: center;
        font-size: 0.9rem;
        color: #666;
      }

      .reference-number {
        font-weight: bold;
        color: #333;
      }

      .service-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
      }
      .service-card {
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        background-color: #fff;
        z-index: 0;
      }

      .service-card::before {
        transform: rotate(25deg);
        transition: all 0.7s ease-in-out;
        z-index: -1;
      }

      .service-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        border-color: #00aaff;
      }

      .service-card.general {
        background: white;
      }

      .service-card.urgent {
        background: #2c5aa0;
        color: white;
        border-color: #2c5aa0;
      }

      .service-card.urgent::before {
        content: "SELECTED";
        position: absolute;
        top: 10px;
        left: -28px;
        background: #f39c12;
        color: white;
        padding: 5px 30px;
        font-size: 0.8rem;
        font-weight: bold;
        transform: rotate(-45deg);
      }

      .service-card.urgent .checkmark {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 25px;
        height: 25px;
        background: #46f64e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .service-card.urgent .checkmark::after {
        content: "✓";
        color: green;
        font-weight: bold;
        font-size: 14px;
      }

      .service-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 15px;
      }

      .service-details {
        margin-bottom: 6px;
        font-size: 0.9rem;
      }

      .service-price {
        font-size: 1.8rem;
        font-weight: bold;
        color: #f39c12;
      }

      .service-card.urgent .service-price {
        color: white;
      }

      .details-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        font-size: 0.9rem;
      }

      .details-table tr {
        border-bottom: 1px solid #eee;
        font-size: 1rem;
      }

      .details-table td {
        padding: 10px 8px;
        vertical-align: middle;
      }

      .details-table td:first-child {
        color: #666;
        width: 40%;
      }

      .details-table td:last-child {
        text-align: right;
        font-weight: 500;
      }

      .grand-total {
        background-color: #f0f0f0;
        font-weight: bold;
      }

      .payment-status {
        display: inline-block;
        background: #6c757d;
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
      }

      .payment-section {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        text-align: left;
      }

      .stripe-logo {
        color: #2c5aa0;
        font-weight: bold;
        font-style: italic;
        margin-bottom: 10px;
      }

      .checkout-btn {
        width: 100%;
        background: #f1c40f;
        color: #333;
        border: none;
        padding: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 20px;
      }

      .checkout-btn:hover {
        background: #f39c12;
        color: white;
      }

      .currency-option {
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: flex-end;
      }

      .radio-btn {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #2c5aa0;
        position: relative;
      }

      .radio-btn::after {
        content: "";
        position: absolute;
        top: 3px;
        left: 3px;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: white;
      }

      @media (max-width: 768px) {
        .header h1 {
          font-size: 1.15rem;
          color: #333;
          font-weight: 600;
        }
        .right-section {
          padding: 0;
        }
        .service-cards {
          grid-template-columns: 1fr;
        }

        .details-table td {
          padding: 4px 0px;
        }

        .container {
          padding: 20px;
        }

        .details-table td:first-child {
          width: 50%;
        }
      }
    </style>
 

    <!-- Blue Banner -->
    <div class="w-100 position-relative sidebar-header-logo" style="height: 500px">
      <div
        class="h-100 d-flex justify-content-center align-items-center text-white text-center"
      ></div>
    </div>

    <div
      class="container"
      style="margin-top: -450px; z-index: 10; position: relative"
    >
      <div class="main-card row g-0">




        
        
            <!-- Right Section (Form) -->
            <div class="right-section col-md-12 col-lg-8 order-1 order-lg-2">
              <div class="container my-0 my-lg-5 p-0 p-lg-4 bg-white shadow-sm border rounded">
                <form method="post" action="payment/checkout.php" id="paymentForm">
                  <div class="container">
                    <div class="header">
                      <h1>APPLICATION - <span class="summary">SUMMARY</span></h1>
                    </div>
                    
 
        <input type="hidden" name="uid" id="hiddenUid" value="<?php echo $user_token; ?>">
            
            
                    <div class="reference-info">
                      Your Application is register under Reference Number "
                      <span class="reference-number"><?php echo $user_token; ?></span>
                      " - Make sure you note that reference as you will be ask to
                      give it for all subsequent and steps (Like : Check Visa Status,
                      Print Visa and Further Verification).
                    </div>
            
                    <div class="service-cards">
                      <div class="service-card general" id="generalService" onclick="selectService('general')">
                        <div class="checkmark"></div>
                        <div class="service-title">General Service</div>
                        <div class="service-details">
                          Receive Your Visa Within ⏱ <strong>4 working days</strong>
                        </div>
                        <div class="service-price"><span class="amount">296</span> <span class="currency">MYR</span></div>
                      </div>
            
                      <div class="service-card urgent" id="urgentService" onclick="selectService('urgent')">
                        <div class="checkmark"></div>
                        <div class="service-title">Urgent Service</div>
                        <div class="service-details">
                          Receive Your Visa Within ⏱ <strong>2 Working Days</strong>
                        </div>
                        <div class="service-price"><span class="amount">396</span> <span class="currency">MYR</span></div>
                      </div>
                    </div>
            
                    <input type="hidden" name="service_type" id="serviceType" value="urgent">
                    <input type="hidden" name="price" id="servicePrice" value="396">
            
                    <table class="details-table">
                      <tr>
                        <td>Reference Number</td>
                        <td>:</td>
                        <td><?php echo $user_token; ?></td>
                      </tr>
                      <tr>
                        <td>Currency Type</td>
                        <td>:</td>
                        <td>
                          <div class="currency-option">
                            <label class="radio-label">
                              <input type="radio" name="currency" value="MYR" onchange="updateCurrency('MYR')" />
                              <span class="custom-radio"></span> MYR
                            </label>
                            <label class="radio-label">
                              <input type="radio" name="currency" value="USD" checked onchange="updateCurrency('USD')" />
                              <span class="custom-radio"></span> USD
                            </label>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Requested Service</td>
                        <td>:</td>
                        <td id="requested-service">Urgent Service - 2 Working Days</td>
                      </tr>
                      <tr>
                        <td>Number of Visitors</td>
                        <td>:</td>
                        <td>1 Person(s)</td>
                      </tr>
                      <tr>
                        <td>Transaction Charge</td>
                        <td>:</td>
                        <td>(4%) ℹ️ <span id="transaction-charge">15.84</span> <span class="currency">MYR</span></td>
                      </tr>
                      <tr>
                        <td>Service Fees (With Vat)</td>
                        <td>:</td>
                        <td><span id="service-fee">396</span> <span class="currency">MYR</span> / Per Applicant</td>
                      </tr>
                      <tr>
                        <td>Total Fees</td>
                        <td>:</td>
                        <td><span id="total-fees">411.84</span> <span class="currency">MYR</span> / Per Applicant</td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>:</td>
                        <td><span id="total-amount">411.84</span> <span class="currency">MYR</span></td>
                      </tr>
                      <tr class="grand-total">
                        <td><strong>Grand Total</strong></td>
                        <td>:</td>
                        <td><strong><span id="grand-total">411.84</span> <span class="currency">MYR</span></strong></td>
                      </tr>
                      <tr>
                        <td>Payment Status</td>
                        <td>:</td>
                        <td><span class="payment-status">Not Paid</span></td>
                      </tr>
                      <tr>
                        <td>Pay With :</td>
                        <td>:</td>
                        <td>
                          <div class="payment-section">
                            <div class="stripe-logo">Pay with stripe</div>
                            <img
                              src="assets/img/payment.stripe"
                              alt="Stripe Logo"
                              class="mb-2"
                              style="max-width: 100%"
                            />
                          </div>
                        </td>
                      </tr>
                    </table>
            
                    <button type="submit" class="checkout-btn">Checkout</button>
                  </div>
                </form>
              </div>
            </div>
            
            <script>
            // Fixed exchange rate (you can update this periodically)
            const EXCHANGE_RATE = 0.21; // 1 MYR = 0.21 USD
            
            // Service configurations
            const SERVICES = {
              general: {
                price: 296,
                description: "General Service - 4 Working Days",
                action: "payment/checkout.php?invoice=<?php echo $user_token; ?>"
              },
              urgent: {
                price: 396,
                description: "Urgent Service - 2 Working Days",
                action: "payment/checkout.php?invoice=<?php echo $user_token; ?>"
              }
            };
            
            // Current selections
            let currentService = 'urgent';
            let currentCurrency = 'USD';
            
            // Initialize the page
            document.addEventListener('DOMContentLoaded', function() {
              // Set urgent service as selected by default
              selectService('urgent');
              updateFormAction();
            });
            
            // Select service type
            function selectService(service) {
              currentService = service;
              
              // Update UI
              document.querySelectorAll('.service-card').forEach(card => {
                card.classList.remove('selected');
              });
              document.getElementById(service + 'Service').classList.add('selected');
              
              // Update hidden fields
              document.getElementById('serviceType').value = service;
              document.getElementById('servicePrice').value = SERVICES[service].price;
              
              // Update service description
              document.getElementById('requested-service').textContent = SERVICES[service].description;
              
              // Update form action
              updateFormAction();
              
              // Update all amounts
              updateAmounts();
            }
            
            // Update currency display
            function updateCurrency(currency) {
              currentCurrency = currency;
              updateAmounts();
            }
            
            // Update all amounts based on service and currency
            function updateAmounts() {
              const basePrice = SERVICES[currentService].price;
              const transactionCharge = basePrice * 0.04;
              const totalAmount = basePrice + transactionCharge;
              
              // Convert amounts if USD is selected
              const conversionRate = currentCurrency === 'USD' ? EXCHANGE_RATE : 1;
              const currencySymbol = currentCurrency === 'USD' ? 'USD' : 'MYR';
              
              // Update service cards
              document.querySelectorAll('.service-card .amount').forEach(el => {
                const serviceType = el.closest('.service-card').id.replace('Service', '');
                const originalPrice = SERVICES[serviceType].price;
                el.textContent = (originalPrice * conversionRate).toFixed(2);
              });
              document.querySelectorAll('.service-card .currency').forEach(el => {
                el.textContent = currencySymbol;
              });
              
              // Update summary table
              document.getElementById('service-fee').textContent = (basePrice * conversionRate).toFixed(2);
              document.getElementById('transaction-charge').textContent = (transactionCharge * conversionRate).toFixed(2);
              document.getElementById('total-fees').textContent = (totalAmount * conversionRate).toFixed(2);
              document.getElementById('total-amount').textContent = (totalAmount * conversionRate).toFixed(2);
              document.getElementById('grand-total').textContent = (totalAmount * conversionRate).toFixed(2);
              
              // Update all currency symbols in table
              document.querySelectorAll('.details-table .currency').forEach(el => {
                el.textContent = currencySymbol;
              });
            }
            
            // Update form action based on selected service
            function updateFormAction() {
              document.getElementById('paymentForm').action = SERVICES[currentService].action + '?invoice=<?php echo $user_token; ?>';
            }
            </script>




<style>
.service-card.selected {
  border: 2px solid #4CAF50;
  background-color: #2c5aa0;
}
.service-card.selected .checkmark {
  display: block;
}
.checkmark {
  display: none;
  position: absolute;
  top: 10px;
  right: 10px;
  width: 20px;
  height: 20px;
  background-color: #4CAF50;
  border-radius: 50%;
}
.checkmark:after {
  content: "✓";
  color: white;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
        
        
        
        
        
    

        

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



    <!-- ------------------------
        -------- my script is here---------
    <!-- ------------------------
        -------- my script is here---------
    ---------------------------------------->
    <script>
      const services = document.querySelectorAll(".service-card");
      console.log("services", services);

      services.forEach((service) => {
        service.addEventListener("click", () => {
          services.forEach((s) => s.classList.remove("urgent"));
          service.classList.add("urgent");
        });
      });
    </script>


  <?php 
include('tam_layout/footer.php');
?>