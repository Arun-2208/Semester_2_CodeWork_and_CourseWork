<!-- admin.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration - ShipOnline</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Administration - View Requests</h1>

    <!-- Display error message -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Admin form -->
    <form method="POST">
        <label><input type="radio" name="date_type" value="request_date" <?php echo (isset($date_type) && $date_type === 'request_date') ? 'checked' : ''; ?>> Request Date</label>
        <label><input type="radio" name="date_type" value="pickup_date" <?php echo (isset($date_type) && $date_type === 'pickup_date') ? 'checked' : ''; ?>> Pick-up Date</label><br>
        Date: <input type="date" name="selected_date" value="<?php echo htmlspecialchars($selected_date ?? ''); ?>"><br>
        <input type="submit" value="Show Requests">
    </form>

    <!-- Display requests table -->
    <?php if (!empty($requests)): ?>
        <h2>Requests on <?php echo htmlspecialchars($selected_date); ?></h2>
        <table>
            <tr>
                <?php if ($date_type === 'request_date'): ?>
                    <th>Customer Number</th>
                    <th>Request Number</th>
                    <th>Item Description</th>
                    <th>Weight (kg)</th>
                    <th>Pick-up Suburb</th>
                    <th>Pick-up Date</th>
                    <th>Delivery Suburb</th>
                    <th>Delivery State</th>
                <?php else: ?>
                    <th>Customer Number</th>
                    <th>Customer Name</th>
                    <th>Contact Phone</th>
                    <th>Request Number</th>
                    <th>Item Description</th>
                    <th>Weight (kg)</th>
                    <th>Pick-up Address</th>
                    <th>Pick-up Suburb</th>
                    <th>Preferred Pick-up Time</th>
                    <th>Delivery Suburb</th>
                    <th>Delivery State</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <?php if ($date_type === 'request_date'): ?>
                        <td><?php echo $request['customer_number']; ?></td>
                        <td><?php echo $request['request_number']; ?></td>
                        <td><?php echo $request['item_description']; ?></td>
                        <td><?php echo $request['weight']; ?></td>
                        <td><?php echo $request['pickup_suburb']; ?></td>
                        <td><?php echo $request['pickup_date']; ?></td>
                        <td><?php echo $request['delivery_suburb']; ?></td>
                        <td><?php echo $request['delivery_state']; ?></td>
                    <?php else: ?>
                        <td><?php echo $request['customer_number']; ?></td>
                        <td><?php echo $request['name']; ?></td>
                        <td><?php echo $request['phone_number']; ?></td>
                        <td><?php echo $request['request_number']; ?></td>
                        <td><?php echo $request['item_description']; ?></td>
                        <td><?php echo $request['weight']; ?></td>
                        <td><?php echo $request['pickup_address']; ?></td>
                        <td><?php echo $request['pickup_suburb']; ?></td>
                        <td><?php echo $request['pickup_time']; ?></td>
                        <td><?php echo $request['delivery_suburb']; ?></td>
                        <td><?php echo $request['delivery_state']; ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Display aggregated information -->
        <p>Total Number of Requests: <?php echo $total_requests; ?></p>
        <?php if ($date_type === 'request_date'): ?>
            <p>Total Revenue: $<?php echo $total_revenue; ?></p>
        <?php else: ?>
            <p>Total Weight: <?php echo $total_weight; ?> kg</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>


<?php
// Connect to MySQL database
$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 's104837257', '220899', 's104837257_db');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = "";
$requests = [];
$total_requests = 0;
$total_revenue = 0;
$total_weight = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_type = $_POST['date_type']; // 'request_date' or 'pickup_date'
    $selected_date = $_POST['selected_date'];

    if (empty($selected_date)) {
        $error_message = "Please select a date.";
    } else {
        if ($date_type === 'request_date') {
            // Retrieve requests based on request date
            $query = "SELECT customer_number, request_number, item_description, weight, pickup_suburb, pickup_date, delivery_suburb, delivery_state 
                      FROM requests WHERE DATE(request_date) = '$selected_date'";
        } else {
            // Retrieve requests based on pickup date
            $query = "SELECT r.customer_number, c.name, c.phone_number, r.request_number, r.item_description, r.weight, r.pickup_address, r.pickup_suburb, r.pickup_time, r.delivery_suburb, r.delivery_state 
                      FROM requests r
                      JOIN customers c ON r.customer_number = c.customer_number
                      WHERE r.pickup_date = '$selected_date'
                      ORDER BY r.pickup_suburb, r.delivery_state, r.delivery_suburb";
        }

        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $requests[] = $row;
                $total_requests++;
                $total_weight += $row['weight'];
                $total_revenue += 20 + ($row['weight'] - 2) * 3; // Calculate cost based on weight
            }
        } else {
            $error_message = "Error retrieving data. Please try again.";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>

