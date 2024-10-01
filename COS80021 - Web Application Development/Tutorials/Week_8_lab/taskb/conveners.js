

const xhr = new XMLHttpRequest();

function getResults() {
  xhr.open("POST", "conveners.php?id=" + Number(new Date()), true);
  xhr.onreadystatechange = getData;
  xhr.send(null);

}

function getData() {
  if (xhr.readyState == 4 && xhr.status == 200) {
    document.getElementById("results").innerHTML = xhr.responseText;
  }
}

const btn = document.getElementById("butt1")
btn.addEventListener("click", (ev) => {
  console.log(">>> Button Clicked");
  
  getResults();
});