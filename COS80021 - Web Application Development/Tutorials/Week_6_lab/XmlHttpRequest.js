var xHRObject = false;

if (window.XMLHttpRequest)
{
    xHRObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
    xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function sendRequest(data)
{
    
    xHRObject.open("GET", "display.php?id=" + Number(new Date) +"&value=" + data, false);
    xHRObject.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT' );
    xHRObject.onreadystatechange = getData;
    xHRObject.send(null); 
}

function getData()
{
    if (xHRObject.readyState == 4 && xHRObject.status == 200)
    {
        var serverText = xHRObject.responseText;

        if(serverText.indexOf('|' != -1)) 
	    {
            element = serverText.split('|');
            document.getElementById(element[0]).innerHTML = element[1];
        }
    }
}

