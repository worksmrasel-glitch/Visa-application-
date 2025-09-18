<?php include('tam_layout/header.php');
   include('apm/config.php');?>
<body>
    <h2>Complete Your Payment</h2>
    <form id="paymentForm">
        <h3>Service Details</h3>
        <p><strong>Service:</strong> Service 1 ($100)</p>
        <p><strong>Currency:</strong> USD</p>
        <p><strong>Quantity:</strong> <span id="quantityDisplay"></span></p>
        <p><strong>Total:</strong> <span id="totalDisplay"></span></p>

        <h3>Customer Details</h3>
        <p><strong>Name:</strong> <span id="nameDisplay"></span></p>
        <p><strong>Note:</strong> <span id="noteDisplay"></span></p>

        <button type="button" id="stripePay">Pay with Stripe</button>
        <button type="button" id="paypalPay">Pay with PayPal</button>
    </form>

    <script>
        $(document).ready(function () {
            // Extract URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const service = urlParams.get('service');
            const currency = urlParams.get('currency');
            const quantity = urlParams.get('quantity');
            const name = urlParams.get('name');
            const note = urlParams.get('note');

            // Ensure service and currency are preselected
            if (service !== '1' || currency !== 'USD') {
                alert('Invalid service or currency selection!');
                window.location.href = 'index.html'; // Redirect back to main page
                return;
            }

            // Calculate the total
            const servicePrice = 100; // Service 1 price in USD
            const total = servicePrice * quantity;

            // Display the details
            $('#quantityDisplay').text(quantity);
            $('#totalDisplay').text(`USD ${total.toFixed(2)}`);
            $('#nameDisplay').text(decodeURIComponent(name));
            $('#noteDisplay').text(decodeURIComponent(note));

            // Handle payment buttons
            $('#stripePay').click(function () {
                alert(`Redirecting to Stripe payment for USD ${total.toFixed(2)}`);
                // Implement Stripe payment logic here
            });

            $('#paypalPay').click(function () {
                alert(`Redirecting to PayPal payment for USD ${total.toFixed(2)}`);
                // Implement PayPal payment logic here
            });
        });
    </script>

<?php include('tam_layout/footer.php'); ?>
