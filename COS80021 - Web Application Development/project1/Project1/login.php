<!-- login.php -->

<?php
    session_start();
    if((isset($_SESSION['loggedIn']))) {

        header("location:request.php"); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>
    <a href = "shiponline.php"><button class = "button">Return to Home Page</button></a><br><br>

    <!-- Login form -->
    <form method="POST">
        Customer Number: <input type="text" name="customer_number" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
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

     // variable to store and show error messsage to the user
     $error_message = "";

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Getting the login details
        $customer_number = trim($_POST['customer_number']);
        $password = trim($_POST['password']);

        // Fetching the customer data from the customers table
        $query = "SELECT password FROM customers WHERE customer_number = '$customer_number'";
        $result = @mysqli_query($conn, $query);
        $row = @mysqli_fetch_assoc($result);

        // Verifying the entered password with the one stored in the database
        if ($row && $password === $row['password']) {
            
            /*once the password verification is done 
              a session variable is created and the user is navigated to the request page 
            */
            $_SESSION['loggedIn'] = true;
            header("location: request.php?customer_number=$customer_number");
            exit();
        } 
        else {
            $error_message = "<p class ='error-message'>Invalid customer number or password.</p>";
            echo $error_message;
        }
    }

    // Closing database connection
    @mysqli_close($conn);
    }
catch(Exception $e) {
    echo "<p class = 'error-message'>Not Connected to the Database . Please check your connection</p>";
}
?>

