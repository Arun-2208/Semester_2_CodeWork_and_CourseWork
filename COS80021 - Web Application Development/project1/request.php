<!-- request.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Request</h1>

    <!-- Display error or success messages -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <!-- Request form -->
    <form method="POST">
        Item Description: <input type="text" name="item_description" value="<?php echo htmlspecialchars($item_description ?? ''); ?>"><br>
        Weight (kg): <input type="number" name="weight" min="2" max="20" value="<?php echo htmlspecialchars($weight ?? ''); ?>"><br>
        Pick-up Address: <input type="text" name="pickup_address" value="<?php echo htmlspecialchars($pickup_address ?? ''); ?>"><br>
        Pick-up Suburb: <input type="text" name="pickup_suburb" value="<?php echo htmlspecialchars($pickup_suburb ?? ''); ?>"><br>
        Preferred Pick-up Date: <input type="date" name="pickup_date" value="<?php echo htmlspecialchars($pickup_date ?? ''); ?>"><br>
        Preferred Pick-up Time: <input type="time" name="pickup_time" min="08:00" max="20:00" value="<?php echo htmlspecialchars($pickup_time ?? ''); ?>"><br>
        Receiver Name: <input type="text" name="receiver_name" value="<?php echo htmlspecialchars($receiver_name ?? ''); ?>"><br>
        Delivery Address: <input type="text" name="delivery_address" value="<?php echo htmlspecialchars($delivery_address ?? ''); ?>"><br>
        Delivery Suburb: <input type="text" name="delivery_suburb" value="<?php echo htmlspecialchars($delivery_suburb ?? ''); ?>"><br>
        Delivery State: 
        <select name="delivery_state">
            <option value="VIC" <?php echo (isset($delivery_state) && $delivery_state === 'VIC') ? 'selected' : ''; ?>>VIC</option>
            <option value="NSW" <?php echo (isset($delivery_state) && $delivery_state === 'NSW') ? 'selected' : ''; ?>>NSW</option>
            <option value="QLD" <?php echo (isset($delivery_state) && $delivery_state === 'QLD') ? 'selected' : ''; ?>>QLD</option>
            <option value="WA" <?php echo (isset($delivery_state) && $delivery_state === 'WA') ? 'selected' : ''; ?>>WA</option>
            <option value="SA" <?php echo (isset($delivery_state) && $delivery_state === 'SA') ? 'selected' : ''; ?>>SA</option>
            <option value="TAS" <?php echo (isset($delivery_state) && $delivery_state === 'TAS') ? 'selected' : ''; ?>>TAS</option>
            <option value="ACT" <?php echo (isset($delivery_state) && $delivery_state === 'ACT') ? 'selected' : ''; ?>>ACT</option>
            <option value="NT" <?php echo (isset($delivery_state) && $delivery_state === 'NT') ? 'selected' : ''; ?>>NT</option>
        </select><br>
        <input type="submit" value="Submit Request">
    </form>
</body>
</html>


<?php
// Connect to MySQL database
$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 's104837257', '220899', 's104837257_db');
$customer_number = $_GET['customer_number'] ?? null;

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = "";
$success_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $customer_number) {
    // Retrieve form data
    $item_description = trim($_POST['item_description']);
    $weight = (int)$_POST['weight'];
    $pickup_address = trim($_POST['pickup_address']);
    $pickup_suburb = trim($_POST['pickup_suburb']);
    $pickup_date = $_POST['pickup_date'];
    $pickup_time = $_POST['pickup_time'];
    $receiver_name = trim($_POST['receiver_name']);
    $delivery_address = trim($_POST['delivery_address']);
    $delivery_suburb = trim($_POST['delivery_suburb']);
    $delivery_state = $_POST['delivery_state'];

    // Validation checks
    if (empty($item_description) || empty($weight) || empty($pickup_address) || empty($pickup_suburb) || empty($pickup_date) || empty($pickup_time) || empty($receiver_name) || empty($delivery_address) || empty($delivery_suburb) || empty($delivery_state)) {
        $error_message = "All fields are required.";
    } elseif ($weight < 2 || $weight > 20) {
        $error_message = "Weight must be between 2 and 20 kg.";
    } elseif (strtotime($pickup_date . ' ' . $pickup_time) < strtotime('+24 hours')) {
        $error_message = "Pick-up date and time must be at least 24 hours from now.";
    } else {
        // Insert new request
        $insert_query = "INSERT INTO requests (customer_number, request_date, item_description, weight, pickup_address, pickup_suburb, pickup_date, pickup_time, receiver_name, delivery_address, delivery_suburb, delivery_state) 
                         VALUES ('$customer_number', NOW(), '$item_description', '$weight', '$pickup_address', '$pickup_suburb', '$pickup_date', '$pickup_time', '$receiver_name', '$delivery_address', '$delivery_suburb', '$delivery_state')";

        if (mysqli_query($conn, $insert_query)) {
            $request_number = mysqli_insert_id($conn);
            $cost = 20 + ($weight - 2) * 3;
            $success_message = "Thank you! Your request number is $request_number. The cost is $$cost. We will pick up the item at $pickup_time on $pickup_date.";

            // Send confirmation email
            $customer_query = "SELECT name, email FROM customers WHERE customer_number = '$customer_number'";
            $customer_result = mysqli_query($conn, $customer_query);
            $customer = mysqli_fetch_assoc($customer_result);

            $to = $customer['email'];
            $subject = "Shipping request with ShipOnline";
            $message = "Dear {$customer['name']}, Thank you for using ShipOnline! Your request number is $request_number. The cost is $$cost. We will pick up the item at $pickup_time on $pickup_date.";
            $headers = "From: noreply@shiponline.com";
            mail($to, $subject, $message, $headers, "-r 1234567@student.swin.edu.au");
        } else {
            $error_message = "Request failed. Please try again.";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>

