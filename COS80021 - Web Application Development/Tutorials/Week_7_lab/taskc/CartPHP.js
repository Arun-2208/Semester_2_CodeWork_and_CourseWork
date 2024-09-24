var xHRObject = new XMLHttpRequest();
function getData() {
  if (xHRObject.readyState == 4 && xHRObject.status == 200) {
    var serverResponse = xHRObject.responseXML;

    var header = serverResponse.getElementsByTagName("book");
    var divTag = document.getElementById("cart");

    let rowString = "";
    //if(header!=null){
    for (idx = 0; idx < header.length; idx++) {
      const bookObj = Array.from(header[idx].childNodes).reduce(
        (prev, { nodeName, textContent }) => ({
          ...prev,
          [nodeName]: textContent,
        }),
        {}
      );

      const bookCardId = `isbn-${bookObj["isbn"]}`;
      rowString += `
        <tr>
          <td>${idx + 1}.</td>
          <td>${bookObj["title"]}.</td>
          <td>${bookObj["isbn"]}</td>
          <td>${bookObj["price"]}</td>
          <td>${bookObj["quantity"]}</td>
          <td>${bookObj["totalPrice"]}</td>
          <td>
            <button onClick="AddRemoveItem('Remove', '${bookCardId}')">
              Remove Item
            </button>
          </td>
        </tr>
      `;
    }

    divTag.innerHTML =
      rowString.length === 0
        ? ""
        : `
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

function AddRemoveItem(action, bookCardId) {
  const bookContentString = document.getElementById(bookCardId).innerText;
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

window.onload = (event) => {
  xHRObject.open("GET", "BookCatalog.php", true);
  xHRObject.onreadystatechange = (xEvent) => {
    if (xHRObject.readyState == 4 && xHRObject.status == 200) {
      const serverResponse = xHRObject.responseXML;
      const header = serverResponse.getElementsByTagName("book");

      const divTag = document.getElementById("book-catalog");
      let rowString = "";
      for (idx = 0; idx < header.length; idx++) {
        const bookObj = Array.from(header[idx].childNodes).reduce(
          (prev, { nodeName, textContent }) => ({
            ...prev,
            [nodeName]: textContent,
          }),
          {}
        );

        const bookCardId = `isbn-${bookObj["isbn"]}`;
        rowString += `
          <div class="book-card">
            <div style="height=100%">
              <div class="book-card-content" id="${bookCardId}">
                <span>Book: <b id="book">${bookObj["title"]}</b></span>
                <span>ISBN: <b id="ISBN">${bookObj["isbn"]}</b></span>
                <span>Price: <b id="price">${bookObj["price"]}</b></span>
              </div>

              <button onclick="AddRemoveItem('Add', '${bookCardId}');" style="margin-top:2rem;">
                Add To Shopping Cart
              </button>
            </div>
          </div>
        `;
      }

      divTag.innerHTML = rowString;
    }
  };

  xHRObject.send();
};
