function profileview(){
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("port-sec").style.display = "none";
  document.getElementById("profile-sect").style.display = "block";
}
function bookview(){
  document.getElementById("app-sec").style.display = "block";
  document.getElementById("book-sec").style.display = "block";
  document.getElementById("view-sec").style.display = "none";
  document.getElementById("port-sec").style.display = "none";
  document.getElementById("profile-sect").style.display = "none";
}
function appview(){
  document.getElementById("app-sec").style.display = "block";
  document.getElementById("book-sec").style.display = "none";
  document.getElementById("view-sec").style.display = "block";
  document.getElementById("port-sec").style.display = "none";
  document.getElementById("profile-sect").style.display = "none";
}
function portview(){
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("port-sec").style.display = "block";
  document.getElementById("profile-sect").style.display = "none";
}


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  document.getElementById("dropdown").style.display="block";
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


  