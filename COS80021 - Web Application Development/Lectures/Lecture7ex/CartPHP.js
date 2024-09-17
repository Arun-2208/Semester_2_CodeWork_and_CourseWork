var xHRObject = false;
if (window.XMLHttpRequest)
{
xHRObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}


function getData()
{
    if ((xHRObject.readyState == 4) &&(xHRObject.status == 200))
    {
		//alert(xHRObject.responseXML);
		//alert(xHRObject.responseText);
        var serverResponse = xHRObject.responseXML;
        var header = serverResponse.getElementsByTagName("book");
        var spantag = document.getElementById("cart");
        spantag.innerHTML = "";
		//if(header!=null){
			for (i=0; i<header.length; i++)
			{
			   
			if (window.ActiveXObject)
			{
				 spantag.innerHTML += " " +header[0].firstChild.text;
				 spantag.innerHTML += " " + header[0].lastChild.text + " " + "<a href='#' onclick='AddRemoveItem(\"Remove\");'>Remove Item</a>";
			}
			else
			{
				 spantag.innerHTML += " " +header[0].firstChild.textContent;
				 spantag.innerHTML += " " + header[0].lastChild.textContent + " " + "<a href='#' onclick='AddRemoveItem(\"Remove\");'>Remove Item</a>";
			}
			
		//}
        
       }
    }
}

function AddRemoveItem(action)
{
          var book  = document.getElementById("book").innerHTML;
           
          if(action=="Add")
          {
            xHRObject.open("GET", "ManageCart.php?action=" + action + "&book=" + encodeURIComponent(book) + "&value=" + Number(new Date), true);
          }
          else
          {
           xHRObject.open("GET", "ManageCart.php?action=" + action + "&book=" + encodeURIComponent(book) + "&value="  + Number(new Date), true);
          }

          xHRObject.onreadystatechange = getData;
          xHRObject.send(null);   
}



