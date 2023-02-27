<?php

function updatedgacc(){
    $sun = $_POST["puun"];
    $sps = $_POST["ppps"];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");                    
    $x1="select * from account where Username='$sun'";
    $result1=@mysqli_query($db,$x1);
    $row1=mysqli_fetch_array($result1);
    
    if (mysqli_num_rows($result1) > 0){
        if($row1["Type_Id"] == 2){
        $v="select * from account inner join doctor on account.User_Id = doctor.User_Id where account.Username='$sun'";
        $result2=@mysqli_query($db,$v);
        $row=mysqli_fetch_array($result2);
        if($row["User_Id"] != $_SESSION["did"]){
            echo"<script>alert('Username Taken')</script>";
            
           
        }
        else{
            $x2="update account inner join doctor on account.User_Id = doctor.User_Id set Username='$sun',Password='$sps' where doctor.User_Id=".$_SESSION["did"];
            @mysqli_query($db,$x2);
            $_SESSION["dun"]=$sun;
            $_SESSION["dps"]=$sps;
        }}
        else{
            echo"<script>alert('Username Taken')</script>";
        }
    }
    else{
        $x2="update account inner join doctor on account.User_Id = doctor.User_Id set Username='$sun',Password='$sps' where doctor.User_Id=".$_SESSION["did"];
        @mysqli_query($db,$x2);
        $_SESSION["dun"]=$sun;
        $_SESSION["dps"]=$sps;
    }
    echo "<script>window.onload = function(){
        document.getElementById('por').click();
        }</script>";
}

function displayBypid() {
    if($_POST["patid"] != "" && $_POST["patid"] != null){
    $did=$_SESSION["did"];
    $pid = $_POST["patid"];
    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="select * from appointment inner join patient on appointment.Pat_User_Id = patient.User_Id where Pat_User_Id=$pid and Doc_User_Id=$did ";

        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                        <th>App_Id</th>
                        <th>App_Date</th>
                        <th>App_Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        </tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Pfname"]."</td><td>".$row["Plname"]."</td></tr>";
    }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
}
else{
    echo "<script>alert('Empty Patient Id')</script>";
    echo "<script>window.onload = function(){
        document.getElementById('viewBtn').click();
        }</script>";
}
}

function visittapp(){
    $db=@mysqli_connect('localhost','root','');
                            if (!$db) die("no connection");
                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                            
                            $a=$_POST['hiddenappid'];
                            $q="update appointment set App_Status='Approved' where App_Id=$a";
            
                            mysqli_query($db,$q) or die("query failed");
                            echo "<script>window.onload = function(){
                                document.getElementById('viewBtn').click();
                                }</script>";
}
function insertapp(){
    $db=@mysqli_connect('localhost','root','');
                            if (!$db) die("no connection");
                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                            
                            $a=$_POST['patientid'];
                            $b=$_SESSION['did'];
                            $c=$_POST['apptype'];
                            $d=$_POST['appdate'];
                            $e=$_POST['apptime'];
                            if($d > date('Y-m-d')){

                            $q="insert into appointment(Pat_User_Id,Doc_User_Id,AppType_Id,App_Date,App_Time,App_Status) values($a,$b,$c,'$d','$e','Pending') ";
            
                            if(mysqli_query($db,$q)){
                                echo"<script>alert('Appointment booked')</script>";
                            } 
                            else{
                                echo"<script>alert('Unavaliable Appointment')</script>";
                            }
                            echo "<script>window.onload = function(){
                                document.getElementById('bookBtn').click();
                                }</script>";}
                                else{
                                    echo'<script>alert("Invalid Appointment Date")</script>';
                                    echo "<script>window.onload = function(){
                                        document.getElementById('bookBtn').click();
                                        }</script>";}
                                }

function displaybydateapp(){
    if($_POST["appdate"] != "" && $_POST["appdate"] != null){
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    $id = $_SESSION["did"];
    $date = $_POST["appdate"];
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    $q="select * from appointment inner join patient on appointment.Pat_User_Id = patient.User_Id where appointment.Doc_User_Id=$id and App_Date='$date'"; 
    $result=mysqli_query($db,$q) or die("query failed");
    echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                        <th>App_Id</th>
                        <th>App_Date</th>
                        <th>App_Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        </tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Pfname"]."</td><td>".$row["Plname"]."</td></tr>";
    }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
                                                
}
else{
    echo "<script>alert('Empty Date !')</script>";
    echo "<script>window.onload = function(){
        document.getElementById('viewBtn').click();
        }</script>";
}
}

function displaytoday(){
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    $id = $_SESSION["did"];
    $date=date('Y-m-d');
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    $q="select * from appointment inner join patient on appointment.Pat_User_Id = patient.User_Id where appointment.Doc_User_Id=$id and App_Date='$date'"; 
    $result=mysqli_query($db,$q) or die("query failed");
    echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                        <th>App_Id</th>
                        <th>App_Date</th>
                        <th>App_Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        </tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Pfname"]."</td><td>".$row["Plname"]."</td></tr>";
    }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
                                                
}

