<?php

echo "<br><p><a href='shiponline.php'>Home page</a></p>";
echo "<form method='post' action='register.php'>"
    ."<fieldset>"
    ."<legend><h2>ShipOnline Registration Page</h2></legend>";

echo "<p><label for='firstname'>First Name : </label><input type='text' name='firstname' id='firstname'></p>";

echo "<p><label for='lasttname'>Last Name : </label><input type='text' name='lastname' id='lastname'></p>";

echo "<p><label for='password'>Password : </label><input type='text' name='password' id='password'></p>";

echo "<p><label for='confirmpassword'>Confirm Password : </label><input type='text' name='confirmpassword' id='confirmpassword'></p>";

echo "<p><label for='emailaddress'>Email Address : </label><input type='text' name='emailaddress' id='emailaddress'></p>";

echo "<p><label for='contactno'>Contact No : </label><input type='text' name='contactno' id='contactno'></p>";

echo "<input type='submit' value='REGISTER'>"
    ."</fieldset></form>";


    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password'])
        && isset($_POST['confirmpassword']) && isset($_POST['emailaddress']) && isset($_POST['contactno'])){
    
        }

    else{
        echo "<p>Please enter all fields before pressing submit !</p>";
    }

    ?>