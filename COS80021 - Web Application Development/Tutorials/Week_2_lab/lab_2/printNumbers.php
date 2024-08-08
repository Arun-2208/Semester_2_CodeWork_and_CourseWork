
<HTML>
  <head> 
    <title>A page that takes a number as input and returns the sum of all its non factors except 1 and the number itself</title> 
  </head> 
  <body>
  <H1>Please Input a Number </H1>

  <form method = "get" action ="printNumbers.php">
	    Please input a number:	<input type="text" name="numberfield"> </label> 
		
		<input type="submit" value="Submit" />
  </form>


  <?php

    if(isset($_GET['numberfield'])){

        if($_GET['numberfield']>0){

            $number = $_GET['numberfield'];
            $i=$number;

            while($i>=1){

                if($i==$number || $i==1 || $number % $i!=0){
                    echo $i.'<br>';
                }
                $i--;
            }

        }
        else 
            echo '<p>Please enter a number greater than 0</p>';
    }

?>