<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_GET['action'] == 'add') {
    $title = $_GET['title'];
    $isbn = $_GET['isbn'];
    $price = $_GET['price'];

    if (isset($_SESSION['cart'][$title])) {
        
        $_SESSION['cart'][$title]['qty'] += 1;
        $_SESSION['cart'][$title]['total'] = $_SESSION['cart'][$title]['qty'] * $price;
    } else {
       
        $_SESSION['cart'][$title] = array(
            'isbn' => $isbn,
            'qty' => 1,
            'total' => $price
        );
    }

    displayCart();
}

if ($_GET['action'] == 'remove') {
    $title = $_GET['title'];

    if (isset($_SESSION['cart'][$title])) {
        $_SESSION['cart'][$title]['qty'] -= 1;

        if ($_SESSION['cart'][$title]['qty'] <= 0) {
            unset($_SESSION['cart'][$title]);
        } else {
            $_SESSION['cart'][$title]['total'] = $_SESSION['cart'][$title]['qty'] * $_SESSION['cart'][$title]['total'];
        }
    }

    displayCart();
}

function displayCart() {
    if (empty($_SESSION['cart'])) {
        echo "Cart is empty";
        return;
    }

    echo "<table border='1'>";
    echo "<tr><th>Title</th><th>ISBN</th><th>Quantity</th><th>Total Price</th><th>Action</th></tr>";

    foreach ($_SESSION['cart'] as $title => $details) {
        echo "<tr>";
        echo "<td>" . $title . "</td>";
        echo "<td>" . $details['isbn'] . "</td>";
        echo "<td>" . $details['qty'] . "</td>";
        echo "<td>$" . number_format($details['total'], 2) . "</td>";
        echo "<td><button onclick=\"removeFromCart('" . $title . "')\">Remove</button></td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>
