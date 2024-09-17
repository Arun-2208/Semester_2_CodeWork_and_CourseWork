<?php
//session_register('Cart');
session_start();
header('Content-Type: text/xml');
?>
<?php
		if(!isset($_SESSION["Cart"])){
			$_SESSION["Cart"] = "";
		}
        $newitem = $_GET["book"];
        $action = $_GET["action"];
        if ($_SESSION["Cart"] != "")
        {
            $MDA = $_SESSION["Cart"];
            if ($action == "Add")
            {
                if ($MDA[$newitem] != "")
                {  
                    $value = $MDA[$newitem] + 1;
                    $MDA[$newitem] = $value;
                }
                else
                {
                    $MDA[$newitem] = "1";
                }
            }
            else
            {
                $MDA= "";
            }
        }
        else
        {
            $MDA[$newitem] = "1";
        }
        $_SESSION["Cart"] = $MDA; 
        ECHO (toXml($MDA));         								
    
    function toXml($MDA)
    {
        $doc = new DomDocument('1.0');
        $cart = $doc->createElement('cart');
        $cart = $doc->appendChild($cart);
        if($MDA!=""){
			foreach ($MDA as $a => $b)
			{
				$book = $doc->createElement('book');
				$book = $cart->appendChild($book);

				$title = $doc->createElement('title'); 
				$title = $book->appendChild($title);   
				$value = $doc->createTextNode($a);
				$value = $title->appendChild($value);

				$quantity = $doc->createElement('quantity');
				$quantity = $book->appendChild($quantity);
				$value2 = $doc->createTextNode($b);
				$value2 = $quantity->appendChild($value2);
			}
			
		}
        
        
        
     
		

        $strXml = $doc->saveXML(); 
        return $strXml;
    }
?>
