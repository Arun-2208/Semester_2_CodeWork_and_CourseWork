<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" >
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Email Addresses</title> 
</head>
<body>
<h1>Play with Email Addresses</h1>
<form>
<label>Input email address:  <input type="text" name="emailfield"> <br><br></label>
<label>Input a new name:  <input type="text" name="namefield"> <br><br></label>
<input type="submit" value="play" />
</form>
<hr />
</body>
<?php
  if(isset($_GET['emailfield']) && isset($_GET['namefield']))
  {
	$email = $_GET['emailfield'];
      echo "<p> The email address contains " . strlen($email) . " characters and " . str_word_count($email) . " words.</p>";
      $newName = $_GET['namefield'];
      $nameEnd = strpos($email, "@");
	echo "<p> The position of the @ in <em>$email</em> is $nameEnd.</p>";
      $name = substr($email, 0, $nameEnd);
	echo "<p> The name part before the @ is <em>$name.</em></p>"; 
      $institute = substr($email, $nameEnd+1);
	echo "<p> The institute part after the @ is <em>$institute</em></p>";
      $instSegment = explode(".", $institute);
      $cnt = count($instSegment);
      echo "<p> The components of the institute include $cnt parts. They are:</p>"; 
      for ($i=0; $i<$cnt; $i++) echo "<p><em>" . $instSegment[$i] . "</em></p>";
	echo "<p> The email address for the new member is <em>". str_replace($name, $newName, $email). "</em></p>";
      echo "You need to change " . levenshtein($name, $newName) . " characters to make the new and the old email addresses the same.</p>";
  }
?>


</html>