
<!-- 
-- @file name : register.php
-- @author name : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
-- @assignment name : Project1 - COS80021 - Web Application Development 
-- @page details : This page handles customer registration, including input validation and customer data insertion into the database.
-- @date : 05/09/2024
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register</h1>
    <a href = "shiponline.php"><button class = "button">Return to Home page</button></a><br><br>

    <!-- Registration form to get the user data-->
    <form method="POST">
        Name: <input type="text" name="name" required><br>
        Password: <input type="password" name="password" required maxlength = 30><br>
        Retype Password: <input type="password" name="retyped_password" required maxlength = 30><br>
        Email: <input type="email" name="email" required><br>
        Phone Number: <input type="text" name="phone" required maxlength =10><br>
        <input type="submit" value="Register">
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

    // Handling and validating the  form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // extracting the form data 
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        $retyped_password = trim($_POST['retyped_password']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        // Validating the input fields
        if (empty($name) || empty($password) || empty($retyped_password) || empty($email) || empty($phone)) {
            $error_message = "<p class = 'error-message'>All fields are required.</p>";
            echo $error_message;
        } 
        else if ($password !== $retyped_password) {
            $error_message = "<p class = 'error-message'> Retyped password does not match.</p>";
            echo $error_message;
        } 
        else {
            // Checking if email already exists
            $email_check_query = "SELECT email FROM customers WHERE email = '$email'";
            $result = @mysqli_query($conn, $email_check_query);

            if (@mysqli_num_rows($result) > 0) {
                $error_message = "<p class = 'error-message'>Email Id already exists.</p>";
                echo $error_message;
            } 
            else {
                
                // Inserting new customer data to create a new record in the customer table
                $insert_query = "INSERT INTO customers (name, password, email, phone_number) VALUES ('$name', '$password', '$email', '$phone')";

                if (@mysqli_query($conn, $insert_query)) {
                    // If the user record creation is successful , the unique customer number is fetched to display to the user. 
                    $customer_number = mysqli_insert_id($conn);
                    $success_message = "<p class ='success-message'>Dear <strong>$name</strong>, you are successfully registered into ShipOnline, and your customer number is <strong>$customer_number</strong></p>";
                    echo $success_message;
                } 
                else {
                    $error_message = "<p class = 'error-message'>Registration failed. Please try again.</p>";
                    echo $error_message;
                }
            }
        }
    }
        // Closing database connection
        mysqli_close($conn);
    }
    catch(Exception $e) {
        echo "<p class = 'error-message'>Not Connected to the Database . Please check your connection</p>";
    }
?>
