
function viewacc(){
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("visitt-sec").style.display = 'none';
    document.getElementById("popup").style.display = 'none';
    document.getElementById("pup2").style.display = 'none';
    document.getElementById("fees-sec").style.display = "none";
    document.getElementById("patient-sec").style.display = "none";
    document.getElementById("app-sec").style.display = "none";
    document.getElementById("doctor-sec").style.display = "none";
    document.getElementById("add-sec").style.display = "none";
    document.getElementById("acc-sec").style.display = "block";
    document.getElementById("accview-sec").style.display = "block";
    document.getElementById("macc-sec").style.display = "none";
    document.getElementById("pup3").style.display = "none";
    document.getElementById("accdrop").style.display = "none";
}
function showaccdrop(){
  if(document.getElementById("accdrop").style.display == "block"){
    document.getElementById("accdrop").style.display = "none";
  }
  else{
  document.getElementById("accdrop").style.display = "block";
  }
}

function accman(){
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("visitt-sec").style.display = 'none';
    document.getElementById("popup").style.display = 'none';
    document.getElementById("pup2").style.display = 'none';
    document.getElementById("fees-sec").style.display = "none";
    document.getElementById("patient-sec").style.display = "none";
    document.getElementById("app-sec").style.display = "none";
    document.getElementById("doctor-sec").style.display = "none";
    document.getElementById("add-sec").style.display = "none";
    document.getElementById("acc-sec").style.display = "block";
    document.getElementById("accview-sec").style.display = "none";
    document.getElementById("macc-sec").style.display = "block";
    document.getElementById("pup3").style.display = "none";
    document.getElementById("accdrop").style.display = "none";
}

function AddUser() {
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("visitt-sec").style.display = 'none';
    document.getElementById("acc-sec").style.display = "none";
    document.getElementById("popup").style.display = 'none';
    document.getElementById("pup2").style.display = 'none';
    document.getElementById("fees-sec").style.display = "none";
    document.getElementById("patient-sec").style.display = "none";
    document.getElementById("app-sec").style.display = "none";
    document.getElementById("doctor-sec").style.display = "none";
    document.getElementById("add-sec").style.display = "block";
    document.getElementById("accdrop").style.display = "none";

}
function showinfo(){
     
    if (document.getElementById("type").value == 1) {
      document.getElementById("doctorinfo").style.display = 'none';
      document.getElementById("patientinfo").style.display = 'block';
    } 
    else{
      if (document.getElementById("type").value == 2){
        document.getElementById("patientinfo").style.display = 'none';
        document.getElementById("doctorinfo").style.display = 'block';
      }
      else{
        document.getElementById("patientinfo").style.display = 'none';
        document.getElementById("doctorinfo").style.display = 'none';
      }
    }
}


function bookview(){
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("visitt-sec").style.display = 'none';
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("popup").style.display = 'none';
  document.getElementById("pup2").style.display = 'none';
  document.getElementById("fees-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "none";
  document.getElementById("doctor-sec").style.display = "none";
  document.getElementById("app-sec").style.display = "block";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("viewapp-sec").style.display = "none";
  document.getElementById("bookapp-sec").style.display = "block";
  document.getElementById("accdrop").style.display = "none";
}

function appview(){
  document.getElementById("accdrop").style.display = "none";
  document.getElementById("visitt-sec").style.display = 'none';
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("popup").style.display = 'none';
  document.getElementById("pup2").style.display = 'none';
  document.getElementById("fees-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "none";
  document.getElementById("doctor-sec").style.display = "none";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("app-sec").style.display = "block";
  document.getElementById("viewapp-sec").style.display = "block";
  document.getElementById("bookapp-sec").style.display = "none";
  document.getElementById("extra-sec").style.display = "none";
}

function doctorview(){
  document.getElementById("visitt-sec").style.display = 'none';
  document.getElementById("accdrop").style.display = "none";
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("pup2").style.display = 'none';
  document.getElementById("fees-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "none";
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("doctor-sec").style.display = "block";
}

function patview(){document.getElementById("visitt-sec").style.display = 'none';
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("popup").style.display = 'none';
  document.getElementById("fees-sec").style.display = "none";
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("accdrop").style.display = "none";
  document.getElementById("doctor-sec").style.display = "none";
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "block";
}

function feesview(){document.getElementById("visitt-sec").style.display = 'none';
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("popup").style.display = 'none';
  document.getElementById("pup2").style.display = 'none';
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("doctor-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "none";
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("accdrop").style.display = "none";
  document.getElementById("fees-sec").style.display = "block";
}
function visittview(){
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("popup").style.display = 'none';
  document.getElementById("pup2").style.display = 'none';
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("accdrop").style.display = "none";
  document.getElementById("doctor-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "none";
  document.getElementById("fees-sec").style.display = "none";
  document.getElementById("extra-sec").style.display = "none";
  document.getElementById("visitt-sec").style.display = "block";
}
function extraview(){
  document.getElementById("acc-sec").style.display = "none";
  document.getElementById("popup").style.display = 'none';
  document.getElementById("pup2").style.display = 'none';
  document.getElementById("app-sec").style.display = "none";
  document.getElementById("add-sec").style.display = "none";
  document.getElementById("doctor-sec").style.display = "none";
  document.getElementById("patient-sec").style.display = "none";
  document.getElementById("fees-sec").style.display = "none";
  document.getElementById("visitt-sec").style.display = "none";
  document.getElementById("accdrop").style.display = "none";
  document.getElementById("extra-sec").style.display = "block";
}




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

  function validateform() {
    var t = document.getElementById("type").value;
    var a =document.forms["form1"]["pfname"].value;
    var b =document.forms["form1"]["plname"].value;
    var c =document.forms["form1"]["pphone"].value;
    var d =document.forms["form1"]["pemail"].value;
    var e =document.forms["form1"]["dob"].value;
    var f =document.forms["form1"]["gender"].value;
    var g =document.forms["form1"]["dfname"].value;
    var h =document.forms["form1"]["dlname"].value;
    var i =document.forms["form1"]["demail"].value;
    var j =document.forms["form1"]["dphone"].value;
    var k =document.forms["form1"]["speciality"].value;
    var l =document.forms["form1"]["city"].value;

    if(t == "1"){
      if(a == "" ||b == ""||c == ""||d == ""||e == ""||f == ""||l == ""||a == null ||b == null ||c == null ||d == null ||e == null ||f == null ||l == null){
        alert("fill empty fields!!!!");  
        return false;
      }
    }
    else{
      if(g == "" ||h == ""||i == ""||j == ""||k == ""||g == null ||h == null ||i == null ||j == null ||k == null){
        alert("fill empty fields!!!!");
        return false;
      }
    }
  }

  function showpop(){
    
    document.getElementById("popup").style.display = "block";
}

function hidepop(){
    
    document.getElementById("popup").style.display = "none";
}

function showpop2(){
    
  document.getElementById("pup2").style.display = "block";
}

function hidepop2(){
  
  document.getElementById("pup2").style.display = "none";
}

function showpop3(){
    
  document.getElementById("pup3").style.display = "block";
}

function hidepop3(){
  
  document.getElementById("pup3").style.display = "none";
}

function updoc(x) {
  document.getElementById("doc-up-id").value= x;
  
}

function uppat(x) {
  document.getElementById("pat-up-id").value= x;
}

function upacc(x) {
  document.getElementById("acc-id").value= x;
}