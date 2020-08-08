var modal = document.getElementById("myModal");

var openModal = document.getElementsByClassName("openModal")[0];

var span = document.getElementsByClassName("closet")[0];

if(window.location.href.search("open=") != -1){
    modal.style.display = "block";
}



span.onclick = function() {
  modal.style.display = "none";
}


window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
