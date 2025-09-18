<?php
// showModal.php

// Start the session and check for the visitorId in the URL
session_start();
if (isset($_GET['visitorId'])) {
    $visitorId = $_GET['visitorId'];

    // Fetch visitor data from the database based on the visitorId
    // (Assuming you have a database connection in place)
    $connection = mysqli_connect('localhost', 'root', '', 'your_database');
    $query = "SELECT * FROM visitors WHERE visitor_id = '$visitorId'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $visitorData = mysqli_fetch_assoc($result);
    } else {
        echo "No data found for this visitor.";
        exit;
    }
} else {
    echo "Visitor ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Modal</title>
    <!-- Include Bootstrap CSS for Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="visitorModal" tabindex="-1" aria-labelledby="visitorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visitorModalLabel">Visitor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Visitor ID:</strong> <?php echo $visitorData['visitor_id']; ?></p>
                <p><strong>Name:</strong> <?php echo $visitorData['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $visitorData['email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $visitorData['phone']; ?></p>
                <!-- Add other visitor details as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS for Modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Show the modal after the page loads
    window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('visitorModal'), {
            keyboard: false
        });
        myModal.show();
    };
</script>

</body>
</html>
