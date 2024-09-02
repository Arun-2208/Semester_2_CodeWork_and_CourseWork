<?php
 $xmlFile = "hotel.xml";
 $HTML = "";
 $count = 0;
 //$dt = simplexml_load_file($xmlFile);
 $dom = DOMDocument::load($xmlFile);
 $hotel = $dom->getElementsByTagName("hotel"); 

foreach($hotel as $node) 
{ 
     $city = $node->getElementsByTagName("City");
     $city = $city->item(0)->nodeValue;
  
	 $type = $node->getElementsByTagName("Type");
	 $type = $type->item(0)->nodeValue;
	 
	 $name = $node->getElementsByTagName("Name");
	 $name = $name->item(0)->nodeValue;
	 
	 $price = $node->getElementsByTagName("Price");
	 $price = $price->item(0)->nodeValue;
  
	if (($type == $_GET["type"]) && ($city == $_GET["city"]) )
    {
        $HTML = $HTML."<br><span>Hotel: ".$name."</span><br><span>Price: ".$price."</span><br>";
        $count++;
	}
} 
 if ($count ==0)
 {
   $HTML ="<br><span>No hotels available</span>";
 }
           
  echo $HTML;   
?>

