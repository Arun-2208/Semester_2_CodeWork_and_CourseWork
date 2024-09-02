var xHRObject = false;

if (window.XMLHttpRequest)
    xHRObject = new XMLHttpRequest();
else if (window.ActiveXObject)
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");

function retrieveInformation() 
{
	var city = document.getElementById("selectCity").value;
	var type = "";
	var input = document.getElementsByTagName("input");
	for (var i=0; i < input.length; i++)
	{ 
	    if (input.item(i).checked == true)
	        type = input.item(i).value;
	}
      xHRObject.open("GET", "retrieveHotelInfo.php?id=" + Number(new Date) +"&city=" + city + "&type=" + type, true);
      xHRObject.onreadystatechange = function() {
           if (xHRObject.readyState == 4 && xHRObject.status == 200)
               document.getElementById('information').innerHTML = xHRObject.responseText;
      }
      xHRObject.send(null); 
}









