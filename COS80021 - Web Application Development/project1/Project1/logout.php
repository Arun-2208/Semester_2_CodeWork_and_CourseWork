
<!--logout.php>

// php code to destroy the session variable and the session when the user logs out
<?php

session_start();

unset($_SESSION['loggedIn']);

session_destroy();

header('location:login.php');

?>