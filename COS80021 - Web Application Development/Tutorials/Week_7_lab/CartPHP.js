function addToCart(title, isbn, price) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("cart").innerHTML = this.responseText;
      }
  };
  xhttp.open("GET", "ManageCart.php?action=add&title=" + title + "&isbn=" + isbn + "&price=" + price, true);
  xhttp.send();
}

function removeFromCart(title) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("cart").innerHTML = this.responseText;
      }
  };
  xhttp.open("GET", "ManageCart.php?action=remove&title=" + title, true);
  xhttp.send();
}
