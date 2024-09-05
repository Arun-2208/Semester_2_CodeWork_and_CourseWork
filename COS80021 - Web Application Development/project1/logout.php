<!-- 
-- @author name : Arun Ragavendhar Arunachalam Palaniyappan - 104837257
-- @assignment name : Project1 - COS80021 - Web Application Development 
-- @page details : This page has the  php code to destroy the session variable and the session when the user logs out
-- @date : 05/09/2024
--->

<?php

    /* php code for starting and session -  When a user logs in with the correct password and is verified ,
            a session is started and  variable is created 
            This is done so that the user cannot directly sneak in to the request.page 
            and properly login in order to place a request 
            When the session variable is set , the user can only be in request.php page when they log in 
            and the session is cleared when they log out. 
        */

    session_start();

    // when the user logs out , the session variable is unset and the session is destroyed 

    unset($_SESSION['loggedIn']);

    session_destroy();

    // user is then redirected to the login page

    header('location:login.php');

?>