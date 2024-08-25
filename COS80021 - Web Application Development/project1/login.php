<!-- login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>

    <!-- Display error message -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Login form -->
    <form method="POST">
        Customer Number: <input type="text" name="customer_number" value="<?php echo htmlspecialchars($customer_number ?? ''); ?>"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $customer_number = trim($_POST['customer_number']);
    $password = trim($_POST['password']);

    // Fetch customer data
    $query = "SELECT password FROM customers WHERE customer_number = '$customer_number'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if ($row && password_verify($password, $row['password'])) {
        header("Location: request.php?customer_number=$customer_number");
        exit();
    } else {
        $error_message = "Invalid customer number or password.";
    }
}

// Close database connection
mysqli_close($conn);
?>

