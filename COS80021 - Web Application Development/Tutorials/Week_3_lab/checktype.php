<HTML XMLns="http://www.w3.org/1999/xHTML"> 
  <head> 
    <title>Check Type</title> 
  </head> 
  <body>
  <H1>Check PHP Data Type</H1>

  <form>
	    <label>Input a value:  <input type="text" name="valuefield"> <br><br></label>
	     <input type="submit" value="check its type" />
  </form>
  
  <p> <strong>The result will appear here</strong></p>
  </body> 

<?php 
	// get name and password passed from client
	if (isset($_GET['valuefield'])) 
	{
		$value1 = $_GET['valuefield'];
            $value2 = $value1;
            echo "<p>variable value: ", $value1,"</p>" ;
            echo "<p>original variable type: ", gettype($value1), "</p>";
            echo "<p>variable type if applying postfix ++: ", gettype($value1++), "</p>";
            echo "<p>variable value becomes: ", $value1, "</p>";
            echo "<p>variable type becomes: ", gettype($value1), "</p>";

            echo "<p><strong>another test</strong></p>" ;
            echo "<p>variable value: ", $value2,"</p>" ;
            echo "<p>original variable type: ", gettype($value2), "</p>";
            echo "<p>variable type if applying prefix ++: ", gettype(++$value2), "</p>";
            echo "<p>variable value becomes: ", $value2, "</p>";
            echo "<p>variable type becomes: ", gettype($value2), "</p>";
	}
?>

</HTML>