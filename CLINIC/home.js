
var getDayName = function(dateFormate){
    var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        date = new Date(dateFormate);
    var dayname =  days[date.getDay()];
    if (dayname == "Saturday"){
        document.getElementById("timeselect").innerHTML = "<option style='color:black;' value='09:20:00' selected>09:20</option><option style='color:black;' value='09:40:00'>09:40</option><option style='color:black;' value='10:00:00'>10:00</option><option style='color:black;' value='10:20:00'>10:20</option><option style='color:black;' value='10:40:00'>10:40</option><option style='color:black;' value='11:00:00'>11:00</option><option style='color:black;' value='11:20:00'>11:20</option><option style='color:black;' value='11:40:00'>11:40</option><option style='color:black;' value='12:00:00'>12:00</option><option style='color:black;' value='12:20:00'>12:20</option><option style='color:black;' value='12:40:00'>12:40</option><option style='color:black;' value='13:00:00'>13:00</option><option style='color:black;' value='13:20:00'>13:20</option><option style='color:black;' value='13:40:00'>13:40</option><option style='color:black;' value='14:00:00'>14:00</option><option style='color:black;' value='14:20:00'>14:20</option><option style='color:black;' value='14:40:00'>14:40</option><option style='color:black;' value='15:00:00'>15:00</option><option style='color:black;' value='15:20:00'>15:20</option><option style='color:black;' value='15:40:00'>15:40</option><option style='color:black;' value='16:00:00'>16:00</option><option style='color:black;' value='16:20:00'>16:20</option><option style='color:black;' value='16:40:00'>16:40</option><option style='color:black;' value='17:00:00'>17:00</option> ";
    }
    else{
        if(dayname == "Sunday"){
        document.getElementById("timeselect").innerHTML = "<option style='color:black;' value='10:00:00' selected>10:00</option><option style='color:black;' value='10:20:00'>10:20</option><option style='color:black;' value='10:40:00'>10:40</option><option style='color:black;' value='11:00:00'>11:00</option><option style='color:black;' value='11:20:00'>11:20</option><option style='color:black;' value='11:40:00'>11:40</option><option style='color:black;' value='12:00:00'>12:00</option><option style='color:black;' value='12:20:00'>12:20</option><option style='color:black;' value='12:40:00'>12:40</option><option style='color:black;' value='13:00:00'>13:00</option><option style='color:black;' value='13:20:00'>13:20</option><option style='color:black;' value='13:40:00'>13:40</option><option style='color:black;' value='14:00:00'>14:00</option> ";
        }
        else{
        document.getElementById("timeselect").innerHTML = "<option style='color:black;' value='08:00:00' selected>08:00</option><option style='color:black;' value='08:20:00'>08:20</option><option style='color:black;' value='08:40:00'>08:40</option><option style='color:black;' value='09:00:00'>09:00</option><option style='color:black;' value='09:20:00'>09:20</option><option style='color:black;' value='09:40:00'>09:40</option><option style='color:black;' value='10:00:00'>10:00</option><option style='color:black;' value='10:20:00'>10:20</option><option style='color:black;' value='10:40:00'>10:40</option><option style='color:black;' value='11:00:00'>11:00</option><option style='color:black;' value='11:20:00'>11:20</option><option style='color:black;' value='11:40:00'>11:40</option><option style='color:black;' value='12:00:00'>12:00</option><option style='color:black;' value='12:20:00'>12:20</option><option style='color:black;' value='12:40:00'>12:40</option><option style='color:black;' value='13:00:00'>13:00</option><option style='color:black;' value='13:20:00'>13:20</option><option style='color:black;' value='13:40:00'>13:40</option><option style='color:black;' value='14:00:00'>14:00</option><option style='color:black;' value='14:20:00'>14:20</option><option style='color:black;' value='14:40:00'>14:40</option><option style='color:black;' value='15:00:00'>15:00</option><option style='color:black;' value='15:20:00'>15:20</option><option style='color:black;' value='15:40:00'>15:40</option><option style='color:black;' value='16:00:00'>16:00</option><option style='color:black;' value='16:20:00'>16:20</option><option style='color:black;' value='16:40:00'>16:40</option><option style='color:black;' value='17:00:00'>17:00</option> ";
        }
    }
  }

  function showappdrop(){
    if(document.getElementById("appdrop").style.display == "none"){
    document.getElementById("appdrop").style.display = "block";}
    else{
        document.getElementById("appdrop").style.display = "none";
    }
  }

  function hidealert(){
        document.getElementById("appalert").style.display = "none";
  }

  function alertapp(a){
    var c = a;
    if(c == 0){
        alert('0');
        document.getElementById("appalert").style.display = "block";
        document.getElementById("alerttext").innerHTML = "Appointment Avaliable";
        document.getElementById("makeb").style.visibility = "visible";
    }
    else{
        alert(c);
        document.getElementById("appalert").style.display = "block";
        document.getElementById("alerttext").innerHTML = "Appointment Unavaliable";
        document.getElementById("makeb").style.visibility = "hidden";
    }
  }