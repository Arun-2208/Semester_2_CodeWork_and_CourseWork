<?php
//session_register('Cart');
session_start();
header('Content-Type: text/xml');
?>
<?php
if (!isset($_SESSION["Cart"])) {
    $_SESSION["Cart"] = [];
}
$bookTitle = $_GET["book"];
$bookISBN = $_GET["isbn"];
$price = $_GET["price"];
$action = $_GET["action"];
$currentDate = date('Y-m-d H:i:s');

$MDA = $_SESSION["Cart"];
if ($_SESSION["Cart"] != "") {
    if ($action == "Add") {
        if (isset($MDA[$bookISBN]) && is_array($MDA[$bookISBN])) {
            $MDA[$bookISBN]["quantity"] = $MDA[$bookISBN]["quantity"] + 1;
            $MDA[$bookISBN]["totalPrice"] = $MDA[$bookISBN]["quantity"] * $MDA[$bookISBN]["price"];
            $MDA[$bookISBN]["updateDate"] = $currentDate;
        } else {
            $MDA[$bookISBN] = [
                "bookTitle" => $bookTitle,
                "bookISBN" => $bookISBN,
                "price" => $price,
                "quantity" => 1,
                "totalPrice" => $price,
                "createDate" => $currentDate,
                "updateDate" => $currentDate
            ];
        }
    } else {
        $MDA = array();
    }
} else {
    $MDA[$bookISBN] = [];
}
$_SESSION["Cart"] = $MDA;
echo (toXml($MDA));


function toXml($MDA)
{
    $dom = new DomDocument('1.0', 'utf-8');
    
    $cart = $dom->createElement('cart');
    $dom->appendChild($cart);
    
    if (isset($MDA)) {
        foreach ($MDA as $a => $bookArray) {
            $cart_item = $dom->createElement('book');
            // Add attributes to the <book> element
            $cart_item->setAttribute('createDate', $bookArray["createDate"]);
            $cart_item->setAttribute('updateDate', $bookArray["updateDate"]);
            $cart->appendChild($cart_item);

            
            $cart_item->appendChild($dom->createElement('title', $bookArray["bookTitle"]));
            $cart_item->appendChild($dom->createElement('isbn', $bookArray["bookISBN"]));
            $cart_item->appendChild($dom->createElement('price', "$" . $bookArray["price"]));
            $cart_item->appendChild($dom->createElement('quantity', $bookArray["quantity"]));
            $cart_item->appendChild($dom->createElement('totalPrice', "$" . $bookArray["totalPrice"]));

        }
    }

    $strXml = $dom->saveXML();
    return $strXml;
}
?>
