function transformXML() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "transform.php");
  xhttp.onreadystatechange = () => {
    if (xhttp.status === 200 && xhttp.readyState === 4) {
      const response = xhttp.response;
      document.getElementById("book-list").innerHTML = response;
    }
  }
  xhttp.send();
}