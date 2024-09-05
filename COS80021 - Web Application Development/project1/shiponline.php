
<!-- 
-- @file name : shiponline.php
-- @author name : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
-- @assignment name : Project1 - COS80021 - Web Application Development 
-- @page details : This is the homepage of Arun Ragav Shipping, providing links to registration, login/request, and administration pages.
-- @date : 05/09/2024
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arun Ragav Shipping - Home page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    echo "<fieldset>";
    echo "<legend><h2>Arun Ragav Shipping - Home Page</h2></legend>";

    echo "<h4>Register</h4><button class ='button'><a href='register.php'>for New Users</a></button><br>";
    echo "<h4>Login</h4><button class ='button'><a href='login.php'>for Existing Users</a></button><br> ";
    echo "<h4>Administrator</h4><button class ='button'><a href='admin.php'>for Owner</a></button><br> ";
    echo "</fieldset>";
?>
</body>
</html>
