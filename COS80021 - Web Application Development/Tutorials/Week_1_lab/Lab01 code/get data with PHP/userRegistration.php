<!--file simplePHP.php -->

<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>A Simple Example</title> 
  </head> 
  <body>
  <H1>Fetching data with PHP</H1>

  <form method="get" action="userRegistration.php">
	    <label>User Name:  <input type="text" name="namefield" required> </label>
 	    <label><br>Password: <input type="password" name="pwdfield" required> <br><br> </label>
		<label>Gender:  <input type="radio" name="gender" value="Male" required> &nbsp;&nbsp;&nbsp;
		 			 	 <input type="radio" name="gender" value="female" required> </label> <br><br>
		<label> Age Range: <input type="number" max="60" min="18" required name="age"></label> <br><br>
		<label>Email:<input type="email" name="email" required></label><br><br>
		<input type="submit" value="Send to server" />
  </form>
  
  <p> The result data will refresh current page.</p>
  </body> 

<?php 
	// get name and password passed from client
	if(isset($_GET['namefield']) && isset($_GET['pwdfield']) && isset($_GET['gender']) && isset($_GET['age']) && isset($_GET['email']))
	{
		$name = $_GET['namefield'];
		$pwd = $_GET['pwdfield'];
		$gender = $_GET['gender'];
		$age = $_GET['age'];
		$email = $_GET['email'];
		// sleep for 10 seconds to slow server response down
		sleep(5);
		// write back the password concatenated to end of the name
		echo "<p>Registration successful , your details :</p> ";

		echo "<p>name : ".$name."</p>";
		
		echo "<p>Gender : ".$gender."</p>";
		echo "<p>Age : ".$age."</p>";
		echo "<p>Email : ".$email."</p>";


		date_default_timezone_set("Australia/Melbourne");
        $currentServerTime = date('Y-m-d H:i:s');
		echo "<p>Current Server Time: " . $currentServerTime . "</p>";
	} 
?>

</HTML>