
<!-- 
-- @file name : request.php
-- @author name : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
-- @assignment name : Project1 - COS80021 - Web Application Development 
-- @page details : This page allows logged-in customers to submit a shipping request, 
-- including input validation and data insertion into the request table.
-- @date : 05/09/2024
-->


<?php
    /* php code for starting and session -  When a user logs in with the correct password and is verified ,
        a session is started and  variable is created 
        This is done so that the user cannot directly sneak in to the request.page 
        and properly login in order to place a request 
        When the session variable is set , the user can only be in request.php page when they log in 
        and the session is cleared when they log out. 
    */

    session_start();
    if(!(isset($_SESSION['loggedIn']))) {

        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Place a Request</h1>

    <a href = "logout.php"><button class = "button">Log Out</button></a><br><br>
    <!-- Request form to place a request , once the user has successfully logged in -->
    <form method="POST">
        Item Description: <input type="text" name="item_description"  maxlength =100><br>
        Weight (kg): <input type="text" name="weight"><br>
        Pick-up Address: <input type="text" name="pickup_address"  maxlength = 60><br>
        Pick-up Suburb: <input type="text" name="pickup_suburb"  maxlength = 40><br>
        Preferred Pick-up Date: <input type="date" name="pickup_date" ><br>
        Preferred Pick-up Time: <input type="time" name="pickup_time" ><br>
        Receiver Name: <input type="text" name="receiver_name" ><br>
        Delivery Address: <input type="text" name="delivery_address"  maxlength = 60><br>
        Delivery Suburb: <input type="text" name="delivery_suburb"  maxlength = 60><br>
        Delivery State: 
        <select name="delivery_state">
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="WA" >WA</option>
            <option value="SA" >SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
            <option value="NT">NT</option>
        </select><br>
        <input type="submit" value="Submit Request">
    </form>
</body>
</html>

<?php
    // Database connection details
    $host = 'feenix-mariadb.swin.edu.au';
    $user = 's104837257';
    $pwd = '220899';
    $sql_db = 's104837257_db';

    try {
        // Connecting to the MySQL database
        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);

        // variables to store and show error messsage and success messages to the user
        $error_message = "";
        $success_message = "";

        // Handling form submission by checking if all input fields have been set 
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['customer_number'])) {

            // Retrieving form data once all fields have been entred by the user
            $customer_number = $_GET['customer_number'];
            $item_description = trim($_POST['item_description']);
            $weight = (int)(trim($_POST['weight']));
            $pickup_address = trim($_POST['pickup_address']);
            $pickup_suburb = trim($_POST['pickup_suburb']);
            $pickup_date = $_POST['pickup_date'];
            $pickup_time = $_POST['pickup_time'];
            $receiver_name = trim($_POST['receiver_name']);
            $delivery_address = trim($_POST['delivery_address']);
            $delivery_suburb = trim($_POST['delivery_suburb']);
            $delivery_state = $_POST['delivery_state'];

            // pick up date and time chosen by the user is converted from string format to date and time format
            if(isset($pickup_date) && isset($pickup_time))
                $pickup_datetime = new DateTime($pickup_date . ' ' . $pickup_time);

            // Extracting the hour component of the pick-up date and time 
            if(isset($pickup_datetime))
                $pickup_hour = (int) $pickup_datetime->format('H');

            // Validation check if any of the input fields are empty 
            if (empty($item_description) || empty($weight) || empty($pickup_address) || empty($pickup_suburb) || empty($pickup_date) || empty($pickup_time) || empty($receiver_name) || empty($delivery_address) || empty($delivery_suburb) || empty($delivery_state)) {
                $error_message = "<p class ='error-message'>All fields are required.</p>";
                echo $error_message;
            } 
            // Validation check of weight input
            else if ($weight < 2 || $weight > 20) {
                $error_message = "<p class='error-message'>Weight must be between 2 and 20 kg.</p>";
                echo $error_message;
            } 
            // Validation check of pick up date and time of being at least 24 hours from time of request 
            else if (strtotime($pickup_date . ' ' . $pickup_time) < strtotime('+24 hours')) {
                $error_message = "<p class='error-message'>Pick-up date and time must be at least 24 hours from now.</p>";
                echo $error_message;
            }
            // Validation check of  preferred pick up time between 08:00 and 20:00 on a given day 
            else if ($pickup_hour < 8 || $pickup_hour > 20) {
                $error_message = "<p class='error-message'>Pick-up hours should be between 08 AM and 8 PM</p>";
                echo $error_message;
            }
            
            // If all validations are passed , a new record is created in the request table
            else {
                // Inserting a new request into the requests table
                $insert_query = "INSERT INTO requests (customer_number, request_date, item_description, weight, pickup_address, pickup_suburb, pickup_date, pickup_time, receiver_name, delivery_address, delivery_suburb, delivery_state) 
                                VALUES ('$customer_number', NOW(), '$item_description', '$weight', '$pickup_address', '$pickup_suburb', '$pickup_date', '$pickup_time', '$receiver_name', '$delivery_address', '$delivery_suburb', '$delivery_state')";

                if (@mysqli_query($conn, $insert_query)) {
                    $request_number = mysqli_insert_id($conn);
                    $cost = 20 + ($weight - 2) * 3;

                    // fetching the customer details from the database to notify the customer of the successful request 
                    $customer_query = "SELECT name, email FROM customers WHERE customer_number = '$customer_number'";
                    $customer_result = @mysqli_query($conn, $customer_query);
                    $customer = @mysqli_fetch_assoc($customer_result);

                    // success message tp be shown to the user
                    $success_message = '<p class = "success-message">Dear <strong>'.$customer['name']. '</strong>, Thank you for using ShipOnline! Your request number is <strong>'.$request_number .'</strong>. The cost is <strong>$' .$cost .
                                       '.</strong><br> We will pick up the item at <strong>' . $pickup_time .'</strong> on <strong>'.$pickup_date. '.</strong></p>';
                    echo $success_message;

                    try {
                        // Sending a confirmation email to the customer with the request details 
                        $message = "Thank you for using Arun Ragav's Shipping!\n Your request is confirmed \n Customer Number : $customer_number \n Request number : $request_number\n Cost : $$cost\n We will pick up the item at $pickup_time on $pickup_date.\n"
                                    ."Best Regards\n"
                                    ."Arun Ragavendhar";
                        $to = $customer['email'];
                        $subject = "Shipping request confirmation with Arun Ragav Shipping and Co";
                        $headers = "From: Confirmation Mail@arunragavshipping.com";
                        $return_envelope = "-r 104837257@student.swin.edu.au";
                        mail($to, $subject, $message, $headers,$return_envelope);
                        echo "<p class ='success-message'>Email confirmation has been sent to your mail</p>";
                    }
                    // Handling the exception using a catch block if it fails
                    catch(Exception $e)
                    {
                        echo "<p class ='error-message'>The email Id entered , does not exists.</p>";
                    }
                    
                } // error handling block for failed request
                else {
                    $error_message = "<p class ='error-message'>Request failed. Please try again.</p>";
                    echo $error_message;
                }
            }

        // Closing database connection
        mysqli_close($conn);
        
        }
    }   
        // Handling the exception using a catch block if it fails
        catch(Exception $e) {
            echo "<p class='error-message'>Not Connected to the Database . Please check your connection</p>";
        }
?>






