var xHRObject = new XMLHttpRequest();
function getData() {
  if (xHRObject.readyState == 4 && xHRObject.status == 200) {
    var serverResponse = xHRObject.responseXML;

    var header = serverResponse.getElementsByTagName("book");
    var divTag = document.getElementById("cart");

    let rowString = ""
    //if(header!=null){
    for (idx = 0; idx < header.length; idx++) {
      // console.log(header);
      const bookObj = Array.from(header[idx].childNodes).reduce(
        (prev, { nodeName, textContent }) => ({
          ...prev,
          [nodeName]: textContent,
        }),
        {}
      );

      rowString += `
        <tr>
          <td>${idx + 1}.</td>
          <td>${bookObj["title"]}.</td>
          <td>${bookObj["isbn"]}</td>
          <td>${bookObj["price"]}</td>
          <td>${bookObj["quantity"]}</td>
          <td>${bookObj["totalPrice"]}</td>
          <td>
            <button onClick="AddRemoveItem('Remove')">
              Remove Item
            </button>
          </td>
        </tr>
      `;
    }

    divTag.innerHTML = rowString.length === 0 ? "" : `
      <table>
        <thead>
          <tr>
            <th>Sr. No</th>
            <th>Title</th>
            <th>ISBN</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          ${rowString}
        </tbody>
      </table>
    `;

  }
}

function AddRemoveItem(action) {
  const bookContentString =
    document.getElementById("book-card-content").innerText;
  const bookString = String(bookContentString)
    .split("\n")
    .map((next) => {
      const [key, value] = next
        .trim()
        .split(":")
        .map((e) => e.trim());

      return `${key.toLowerCase()}=${encodeURIComponent(
        value.charAt(0) === "$" ? +value.replace("$", "") : value
      )}`;
    })
    .join("&");

  xHRObject.open(
    "GET",
    `ManageCart.php?action=${action}&${bookString}&value=${new Date()}`,
    true
  );

  xHRObject.onreadystatechange = getData;
  xHRObject.send(null);
}
