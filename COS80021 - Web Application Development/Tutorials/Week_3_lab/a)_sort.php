<?php

$fruit = array ("one"=>"grapes", "two"=>"banana", "three"=>"cherry", "four"=>"apple");
asort ($fruit);

foreach($fruit as $key=>$value){

    echo $key." : ".$value."<br>";
}

echo "<br>";

ksort ($fruit);

foreach($fruit as $key=>$value){

    echo $key." : ".$value."<br>";
}


?>