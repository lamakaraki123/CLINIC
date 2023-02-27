<?php 
    session_start();
    include 'adminfun.php';
?>

<html>
<head>
    
    <link rel="stylesheet" href="admin1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="admin.js"></script>
    <title>Admin Panel</title>
</head>
<body>
        <div class="main">
            <h1 style="padding: 20px;">Medi<span class="red-span">X</span>  Clinic</h1>
            <div class="profile">
                
                <div class="profile-image"></div>
                <div class="logout-sec">
                    <h4 style="transform: translateY(-20px);">Welcome</h4> 
                    <label id="admin" style="position: absolute;top: 30px;font-size: x-large;">Admin</label>
                    <div class="profile-control">
                        <i class="bi bi-box-arrow-left fa-2x" onclick="window.location.href='login.php';"></i>
                    </div>
                </div>  
            </div>
        </div>
        <div class="body">
            <div class="menu">
                <div class="flex">
                    <div class="main-nav">
                    <i class="fa fa-home fa-fw" style="margin-right: 15px;"></i>MAIN NAVIGATION
                        </div>
                        <div class="control-center">
                            <button  id="accBtn" onclick="showaccdrop();"><i class="fa fa-at fa-fw"></i>Accounts</button>
                            <button  id="addBtn" onclick="AddUser();"><i class="fa fa-user-plus fa-fw"></i>Add User</button>
                            <button id="appBtn" onclick="myFunction();" class="dropbtn"><i class="fa fa-hospital-o fa-fw"></i>Appointment</button><div class="dropdown" id="dropdown">
                                <div id="myDropdown" class="dropdown-content">
                                  <button id="bookBtn" onclick="bookview();"><span class="btn-span">Book Appointment</span></button>
                                  <button id="viewBtn" onclick="appview();"><span class="btn-span">View Appointment</span></button>
                                </div>
                            </div>
                            <button id="patientBtn" onclick="patview();"><i class="fa fa-user fa-fw"></i>Patients</button>
                            <button id="doctorBtn" onclick="doctorview();"><i class="fa fa-user-md fa-fw"></i>Doctors</button>
                            <button id="feesBtn" onclick="feesview();"><i class="fa fa-dollar fa-fw"></i>Update Fees</button>
                            <button id="visitBtn" onclick="visittview();"><i class="fa fa-check-square fa-fw"></i>Visits</button>
                            <button id="extraBtn" onclick="extraview();"><i class="fa fa-plus-square fa-fw"></i>Extra</button>
                        </div>
                </div>
            </div>
            <div class="accdrop" id="accdrop" style="display: none;">
                <button id="vaccbtn" onclick="viewacc();"><span class="btn-span">View Accounts</span></button>
                <button id="maccbtn" onclick="accman();"><span class="btn-span">Manage Accounts</span></button>
            </div>
            
            <div class="grid-view">
            
            <div class="acc-sec" id="acc-sec" style="display: none;padding: 25px;border-radius: 25px;margin: 20px;color: rgb(10, 36, 59);">
                    <div class="accview-sec" id="accview-sec">
                    <?php 
                            if(array_key_exists('delete-account', $_POST)) {
                                deleteacc1();    
                            }
                            else if(array_key_exists('update-acc', $_POST)) {
                                updateacc();
                            }else if(array_key_exists('delete-daccount', $_POST)) {
                                deleteddacc();    
                            }
                            
                        $db=@mysqli_connect('localhost','root','');
                        if (!$db) die("no connection");
                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                        $q="select * from account inner join accounttype on account.Type_Id = accounttype.Type_Id where Activision='A'";

                        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
                        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=70%><tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Type</th>
                                        <th>User Id</th>
                                        <th>Activity</th>
                                        </tr>";
                        while ($row=mysqli_fetch_array($result)){ 
                        echo "<tr><td>".$row["Username"]."</td><td>".$row["Password"]."</td><td>".$row["Type_Name"]."</td><td>".$row["User_Id"]."</td><td>".$row["Activision"]."</td>";
                        echo '<td style="padding-top:18px; >
                        <form method="POST" style="display:none;"></form>
                        
                        <form method="POST"  style="display:inline-block;"><input type="hidden" name="hidden6" value="'.$row["User_Id"].'">
                        <input type="hidden" name="typehidden" value="'.$row["Type_Id"].'">
                        <input type="submit" name="delete-daccount" value="Delete" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;">
                        </form>
                        <button name="update-acc" onclick="showpop3();" onmouseover="upacc('.$row["User_Id"].');" style="margin-left:20px;background-color:blue;color:white;width:80px;cursor:pointer;border-radius:6px;">Update</button></td></tr>';
                        }
                        echo "</table>";
                        echo "<script>window.onload = function(){
                            document.getElementById('vaccbtn').click();
                            }</script>";
                    ?>
                        <div class="popup" id="pup3" style=" padding:20px;background-color: #eee;position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);width: 50%;height: 50%;color: white;display: none;">
                            <button  onclick="hidepop3();" style="position:absolute;right:20px;">X</button>
                            <form method="post" name="updatedocform" >
                            <table>
                                    <tr><td><input name="acc-id" id="acc-id" type="hidden" required></td></tr>
                                    <tr><td><label>Username : </label></td><td><input name="acc-up-un" id="acc-up-un" type="text" required></td></tr>
                                    <tr><td><label>Password : </label></td><td><input name="acc-up-ps" id="acc-up-ps" type="text" required></td></tr>
                                    <tr><td><input type="submit" value="SUBMIT" name="update-acc"></td></tr>
                            </table>
                            </form>
                        </div>
                    </div>
                    <div class="macc-sec" id="macc-sec">
                        <?php
                        
                         if(array_key_exists('activate-account', $_POST)) {
                            activateddacc();    
                        }else if(array_key_exists('delete-daccount', $_POST)) {
                            deleteddacc();    
                        }


                    $db=@mysqli_connect('localhost','root','');
                        if (!$db) die("no connection");
                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                        $q="select * from account inner join accounttype on account.Type_Id = accounttype.Type_Id where Activision='D' and account.Type_Id=2";

                        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
                        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Type</th>
                                        <th>User Id</th>
                                        <th></th
                                        </tr>";
                        while ($row=mysqli_fetch_array($result)){ 
                        echo "<tr><td>".$row["Username"]."</td><td>".$row["Password"]."</td><td>".$row["Type_Name"]."</td><td>".$row["User_Id"]."</td>";
                        echo '<td style="padding-top:18px; >
                        <form method="POST" style="display:none;"></form>

                        <form method="POST"  style="display:inline-block;"><input type="hidden" name="hidden18" value="'.$row["User_Id"].'">
                        <input type="submit" name="delete-daccount" value="Delete" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;">
                        <input type="submit" name="activate-account" value="Activate" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;">
                        </form>
                        </td></tr>';
                        }
                        echo "</table>";
                        echo "<script>window.onload = function(){
                            document.getElementById('maccbtn').click();
                            }</script>";
                    ?>
                    </div>
                </div>
                <div class="add-sec" id="add-sec">
                    
                        
                                    <form  method="POST" id="AddForm" name="form1" onsubmit="return validateform();">
                                        <fieldset class="accountinfo">
                                            <legend>Account Info : </legend>
                                            <table>
                                                <tr>
                                                    <td><label>Enter Username :</label></td>
                                                    <td><input type="text" name="username" required/></td>
                                                </tr>
        
                                                <tr>
                                                    <td><label>Enter Password :</label></td>
                                                    <td><input type="text" name="pass" id="pass" required/></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Select User Type : </label></td>
                                                    <td>
                                                        <select name="type" id="type" onchange="showinfo();">
                                                            <option value="0">None</option>
                                                            <option value="1">Patient</option>
                                                            <option value="2">Doctor</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                               
                                            </table>
                                        </fieldset>
                                        <fieldset id="patientinfo">
                                            <legend>Personal Info : </legend>
                                            <table>
                                                <tr>
                                                    <td><label>First Name :</label></td>
                                                    <td><input type="text" name="pfname"/></td>
                                                </tr>
        
                                                <tr>
                                                    <td><label>Last Name :</label></td>
                                                    <td><input type="text" name="plname"/></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Phone Number :</label></td>
                                                    <td><input type="tel" name="pphone" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000"/></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Email : </label></td>
                                                    <td>
                                                        <input type="email" name="pemail">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Date Of Birth : </label></td>
                                                    <td>
                                                        <input type="date" name="dob">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Gender : </label></td>
                                                    <td>
                                                        <input type="radio" name="gender"  value="M">Male
                                                        <input type="radio" name="gender"  value="F">Female
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>City : </label></td>
                                                    <td><select name="city" ><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select * from city "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["City_Id"]."'>".$row["City_Name"]."</option>";
                                                                            }
                                                                        ?></select></td>
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr>
                                                <td><input type="reset"  name="reset1" value="Reset"/>&nbsp;<input type="submit"  name="pb1" "/></td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                        <fieldset id="doctorinfo">
                                            <legend>Doctor Info : </legend>
                                            <table>
                                                <tr>
                                                    <td><label>First Name :</label></td>
                                                    <td><input type="text" name="dfname" /></td>
                                                </tr>
        
                                                <tr>
                                                    <td><label>Last Name :</label></td>
                                                    <td><input type="text" name="dlname"/></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Phone Number :</label></td>
                                                    <td><input type="tel" name="dphone" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000"/></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Email : </label></td>
                                                    <td>
                                                        <input type="email" name="demail">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Speciality : </label></td>
                                                    <td><select name="speciality"><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select * from specialization "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["Speciality_Id"]."'>".$row["Speciality_Name"]."</option>";
                                                                            }
                                                                        ?></select></td>
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr>
                                                <td><input type="reset"  name="reset1" value="Reset"/>&nbsp;<input type="submit" name="db1"></td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                        
                                    </form>
                                    <?php 
                                        $db=@mysqli_connect('localhost','root','');
                                        if (!$db) die("no connection");
                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                        //    PATIENT INSERTION BY ADMIN
                                        if(isset($_POST['pb1'])){
                                            $un = $_POST['username'];
                                            $pass = $_POST['pass'];
                                            $t = $_POST['type'];
                                            $pf = ucfirst($_POST['pfname']);
                                            $pl = ucfirst($_POST['plname']);
                                            $pe = $_POST['pemail'];
                                            $pp = $_POST['pphone'];
                                            $g = ucfirst($_POST['gender']);
                                            $city = $_POST['city'];
                                            $dob = $_POST['dob'];

                                            $w="select * from Account where Username='$un'";
                                            $result=mysqli_query($db,$w) or die("Account Insertion Falied");
                                            if (mysqli_num_rows($result) > 0){
                                                echo "<script>alert('Username Taken !!!!!')</script>";
                                                            }
                                                            else
                                                            {
                                                                
                                                                 //insert user account
                                                            $q="insert into Account(Username,Password,Type_Id,Activision) values('$un','$pass',$t,'A') ";
                                                            mysqli_query($db,$q) or die("Account Insertion Falied");
                                                            // get user id to add into patient as foreign key
                                                            $suid="select User_Id from Account where Username='$un'";
                                                            $suidr=mysqli_query($db,$suid);
                                                            $row=mysqli_fetch_array($suidr);
                                                            $uid=$row['User_Id'];
                                                            //insert user into patient after inserting account
                                                            $psql="insert into Patient(User_Id,Pfname,Plname,Pemail,Pphone,DOB,Gender,City_Id) values($uid,'$pf','$pl','$pe','$pp','$dob','$g',$city) ";
                                                            mysqli_query($db,$psql) or die("Patient Insertion Falied");
                                                        
                                                            // insert pid into portfoilo after inserting patient
                                                            $ppsql="Insert into Patient_Portfolio(User_Id) values($uid)";
                                                            mysqli_query($db,$ppsql) or die("Portfoilio Insertion Falied");
                                                            
                                                            
                                                            echo "<script>window.onload = function(){
                                                                document.getElementById('addBtn').click();
                                                                alert('Patient added ');
                                                                }</script>";
                                                            }
                                                                
                                        }
                                        //   DOCTOR INSERTION BY ADMIN
                                        if(isset($_POST['db1'])){
                                            $un = $_POST['username'];
                                            $pass = $_POST['pass'];
                                            $t = $_POST['type'];
                                            $df = ucfirst($_POST['dfname']);
                                            $dl = ucfirst($_POST['dlname']);
                                            $de = $_POST['demail'];
                                            $dp = $_POST['dphone'];
                                            $s = $_POST['speciality'];

                                            $w="select * from Account where Username='$un'";
                                            $result=mysqli_query($db,$w) or die("Account Insertion Falied");
                                            if (mysqli_num_rows($result) > 0){
                                                echo "<script>alert('Username Taken !!!!!')</script>";
                                                            }
                                                            else
                                                            {
                                                            //insert user account
                                                            $q="insert into Account(Username,Password,Type_Id,Activision) values('$un','$pass',$t,'A') ";
                                                            mysqli_query($db,$q) or die("Account Insertion Falied");
                                                            // get user id to add into doctor as foreign key
                                                            $suid="select User_Id from Account where Username='$un'";
                                                            $suidr=mysqli_query($db,$suid);
                                                            $row=mysqli_fetch_array($suidr);
                                                            $uid=$row['User_Id'];
                                                            //insert user into doctor after inserting account
                                                            $dsql="insert into Doctor(User_Id,Dfname,Dlname,Demail,Dphone,Speciality_Id) values($uid,'$df','$dl','$de','$dp',$s) ";
                                                            mysqli_query($db,$dsql) or die("Doctor Insertion Falied");
                                                            
                                                            echo "<script>window.onload = function(){
                                                                document.getElementById('addBtn').click();
                                                                alert('Doctor added ');
                                                                }</script>";
                                                            
                                        }
                                    }
                                    
                                    ?>
                                    
                </div>
                <div class="app-sec" id="app-sec">
                    <div id="bookapp-sec">
                        <form  method="post" id="bookform" name="bookform">
                                <fieldset>
                                    <legend>Appointment Info.</legend>
                                    <table>
                                        <tr>
                                            <td><label>Patient Id : </label></td>
                                            <td>
                                                <input type="number" name="patientid" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Doctor : </label></td>
                                            <td>
                                            <select name="doctorname" required>
                                            <?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select * from doctor inner join account on account.User_Id = doctor.User_Id where Activision='A' "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["User_Id"]."'>".$row["Dfname"]."</option>";
                                                                            }
                                                                        ?>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Date : </label></td>
                                            <td>
                                                <input type="date" name="appdate" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Time : </label></td>
                                            <td>
                                                <select name="apptime">
                                                    <option value="08:00:00">08:00</option><option value="08:20:00">08:20</option>
                                                    <option value="08:40:00">08:40</option><option value="09:00:00">09:00</option>
                                                    <option value="09:20:00">09:20</option><option value="09:40:00">09:40</option>
                                                    <option value="10:00:00">10:00</option><option value="10:20:00">10:20</option>
                                                    <option value="10:40:00">10:40</option><option value="11:00:00">11:00</option>
                                                    <option value="11:20:00">11:20</option><option value="11:40:00">11:40</option>
                                                    <option value="12:00:00">12:00</option><option value="12:20:00">12:20</option>
                                                    <option value="12:40:00">12:40</option><option value="13:00:00">13:00</option>
                                                    <option value="13:20:00">13:20</option><option value="13:40:00">13:40</option>
                                                    <option value="14:00:00">14:00</option><option value="14:20:00">14:20</option>
                                                    <option value="14:40:00">14:40</option><option value="15:00:00">15:00</option>
                                                    <option value="15:20:00">15:20</option><option value="15:40:00">15:40</option>
                                                    <option value="16:00:00">16:00</option><option value="16:20:00">16:20</option>
                                                    <option value="16:40:00">16:40</option><option value="17:00:00">17:00</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Appointment Type : </label></td>
                                            <td>
                                            <select name="apptype" required>
                                            <?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select AppType_Id,Name from appointment_type "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["AppType_Id"]."'>".$row["Name"]."</option>";
                                                                            }
                                                                        ?>
                                            </select>
                                            </td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td><input type="submit" name="b3"/></td>
                                        </tr>
                                </table>
                                </fieldset>                   
                        </form> 
                        <?php
                        
                    
                            $db=@mysqli_connect('localhost','root','');
                            if (!$db) die("no connection");
                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                            if(isset($_POST['b3'])){
                            $a=$_POST['patientid'];
                            $b=$_POST['doctorname'];
                            $c=$_POST['apptype'];
                            $d=$_POST['appdate'];
                            $e=$_POST['apptime'];
                                if($d > date('Y-m-d')){
                            
                                $q="insert into appointment(Pat_User_Id,Doc_User_Id,AppType_Id,App_Date,App_Time,App_Status) values($a,$b,$c,'$d','$e','Pending') ";
            
                            mysqli_query($db,$q) or die("query failed");
                            echo "<script>window.onload = function(){
                                document.getElementById('bookBtn').click();
                                }</script>";
                            }
                            else{
                                echo'<script>alert("Entered date is invalid !!!!")</script>';
                                echo "<script>window.onload = function(){
                                    document.getElementById('bookBtn').click();
                                    }</script>";
                            }
                            } 
                                            
                            ?>
                    </div>
                    <div id="viewapp-sec">
                                 <form name="searchform" method="POST">
                                    <fieldset>
                                        <legend>Search : </legend>                                   
                                            <label>Doctor Name : </label><select name="nameselect" ><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select * from doctor inner join account on account.User_Id = doctor.User_Id where Activision='A'"; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["User_Id"]."'>".$row["Dfname"]."</option>";
                                                                            }
                                                                        ?>
                                                                        </select>
                                                                        <label>Date : </label><input type="date" name="datesearch"><br><br>
                                                                        <label>Patient Id : </label><input type="number" name="patid">
                                                                        <label>App Status : </label><select name="sapptype"><option value="Pending">Pending</option>
                                                                        <option value="Visited">Visited</option>
                                                                        <option value="Approved">Approved</option>
                                                                        <option value="Canceled">Canceled</option></select>
                                            <br><br><input type="submit" name="vb1" value="Search By Doctor Name">
                                            <input type="submit" name="vb2" value="Search By Date">
                                            <input type="submit" name="vb3" id="disBtn" value="Display ALL">
                                            <input type="submit" name="vb4"  value="By Patient Id">
                                            <input type="submit" name="vb6"  value="by status">
                                            <input type="submit" name="vb5"  value="D&D">
                                            
                                            
                                    </fieldset>
                                </form>
                                
                                
                                
                                <?php
                                if(array_key_exists('vb1', $_POST)) {
                                    displayByDoctor();
                                }
                                else if(array_key_exists('vb5', $_POST)) {
                                    displayBoth();                                  
                                }
                                else if(array_key_exists('vb2', $_POST)) {
                                    displayByDate();                                  
                                }
                                else if(array_key_exists('vb3', $_POST)) {
                                    displayAll();                                  
                                }
                                else if(array_key_exists('cancel-app', $_POST)) {
                                    cancelapp();                                  
                                }
                                else if(array_key_exists('approve-app', $_POST)) {
                                    approveapp();                                  
                                }
                                else if(array_key_exists('visit-app', $_POST)) {
                                    visitapp();                                  
                                }else if(array_key_exists('vb4', $_POST)) {
                                    displayBypid();                                  
                                }else if(array_key_exists('vb6', $_POST)) {
                                    displayBystatus();                                  
                                }
                                
                                                             
                        ?>
                    </div>
                </div>
                <div id="doctor-sec">
                <?php
                        if(array_key_exists('delete-doc', $_POST)) {
                            deletedacc();
                            deletedoc();    
                        }
                        else if(array_key_exists('delete-pat', $_POST)) {
                            deletepacc();
                            deletepat();
                        }
                        else if(array_key_exists('update-doc', $_POST)) {
                            updatedoc();                         
                        }
                        else if(array_key_exists('update-pat', $_POST)) {
                            updatepat();    
                        }else if(array_key_exists('deacc', $_POST)) {
                            deddacc();    
                        }
                        
                        
                        
                   ?>
                   <?php
                    $db=@mysqli_connect('localhost','root','');
                    if (!$db) die("no connection");
                    if (!@mysqli_select_db($db,'clinic')) die("no db");
                    $q="select * from doctor inner join specialization on doctor.Speciality_Id = specialization.Speciality_Id inner join account on account.User_Id = doctor.User_Id where Activision='A' ";
    
                        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
                        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                                        <th>Doc_Id</th>
                                        <th>Fname</th>
                                        <th>Lname</th>
                                        <th>Specality</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        
                                        <th></th>
                                        <th></th>
                                        </tr>";
                        while ($row=mysqli_fetch_array($result)){ 
                            
                        echo"<tr><td>".$row["User_Id"].'</td><td>'.$row["Dfname"].'</td><td>'.$row["Dlname"].'</td><td>'.$row["Speciality_Name"].'</td>
                            <td>'.$row["Demail"].'</td><td>'.$row["Dphone"].'</td>';
                            echo '<td style="padding-top:18px;"><form method="POST">
                            <input type="submit" name="delete-doc" value="Delete"  style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;">
                            <input type="hidden" name="de-acc" value="Deactivate"  >
                            <input type="submit" name="deacc" value="Deactivate"  style="background-color:rgb(110,26,26);color:white;width:100px;cursor:pointer;border-radius:6px;">
                            <input type="hidden" name="hidden100" value="'.$row["User_Id"].'">
                            </form></td><td>
                            <button  onclick="showpop();" onmouseover="updoc('.$row["User_Id"].');" style="background-color:blue;color:white;width:80px;cursor:pointer;border-radius:6px;" >Update</button></td></tr>';
                        }
                        echo "</table>";
    
                    ?>    
                    <div class="popup" id="popup" style=" padding:20px;background-color: #eee;position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);width: 50%;height: 50%;color: white;display:block ;">
                        <button  onclick="hidepop();"  style="position:absolute;right:20px;">X</button>
                        <form method="post" name="updatedocform" >
                           <table>
                                <tr><td><input name="doc-up-id" id="doc-up-id" type="hidden" ></td></tr>
                                <tr><td><label>First Name : </label></td><td><input name="doc-up-fn" id="doc-up-fn" type="text" required></td></tr>
                                <tr><td><label>Last Name : </label></td><td><input name="doc-up-ln" id="doc-up-ln" type="text" required></td></tr>
                                <tr><td><label>Email : </label></td><td><input name="doc-up-em" id="doc-up-em" type="email" required></td></tr>
                                <tr><td><label>Phone : </label></td><td><input name="doc-up-ph" id="doc-up-ph" type="tel" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000"required></td></tr>
                                <tr><td><label>Speciality : </label></td><td><select name="doc-up-sp"><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select Speciality_Id,Speciality_Name from specialization "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["Speciality_Id"]."'>".$row["Speciality_Name"]."</option>";
                                                                            }
                                                                        ?></select></td></tr>
                                <tr><td><input type="submit" value="SUBMIT" name="update-doc"></td></tr>
                           </table>
                        </form>
                    </div>    
                </div>
                
                <div id="patient-sec">
                <?php
                                $db=@mysqli_connect('localhost','root','');
                                if (!$db) die("no connection");
                                if (!@mysqli_select_db($db,'clinic')) die("no db");
                                $q="select * from patient inner join city on patient.City_Id = city.City_Id";
                                

                                $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
                                echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                                                <th>Patient Id</th>
                                                <th>Fname</th>
                                                <th>Lname</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>City</th>
                                                <th></th>
                                                </tr>";
                                while ($row=mysqli_fetch_array($result)){ 
                                echo "<tr><td>".$row["User_Id"]."</td><td>".$row["Pfname"]."</td><td>".$row["Plname"]."</td><td>".$row["Pemail"]."</td><td>".$row["Pphone"]."</td><td>".$row["DOB"]."</td>
                                <td>".$row["Gender"]."</td><td>".$row["City_Name"]."</td>";
                                echo '<td style="padding-top:18px;"><form method="POST"><input type="submit" name="delete-pat" value="Delete" style="background-color:red;color:white;cursor:pointer;border-radius:6px;">
                                </input><input type="hidden" name="hidden2" value="'.$row["User_Id"].'"></form></td>
                                <td><button  onmouseover="uppat('.$row["User_Id"].');" onclick="showpop2();"  style="background-color:blue;color:white;width:80px;cursor:pointer;border-radius:6px;">Update</button>
                                </td></tr>';
                                }
                                
                                echo "</table>";

                        ?>
                        <div class="popup2" id="pup2" style=" padding:20px;background-color: #eee;position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);width: 50%;height: 50%;color: white;display: none;">
                            <button  onclick="hidepop2();" style="position:absolute;right:20px;">X</button>
                            <form method="post" name="updatepatform" >
                                <table>
                                        <tr><td><input name="pat-up-id" id="pat-up-id" type="hidden"></td></tr>
                                        <tr><td><label>First Name : </label></td><td><input name="pat-up-fn" type="text" required></td></tr>
                                        <tr><td><label>Last Name : </label></td><td><input name="pat-up-ln" type="text" required></td></tr>
                                        <tr><td><label>Email : </label></td><td><input name="pat-up-em" type="email" required></td></tr>
                                        <tr><td><label>Phone : </label></td><td><input name="pat-up-ph" type="tel" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000" required></td></tr>
                                        <tr><td><label>City : </label></td><td><select name="pat-up-ci">
                                                                    <?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select City_Id,City_Name from City "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["City_Id"]."'>".$row["City_Name"]."</option>";
                                                                            }
                                                                        ?></select></td>
                                        <tr><td><input type="submit" value="SUBMIT" name="update-pat"></td></tr>
                                </table>
                            </form>
                        </div> 
                </div>
                <div id="fees-sec">
                        <form  method="get" >
                            <fieldset>
                                <legend>Fees Info.</legend>
                                <table>
                                <tr>
                                    <td><label>Appointment Type : </label></td>
                                    <td>
                                        <select name="AppType">
                                        <?php $db=@mysqli_connect('localhost','root','');
                                                if (!$db) die("no connection");
                                                if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                $q="select AppType_Id,Name from Appointment_Type "; 
                                               $result=mysqli_query($db,$q) or die("query failed");
                                                while ($row=mysqli_fetch_array($result)){ 
                                                            echo "<option value='".$row["AppType_Id"]."'>".$row["Name"]."</option>";
                                                        }   ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>     
                                    <td><label>New Fees : </label></td>
                                    <td>
                                        <input type="number" name="appfees">
                                    </td>
                                </tr>                 
                                <tr><td><input type="submit" name="a1" value="Update Fees"></td></tr>                
                                </table>
                            </fieldset>                   
                        </form>
                        <?php 
                                        $db=@mysqli_connect('localhost','root','');
                                        if (!$db) die("no connection");
                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                        if(isset($_GET['a1'])){
                                            $c=$_GET['AppType'];
                                            $n=$_GET['appfees'];
                                            $q="update Appointment_Type set Fees=$n where AppType_Id=$c"; 
                                            @mysqli_query($db,$q);
                                            
                                            $db=@mysqli_connect('localhost','root','');
                                            if (!$db) die("no connection");
                                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                                            $s="select Name,Fees from appointment_type";
                
                                            $result=mysqli_query($db,$s) or die("query failed"); // two dim array n rows by 3 columns
                                            echo "<table border=1 style='border-collapse:collapse;text-align:center' width=40% ><tr>
                                                            <th>Appointment Type</th>
                                                            <th>Fees</th></tr>";
                                            while ($row=mysqli_fetch_array($result)){ 
                                            echo"<tr><td>".$row["Name"]."</td><td>".$row["Fees"].'</td></tr>';
                                            }
                                            //echo"<tr>"; foreach($row as $k=>$v) echo "<td>".$v."</td>"; echo "</tr>";
                                            echo "</table>";
                                            
                                            }
                         ?>     
     
                </div>
                <div id="visitt-sec" style="display: none;padding:25px;">
                    
                        <form method="POST"  >
                            <fieldset ><legend>Approve Visit</legend>
                            <table>
                            <tr><td><label>Appointment Id : </label></td><td><input type="number" name="appoiid" required></td></tr>
                            <tr><td><label>Visit date : </label></td><td><input type="date" name="appdate" required></td></tr>
                            <tr><td><label>Payment Method : </label></td><td><select name="pt"><?php $db=@mysqli_connect('localhost','root','');
                                                                            if (!$db) die("no connection");
                                                                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                            $q="select PayType_Id,Payname from payment_type "; 
                                                                            $result=mysqli_query($db,$q) or die("query failed");
                                                                            while ($row=mysqli_fetch_array($result)){ 
                                                                                echo "<option value='".$row["PayType_Id"]."'>".$row["Payname"]."</option>";
                                                                                }
                                                                            ?></select></td></tr>
                            <tr><td><input type="submit" value="Done" name="paybtn"></td></tr>
                            </table></fieldset>
                        </form>

                        <form method="POST" >
                            <fieldset ><legend>Search Visit</legend>
                            <table>
                            <tr><td><label>Visit Id : </label></td><td><input type="number" name="visitid" ></td></tr>
                            <tr><td><label>Patient Id : </label></td><td><input type="number" name="vpid" ></td></tr>
                            <tr><td><label>Visit date : </label></td><td><input type="date" name="visitdate" ></td></tr>
                            <tr><td><input type="submit" value="by date" name="searchvbtn"></td>
                            <td><input type="submit" value="by vid" name="vidbtn"></td>
                            <td><input type="submit" value="by pid" name="pidbtn"></td></tr>
                            </table></fieldset>
                        </form>
                    
                    <?php 
                    if(array_key_exists('paybtn', $_POST)) {
                        insertvisit();    
                    }else if(array_key_exists('searchvbtn', $_POST)) {
                        searchvisitdate();    
                    }
                    else if(array_key_exists('vidbtn', $_POST)) {
                        searchvid();    
                    }else if(array_key_exists('pidbtn', $_POST)) {
                        searchpid();    
                    }
                    
                    ?>
                </div>
                <div id="extra-sec" style="display: none;padding:25px;">
                    <fieldset>
                        <legend>Manage : </legend>
                        <form method="post"><label style="margin-right: 20px;">Appointment Type : </label><input type="text" name="appt">&nbsp;&nbsp;<input type="submit" value="Add" name="aatb"></form>
                        <form method="post"><label style="margin-right: 90px;">Speciality : </label><input type="text" name="s">&nbsp;&nbsp;<input type="submit" value="Add" name="aspb"></form>
                        <form method="post"><label style="margin-right: 35px;">Payment Method : </label><input type="text" name="pm">&nbsp;&nbsp;<input type="submit" value="Add" name="apmb"></form>
                        <form method="post"><label style="margin-right: 145px;">City : </label><input type="text" name="c">&nbsp;&nbsp;<input type="submit" value="Add" name="acb"></form>
                    </fieldset>
                    <?php
                    $db=@mysqli_connect('localhost','root','');
                    if (!$db) die("no connection");
                    if (!@mysqli_select_db($db,'clinic')) die("no db");
                    if(array_key_exists('aatb', $_POST)) {
                        if(isset($_POST["appt"]) && $_POST["appt"]!=null && $_POST["appt"]!=''){
                        $a=ucfirst($_POST["appt"]);
                        $at="insert into appointment_type(Name) values('$a')"; 
                        $result=mysqli_query($db,$at) or die("query failed");
                        echo "<script>window.onload = function(){
                            document.getElementById('extraBtn').click();
                            alert('Appointment type added');
                            }</script>";
                        }
                        else{
                            echo "<script>alert('Enter appointment type')</script>";
                            echo "<script>window.onload = function(){
                                document.getElementById('extraBtn').click();
                                }</script>";  
                        }    
                    
                    }else if(array_key_exists('aspb', $_POST)) {
                        if(isset($_POST["s"]) && $_POST["s"]!=null && $_POST["s"]!=''){
                        $a=ucfirst($_POST["s"]);
                        $at="insert into specialization(Speciality_Name) values('$a')"; 
                        $result=mysqli_query($db,$at) or die("query failed");
                        echo "<script>window.onload = function(){
                            document.getElementById('extraBtn').click();
                            alert('Speciality type added');
                            }</script>";
                        }else{
                            echo "<script>alert('Enter Speciality')</script>";
                            echo "<script>window.onload = function(){
                                document.getElementById('extraBtn').click();
                                }</script>";  
                        } 
                            
                    }    
                    else if(array_key_exists('apmb', $_POST)) {
                        if(isset($_POST["pm"]) && $_POST["pm"]!=null && $_POST["pm"]!=''){
                        $a=ucfirst($_POST["pm"]);
                        $at="insert into payment_type(PayName) values('$a')"; 
                        $result=mysqli_query($db,$at) or die("query failed");
                        echo "<script>window.onload = function(){
                            document.getElementById('extraBtn').click();
                            alert('Payment Method added');
                            }</script>";    
                        }
                        else{
                            echo "<script>alert('Enter payment method')</script>";
                            echo "<script>window.onload = function(){
                                document.getElementById('extraBtn').click();
                                
                                }</script>";  
                        } 
                    }else if(array_key_exists('acb', $_POST)) {
                        if(isset($_POST["c"]) && $_POST["c"]!=null && $_POST["c"]!=''){
                        $a=ucfirst($_POST["c"]);
                        $at="insert into city(City_Name) values('$a')"; 
                        $result=mysqli_query($db,$at) or die("query failed");
                        echo "<script>window.onload = function(){
                            document.getElementById('extraBtn').click();
                            alert('City added');
                            }</script>";    
                    }
                    else{
                        echo "<script>alert('Enter City')</script>";
                        echo "<script>window.onload = function(){
                            document.getElementById('extraBtn').click();
                            }</script>";  
                    } 
                }
                    ?>
                </div>
            </div>
        </div>
</body>
<script>
if(window.history.replaceState ){
  window.history.replaceState( null, null, window.location.href );
  }
</script>
</html>