<?php
session_start();

$xml = simplexml_load_file("books.xml");

echo "<h2>Book Store</h2>";

foreach ($xml->book as $book) {
    $title = $book->title;
    $isbn = $book->isbn;
    $price = $book->price;

    echo "<b>Book:</b> " . $title . "<br />";
    echo "<b>ISBN:</b> " . $isbn . "<br />";
    echo "<b>Price:</b> $" . $price . "<br />";
    echo "<button onclick=\"addToCart('$title', '$isbn', $price);\">Add to Cart</button><br/><br/>";
}

echo "<div id='cart'></div>";
?>
