<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<body>
<H1>Members of the Hawthorn Bowling Club</H1>
<br/>

<form>
Please enter the name <input type="text" name="bowler">

<input type = "submit" value ="Search">
</form>

<?php 

if(isset($_GET['bowler']) && trim($_GET['bowler'])!=""){

  function findPhone($curLine){

    $curLine[0]=trim(strtolower($curLine[0]));
    $findName=trim(strtolower($_GET['bowler']));


    if(strcmp($curLine[0],$findName)==0)
      return true;
    else 
        return false;
  }

  $flag = 0;
  $file = "bowlers.txt";
  if(!file_exists($file))
    echo "No registered member found!";
  else {
    $mainFile=file($file);

    
    for($i=0;$i<count($mainFile);$i++){

      $curLine = explode(",",$mainFile[$i]);
      
      $search = findPhone($curLine);

      if ($search == true){
        echo '<table border =1><tr><th>Name</th><th>PhoneNumber</th></tr>';
    
        echo '<tr><td>'.$curLine[0].'</td><td>'.$curLine[1].'</td></tr></table>';
        $flag = 1;
        break;
      }
    }
      if ($flag == 0)

        echo '<p>Bowler not found in the Records</p>';
      
}
}
?>
</body> 
</HTML>
