function makeRequest() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "temperature.xml", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var xmlDoc = xhr.responseXML;
            displayTemperatureData(xmlDoc);
        }
    };
    xhr.send();
}

function displayTemperatureData(xmlDoc) {
    var days = xmlDoc.getElementsByTagName("day");
    var resultDiv = document.getElementById("result");
    var output = "";
    var totalTemp = 0;

    for (var i = 0; i < days.length; i++) {
        var day = days[i].getElementsByTagName("Day")[0].childNodes[0].nodeValue;
        var month = days[i].getElementsByTagName("Month")[0].childNodes[0].nodeValue;
        var year = days[i].getElementsByTagName("Year")[0].childNodes[0].nodeValue;
        var temp = parseFloat(days[i].getElementsByTagName("MaxTemperature")[0].childNodes[0].nodeValue);
        totalTemp += temp;
        
        output += day + "/" + month + "/" + year + " : " + temp + "<br>";
    }

    var avgTemp = totalTemp / days.length;
    output += "<br>Average temperature is : " + avgTemp.toFixed(2);

    resultDiv.innerHTML = output;
}
