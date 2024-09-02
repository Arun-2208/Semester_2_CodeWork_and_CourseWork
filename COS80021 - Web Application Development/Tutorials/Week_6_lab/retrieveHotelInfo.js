var xHRObject = false;

if (window.XMLHttpRequest) {
    xHRObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function retrieveInformation() {
    var city = document.getElementById("selectCity").value;
    var type = document.querySelector('input[name="range"]:checked').value;

    xHRObject.open("GET", "retrieveHotelInfo.php?city=" + city + "&type=" + type, true);
    xHRObject.onreadystatechange = displayHotels;
    xHRObject.send(null);
}

function displayHotels() {
    if (xHRObject.readyState == 4 && xHRObject.status == 200) {
        var xmlDocument = xHRObject.responseXML;

        if (!xmlDocument) {
            document.getElementById("information").innerHTML = "Error: Invalid XML format.";
            console.error("Error: The response is not a valid XML document.");
            return;
        }

        var hotels = xmlDocument.getElementsByTagName("hotel");

        // Convert HTMLCollection to an array for sorting
        hotels = Array.from(hotels);

        // Sort hotels by price (increasing order)
        hotels.sort(function (a, b) {
            var priceA = parseInt(a.getElementsByTagName("Price")[0].textContent);
            var priceB = parseInt(b.getElementsByTagName("Price")[0].textContent);
            return priceA - priceB;
        });

        var output = "";
        for (var i = 0; i < hotels.length; i++) {
            var hotelName = hotels[i].getElementsByTagName("Name")[0].textContent;
            var hotelPrice = hotels[i].getElementsByTagName("Price")[0].textContent;
            output += "Hotel: " + hotelName + ", Price: $" + hotelPrice + "<br>";
        }

        document.getElementById("information").innerHTML = output;
    }
}
