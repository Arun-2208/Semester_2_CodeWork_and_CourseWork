
<!--
-- @file name : admin.php 
-- @author name : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
-- @assignment name : Project1 - COS80021 - Web Application Development 
-- @page details : This page provides an interface for viewing and managing shipping requests 
-- based on request date or pickup date, displaying relevant data in a table format.
-- @date : 05/09/2024
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration - ShipOnline</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Administration - Arun Ragav Shipping</h1>
    <a href = "shiponline.php"><button class = "button">Return to Home Page</button></a><br><br>
    <!-- Admin form -->
    <form method="POST">
        <label><input type="radio" name="date_type" value="request_date"> Request Date</label>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="date_type" value="pickup_date"> Pick-up Date</label><br>
        <label>Date for retrieval: <input type="date" name="selected_date"></label><br>
        <input type="submit" value="Show Requests">
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

        // varaibles to show error message , store the total no of requests , calculated revenue and total weight 
        $error_message = "";
        $requests = [];
        $total_requests = 0;
        $total_revenue = 0;
        $total_weight = 0;

        // variable to store and extract the time and date components during validation check
        $date_type ='';
        $selected_date ='';

    // handling the form submission and validation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // validation check if user has selected a date
        if (empty($_POST['selected_date']) ) {
            $error_message = "<p class = 'error-message'>Please select a date.</p>";
            echo $error_message;
        } 
        // validation check if user has selected a type of request 
        else if(empty($_POST['date_type'])) {
            $error_message = "<p class ='error-message'>Please select a request type.</p>";
            echo $error_message;
        }
        else {
            $date_type = $_POST['date_type'];             //  getting the type of request - if its a 'request_date' or 'pickup_date'
            $selected_date = $_POST['selected_date'];    // getting the selected date
            
            if ($date_type == 'request_date') {
                // Retrieving requests based on request date
                $query = "SELECT customer_number, request_number, item_description, weight, pickup_suburb, pickup_date, delivery_suburb, delivery_state 
                          FROM requests WHERE DATE(request_date) = DATE('$selected_date')";
            } 
            else {
                // Retrieving requests based on pickup date
                $query = "SELECT r.customer_number, c.name, c.phone_number, r.request_number, r.item_description, r.weight, r.pickup_address, r.pickup_suburb, r.pickup_time, r.delivery_suburb, r.delivery_state 
                          FROM requests r
                          JOIN customers c ON r.customer_number = c.customer_number
                          WHERE r.pickup_date = '$selected_date'
                          ORDER BY r.pickup_suburb, r.delivery_state, r.delivery_suburb ASC";
            }

            // querying the database 
            $result = @mysqli_query($conn, $query);

            if ($result) {

                // extracting the request records from the database
                while ($row = @mysqli_fetch_assoc($result)) {
                    $requests[] = $row;
                    $total_requests++;
                    $total_weight += $row['weight'];
                    $total_revenue += 20 + ($row['weight'] - 2) * 3; // Calculating the  cost based on weight
                }

                echo "<p>Retreival based on <strong>".$_POST['date_type']."</strong> for the day <strong>".$_POST['selected_date']."</strong></p>";

                // displaying the number of requests for the given day based on the date type chosen by the user 
                echo '<p class>Number of requests : <strong>'.$total_requests.'</strong></p>';

                
                /* If records are found in the database for a given date and request type,  
                    it is extracted from the database and displayed to the user as a HTML TABLE */

                if(count($requests)!=0){

                    if($date_type == 'request_date'){
                        echo  '<p class = "success-message">Total revenue on chosen request date : <strong>$AUD '.$total_revenue.'</strong></p>';
                    }
                    else{
                        echo  '<p class = "success-message">Total weight to be shipped on chosen pick up day : <strong>'.$total_weight.' Kgs</strong></p>';
                    }
                    echo "<table>";

                    // table headers for fetch by request date 
                        if($date_type == 'request_date'){
                            echo '<tr><th>Customer Number</th>'
                                .'<th>Request Number</th>'
                                .'<th>Item Description</th>'
                                .'<th>Weight (kg)</th>'
                                .'<th>Pick-up Suburb</th>'
                                .'<th>Pick-up Date</th>'
                                .'<th>Delivery Suburb</th>'
                                .'<th>Delivery State</th></tr>';

                        }
                    // table headers for fetch by pick up date     
                        else{
                            echo '<tr><th>Customer Number</th>'
                                .'<th>Customer Name</th>'
                                .'<th>Contact Phone</th>'
                                .'<th>Request Number</th>'
                                .'<th>Item Description</th>'
                                .'<th>Weight (kg)</th>'
                                .'<th>Pick-up Address</th>'
                                .'<th>Pick-up Suburb</th>'
                                .'<th>Preferred Pick-up Time</th>'
                                .'<th>Delivery Suburb</th>'
                                .'<th>Delivery State</th></tr>';
                        }
                    
                    foreach($requests as $tableRow){

                        if($date_type =='request_date'){

                            // Database records for fetch by request date , displayed as HTML TABLE ROWS
                            echo '<tr>'
                                .'<td>'.$tableRow['customer_number'].'</td>'
                                .'<td>'.$tableRow['request_number'].'</td>'
                                .'<td>'.$tableRow['item_description'].'</td>'
                                .'<td>'.$tableRow['weight'].'</td>'
                                .'<td>'.$tableRow['pickup_suburb'].'</td>'
                                .'<td>'.$tableRow['pickup_date'].'</td>'
                                .'<td>'.$tableRow['delivery_suburb'].'</td>'
                                .'<td>'.$tableRow['delivery_state'].'</td></tr>';
                            }

                        else{

                            // Database records for fetch by pick up date , displayed as HTML TABLE ROWS
                            echo '<tr>'
                                .'<td>'.$tableRow['customer_number'].'</td>'
                                .'<td>'.$tableRow['name'].'</td>'
                                .'<td>'.$tableRow['phone_number'].'</td>'
                                .'<td>'.$tableRow['request_number'].'</td>'
                                .'<td>'.$tableRow['item_description'].'</td>'
                                .'<td>'.$tableRow['weight'].'</td>'
                                .'<td>'.$tableRow['pickup_address'].'</td>'
                                .'<td>'.$tableRow['pickup_suburb'].'</td>'
                                .'<td>'.$tableRow['pickup_time'].'</td>'
                                .'<td>'.$tableRow['delivery_suburb'].'</td>'
                                .'<td>'.$tableRow['delivery_state'].'</td></tr>';
                            }
                        }
                        echo '</table>';
                    }
                    else{
                        echo '<p class ="error-message">No requests have been placed yet</p>';
                    }
            }

            else {
                $error_message = "<p class = 'error-message'>Error retrieving data. Please try again.</p>";
                echo $error_message;
            }
        }
    }
    // Closing database connection
       @mysqli_close($conn);
    }
    // Handling the exception using a catch block if it fails
    catch(Exception $e) {
        echo "<p class = 'error-message'>Not Connected to the Database . Please check your connection</p>";
        }
?>

