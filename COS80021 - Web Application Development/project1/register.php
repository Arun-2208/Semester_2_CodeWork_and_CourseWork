
<!-- register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register</h1>

    <!-- Display error or success messages -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <!-- Registration form -->
    <form method="POST">
        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>"><br>
        Password: <input type="password" name="password"><br>
        Retype Password: <input type="password" name="retyped_password"><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>"><br>
        Phone Number: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>"><br>
        <input type="submit" value="Register">
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
$success_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $retyped_password = trim($_POST['retyped_password']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Validate input fields
    if (empty($name) || empty($password) || empty($retyped_password) || empty($email) || empty($phone)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $retyped_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $email_check_query = "SELECT email FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $email_check_query);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "Email already registered.";
        } else {
            // Hash password for security
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            // Insert new customer data
            $insert_query = "INSERT INTO customers (name, password, email, phone_number) VALUES ('$name', '$hashed_password', '$email', '$phone')";

            if (mysqli_query($conn, $insert_query)) {
                $customer_number = mysqli_insert_id($conn);
                $success_message = "Dear $name, you are successfully registered into ShipOnline, and your customer number is $customer_number.";
            } else {
                $error_message = "Registration failed. Please try again.";
            }
        }
    }
}

// Close database connection
mysqli_close($conn);
?>
