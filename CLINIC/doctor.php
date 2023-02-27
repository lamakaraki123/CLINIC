<?php 
    session_start();
    include 'common2.php';

    if(array_key_exists('vb3', $_POST)) {
        insertapp();}                                  
    else if(array_key_exists('updatedgacc', $_POST)) {
        updatedgacc();                                  
    }
    
?>

<html>
<head>
    <link rel="stylesheet" href="doctor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="doc.js"></script>
    <title>Doctor Panel</title>
</head>
<body>
        <div class="main">
            <h1 style="padding: 20px;">Medi<span class="red-span">X</span>  Clinic</h1>
            <div class="profile">
                
                <div class="profile-image"></div>
                <div class="logout-sec">
                    <h4 style="transform: translateY(-20px);">Welcome</h4> 
                    <label id="doctor" style="width:200px;position:absolute;top: 30px;font-size: x-large;">Dr. <?php echo $_SESSION["dfname"];?></label>
                    
                    <div class="profile-control">
                        
                        <i id="por" class="bi bi-person-circle fa-2x" onclick="profileview();"></i>
                        <i class="bi bi-box-arrow-left fa-2x" onclick="window.location.href='login.php';"></i>
                    </div>
                </div>  
            </div>
        </div>
        <div class="body">
            <div class="appstat">
                <?php
                    $db=@mysqli_connect('localhost','root','');
                    if (!$db) die("no connection");
                    $did=$_SESSION["did"];
                    $date=date('Y-m-d');
                    if (!@mysqli_select_db($db,'clinic')) die("no db");
                    $q="select count(App_Id) from appointment where App_Date='$date' and Doc_User_Id=$did"; 
                    $result=mysqli_query($db,$q) or die("query failed");
                    $row=mysqli_fetch_array($result);
                    $q2="select count(Visit_Id) from visit inner join appointment on visit.App_Id = appointment.App_Id where Date='$date' and Doc_User_Id=$did"; 
                    $result2=mysqli_query($db,$q2) or die("query failed");
                    $row2=mysqli_fetch_array($result2);
                    $q3="select count(Pat_User_Id) from appointment where Doc_User_Id='".$_SESSION["did"]."'"; 
                    $result3=mysqli_query($db,$q3) or die("query failed");
                    $row3=mysqli_fetch_array($result3);
                ?>
                <div class="as1">Today Apps<br><?php echo''.$row["count(App_Id)"].'';?></div>
                <div class="as1">Patients<br><?php echo''.$row3["count(Pat_User_Id)"].'';?></div>
                <div class="as1">Visits <br><?php echo''.$row2["count(Visit_Id)"].'';?></div>
            </div><br><br><br>
            <div class="menu">
                <div class="flex">
                    <div class="main-nav">
                    <i class="fa fa-home fa-fw" style="margin-right: 15px;"></i>MAIN NAVIGATION
                        </div>
                        <div class="control-center">
                            <button id="appBtn" onclick="myFunction();" class="dropbtn"><i class="fa fa-hospital-o fa-fw"></i>Appointment</button><div class="dropdown" id="dropdown">
                                <div id="myDropdown" class="dropdown-content">
                                  <button id="bookBtn" onclick="bookview();"><span class="btn-span">Book Appointment</span></button>
                                  <button id="viewBtn" onclick="appview();"><span class="btn-span">View Appointment</span></button>
                                </div>
                            </div>
                            <button id="portBtn" onclick="portview();"><i class="fa fa-user fa-fw"></i>Portfoilios</button>
                            
                        </div>
                </div>
            </div>
  
            <div class="grid-view">
                <div id="profile-sec" style="padding:25px;">
                    <?php
                    if(array_key_exists('updatepro', $_POST)) {
                        updateprofile();
                    }
                    echo '<form name="profile-form" method="POST"><fieldset><legend>MY PROFILE</legend>
                    <table>
                        <tr><td>Id : </td><td><input type="text" name="did" readonly value="'.$_SESSION["did"].'"></td></tr>
                        <tr><td>First Name : </td><td><input type="text" name="dfn" value="'.$_SESSION["dfname"].'"></td></tr>
                        <tr><td>Last Name : </td><td><input type="text" name="dln" value="'.$_SESSION["dlname"].'"></td></tr>
                        <tr><td>Email : </td><td><input type="email" name="de" value="'.$_SESSION["demail"].'"></td></tr>
                        <tr><td>Phone : </td><td><input type="tel" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000" name="dph" value="'.$_SESSION["dphone"].'"></td></tr>
                        <tr><td><input type="submit" value="Update" name="updatepro"</td></tr>
                    </table></fieldset>
                </form> ';

                echo '<form name="general-form" method="POST">
                    <fieldset class="profile-f">
                    <legend><span class="spanmy">ACCOUNT </span>INFO</legend>
                    <table>
                        <tr><td><label>Username :</label></td><td><input type="text" name="puun"  value="'.$_SESSION["dun"].'" required></td></tr>
                        <tr><td><label>Password : </label></td><td><input type="text" name="ppps" value="'.$_SESSION["dps"].'" required></td></tr>
                        <tr><td><input type="submit" value="Update" name="updatedgacc"</td></tr>
                    </table>
                    </fieldset>
                    </form> ';
                
                    ?>
                </div>

                <div id="app-sec"  style="display: none;padding:25px;">
                    <div id="book-sec">
                    <form  method="post" id="bookform">
                                <fieldset>
                                    <legend>Appointment Info.</legend>
                                    <table>
                                        <tr>
                                            <td><label>Patient Id : </label></td>
                                            <td>
                                                <input type="text" name="patientid">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Date : </label></td>
                                            <td>
                                                <input type="date" name="appdate">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Time : </label></td>
                                            <td>
                                            <select name="apptime" id="apptime" required >
                                                            <option style='color:black;' value="08:00:00">08:00</option><option style='color:black;' value="08:20:00">08:20</option>
                                                            <option style='color:black;' value="08:40:00">08:40</option><option style='color:black;' value="09:00:00">09:00</option>
                                                            <option style='color:black;' value="09:20:00">09:20</option><option style='color:black;' value="09:40:00">09:40</option>
                                                            <option style='color:black;' value="10:00:00">10:00</option><option style='color:black;' value="10:20:00">10:20</option>
                                                            <option style='color:black;' value="10:40:00">10:40</option><option style='color:black;' value="11:00:00">11:00</option>
                                                            <option style='color:black;' value="11:20:00">11:20</option><option style='color:black;' value="11:40:00">11:40</option>
                                                            <option style='color:black;' value="12:00:00">12:00</option><option style='color:black;' value="12:20:00">12:20</option>
                                                            <option style='color:black;' value="12:40:00">12:40</option><option style='color:black;' value="13:00:00">13:00</option>
                                                            <option style='color:black;' value="13:20:00">13:20</option><option style='color:black;' value="13:40:00">13:40</option>
                                                            <option style='color:black;' value="14:00:00">14:00</option><option style='color:black;' value="14:20:00">14:20</option>
                                                            <option style='color:black;' value="14:40:00">14:40</option><option style='color:black;' value="15:00:00">15:00</option>
                                                            <option style='color:black;' value="15:20:00">15:20</option><option style='color:black;' value="15:40:00">15:40</option>
                                                            <option style='color:black;' value="16:00:00">16:00</option><option style='color:black;' value="16:20:00">16:20</option>
                                                            <option style='color:black;' value="16:40:00">16:40</option><option style='color:black;' value="17:00:00">17:00</option>
                                                        </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Appointment Type : </label></td>
                                            <td>
                                            <select name="apptype">
                                            <?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select AppType_Id,Name from appointment_type "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["AppType_Id"]."'>".$row["Name"]."</option>";
                                                                            }
                                                                        ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="submit" name="vb3"/></td>
                                        </tr>
                                </table>
                                </fieldset>                   
                        </form> 
                    </div>
                    <div id="view-sec" style="padding: 25px;">
                    <form method="POST">
                        <fieldset>
                            <legend>Display : </legend>
                            <label>Date : </label><input type="date" name="appdate"><br>
                            <label>Patient Id : </label><input type="number" name="patid"><br>
                            <input type="submit" name="dbtn" value="Display By Date">
                            <input type="submit" name="vb4"  value="By Patient Id">
                            <input type="submit" name="abtn" value="Display All">
                            <input type="submit" name="tbtn" value="Today App">
                        </fieldset>
                    </form>
                    <?php 
                    if(array_key_exists('dbtn', $_POST)) {
                        displaybydateapp();                                  
                    }else if(array_key_exists('abtn', $_POST)) {
                        displayallapp();                                  
                    }else if(array_key_exists('vb4', $_POST)) {
                        displayBypid();                                  
                    }else if(array_key_exists('tbtn', $_POST)) {
                        displaytoday();                                  
                    }
                    ?>
                    </div>
                </div>
                     
                <div id="port-sec"  style="display: none;">
                <form method="POST">
                        <fieldset>
                            <legend>Search : </legend>
                            <label>Patient Id : </label><input type="number" name="ppid" placeholder="Patient Id">
                            <input type="submit" name="sppid" value="Submit">
                        </fieldset>
                    </form>
                    <?php 
                        if(array_key_exists('sppid', $_POST)) {
                            viewport();                                  
                        }else if(array_key_exists('savebtn', $_POST)) {
                            upport();                                  
                        }
                    ?>
                </div>

                
            </div>
        </div>
</body>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>
