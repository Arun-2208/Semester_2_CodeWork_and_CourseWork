<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<body>
<H1>Palindrome Checking</H1>
<br/>
<H3>Let us check if the entered word or phrase is a palindrome or not</H3>
<form>
  String <input type="text" name="str"> <br><br>
  
  &nbsp;&nbsp;<input type="submit" value="Register" /> <br/>
</form>
</body>

<?php

    if(isset($_GET['str']) && trim($_GET['str'])!=""){

        $str = $_GET['str'];

        $str = strtolower($str);
        $str = preg_replace("/[^A-Za-z0-9]/","",$str);
        $str = trim($str);
        echo "<p>cleaned up version of the string: ".$str.'</p>';

        $revstr = strrev($str);
         

        if(strcmp($str,$revstr) == 0){

            echo '<p>It is a Palindrome!!</p>';
        }
        else{
           
            echo '<p>It is not a palindrome </p>';
        }      
    }
   

?>

</html>