function displayallapp(){
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    $id = $_SESSION["did"];
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    $q="select * from appointment inner join patient on appointment.Pat_User_Id = patient.User_Id where appointment.Doc_User_Id=$id "; 
    $result=mysqli_query($db,$q) or die("query failed");
    echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                        <th>App_Id</th>
                        <th>App_Date</th>
                        <th>App_Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        </tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Pfname"]."</td><td>".$row["Plname"]."</td></tr>";
    }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";

}

function updateprofile(){
    $i = $_POST["did"];
    $a=$_POST["dfn"];
    $b=$_POST["dln"];
    $c=$_POST["de"];
    $d=$_POST["dph"];

    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db, 'clinic')) die("no db");                    
        $q="update doctor set Dfname='$a',Dlname='$b',Demail='$c',Dphone='$d' where User_Id=$i ";
        @mysqli_query($db,$q);
        $_SESSION["dfname"]="$a";
        echo "<script>window.onload = function(){
            document.getElementById('por').click();
            }</script>";
}
function viewport(){
    $db=@mysqli_connect('localhost','root','');
                            if (!$db) die("no connection");
                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                            
                            $a=$_POST["ppid"];
                            $q1="select * from patient_portfolio inner join patient on patient_portfolio.User_Id = patient.User_Id  where patient.User_Id=$a";
                            $result1=mysqli_query($db,$q1);
                            if (mysqli_num_rows($result1) > 0){
  
                            $q="select * from patient_portfolio inner join patient on patient_portfolio.User_Id = patient.User_Id  where patient.User_Id=$a";
                            $result=mysqli_query($db,$q) or die("query failed");
                            $row=mysqli_fetch_array($result);
                            echo '<div>
                            <fieldset><legend>Profile : </legend>   
                            <table>
                                    <tr><td><label>Patient Id : </label></td><td><input type="number" value="'.$row["User_Id"].'" readonly></td></tr>
                                    <tr><td><label>First Name : </label></td><td><input type="text" name="i2" value="'.$row["Pfname"].'" readonly></td></tr>
                                    <tr><td><label>Last Name : </label></td><td><input type="text" name="i3" value="'.$row["Plname"].'" readonly></td></tr>
                                    
                                    
                                </table>
                            </fieldset><br><form method="POST">
                            <fieldset><legend>Portfolio : </legend>   
                            <table>
                                    <tr><td><label>Portfolio Id : </label></td><td><input type="number" name="i1" value="'.$row["Port_Id"].'" readonly></td></tr>
                                    <tr><td><label>Gender : </label></td><td><input type="text" name="i2" value="'.$row["Gender"].'" readonly></td></tr>
                                    <tr><td><label>Blood Group : </label></td><td><input type="text" name="i3" value="'.$row["Blood_Group"].'"></td></tr>
                                    <tr><td><label>Has Allergy : </label></td><td><input type="text" name="i4" value="'.$row["Has_Allergy"].'"></td></tr>
                                    <tr><td><label>Has Diabetes : </label></td><td><input type="text" name="i5" value="'.$row["Has_Diabetes"].'"></td></tr>
                                    <tr><td><label>Has Pressure : </label></td><td><input type="text" name="i6" value="'.$row["Has_Pressure"].'"></td></tr>
                                    <tr><td><label>Heart Disease : </label></td><td><textarea name="i7">'.$row["Heart_Disease"].'</textarea></td></tr>
                                    <tr><td><label>Herditary Disease : </label></td><td><textarea name="i8">'.$row["Herditary_Disease"].'</textarea></td></tr>
                                    <tr><td><label>Permenant Medications : </label></td><td><textarea name="i9">'.$row["Permenant_Medications"].'</textarea></td></tr>
                                    <tr><td><label>Previous Surgeries : </label></td><td><textarea name="i10">'.$row["Previous_Surgeries"].'</textarea></td></tr>
                                    <tr><td><input type="hidden" value="'.$row["User_Id"].'" name="i11"></td></tr>
                                    <tr><td><input type="Submit" value="Save" name="savebtn"></td></tr>
                                    
                                </table>
                            </fieldset></form>
                            </div>';
                            }
                            else{
                                echo"<script>alert('Patient Unavaliable . Please check the entered Id')</script>";
                            }
                            echo "<script>window.onload = function(){
                                document.getElementById('portBtn').click();
                                }</script>";
}
function upport(){
    $db=@mysqli_connect('localhost','root','');
                            if (!$db) die("no connection");
                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                        
                            $a=$_POST['i11'];
                            $c=$_POST['i3'];
                            $d=$_POST['i4'];
                            $e=$_POST['i5'];
                            $f=$_POST['i6'];
                            $g=$_POST['i7'];
                            $h=$_POST['i8'];
                            $j=$_POST['i9'];
                            $k=$_POST['i10'];

                            $q="update patient_portfolio set Blood_Group='$c', Has_Allergy='$d',Has_Diabetes='$e', Has_Pressure='$f', Heart_Disease='$g', Herditary_Disease='$h', Permenant_Medications='$j', Previous_Surgeries='$k' where User_Id=$a";
                            mysqli_query($db,$q) or die("query failed");
                            echo "<script>window.onload = function(){
                                document.getElementById('portBtn').click();
                                }</script>";
}
?>