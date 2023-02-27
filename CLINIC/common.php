<?php 
    function loginuser(){
        $un = $_GET["login-un"];
        $ps = $_GET["login-ps"];
        if($un == 'admin' && $ps == 123){
            header('Location: ' . "admin.php");
                    exit();
        }
        else{
        $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db, 'clinic')) die("no db");                    
        $x="select * from account where Username='$un'";
        $result=@mysqli_query($db,$x);
        $row=mysqli_fetch_array($result);
        if (mysqli_num_rows($result) == 0){
            echo"<script>alert('Username Invalid')</script>";
        }
        else if (mysqli_num_rows($result) > 0){
            if($row["Activision"] == 'A'){
                if($row["Password"] == $ps){
                    if($row["Type_Id"] == 1){
                        $sql="select * from account inner join patient on account.User_Id = patient.User_Id inner join city on city.City_Id = patient.City_Id where Username='$un'";
                        $resultp=@mysqli_query($db,$sql);
                        $row2=mysqli_fetch_array($resultp);
                        $ava="no";
                        $_SESSION["puid"] = $row2["User_Id"];
                        $_SESSION["pun"] = $row2["Username"];
                        $_SESSION["pps"] = $row2["Password"];
                        $_SESSION["pid"] = $row2["User_Id"];
                        $_SESSION["pfname"] = $row2["Pfname"];
                        $_SESSION["plname"] = $row2["Plname"];
                        $_SESSION["pemail"] = $row2["Pemail"];
                        $_SESSION["pphone"] = $row2["Pphone"];
                        $_SESSION["pdob"] = $row2["DOB"];
                        $_SESSION["pcity"] = $row2["City_Name"];
                        $_SESSION["ava"] = $ava;

                        $sql3="select * from account inner join patient on account.User_Id = patient.User_Id inner join patient_portfolio on patient_portfolio.User_Id = patient.User_Id where Username='$un'";
                        $result3=@mysqli_query($db,$sql3);
                        $row3=mysqli_fetch_array($result3);
                        $_SESSION["pd"] = $row3["Port_Id"];
                        $_SESSION["bg"] = $row3["Blood_Group"];
                        $_SESSION["ps"] = $row3["Previous_Surgeries"];
                        $_SESSION["hd"] = $row3["Heart_Disease"];
                        $_SESSION["ha"] = $row3["Has_Allergy"];
                        $_SESSION["had"] = $row3["Has_Diabetes"];
                        $_SESSION["hp"] = $row3["Has_Pressure"];
                        $_SESSION["hed"] = $row3["Herditary_Disease"];
                        $_SESSION["pm"] = $row3["Permenant_Medications"];
                        header('Location: ' . "home.php");
                        exit();
                    }
                    else if($row["Type_Id"] == 2){
                        $sql2="select * from account inner join doctor on account.User_Id = doctor.User_Id inner join specialization on doctor.Speciality_Id = specialization.Speciality_Id where Username='$un'";
                        $resultd=@mysqli_query($db,$sql2);
                        $row3=mysqli_fetch_array($resultd);
                        $_SESSION["duid"] = $row3["User_Id"];
                        $_SESSION["dun"] = $row3["Username"];
                        $_SESSION["dps"] = $row3["Password"];
                        $_SESSION["did"] = $row3["User_Id"];
                        $_SESSION["dfname"] = $row3["Dfname"];
                        $_SESSION["dlname"] = $row3["Dlname"];
                        $_SESSION["demail"] = $row3["Demail"];
                        $_SESSION["dphone"] = $row3["Dphone"];
                        $_SESSION["dspec"] = $row3["Speciality_Name"];
                        header('Location: ' . "doctor.php");
                        exit();
                    }
                }
                else {
                    echo"<script>alert('Wrong password')</script>";
                }
            }
            else{
                echo"<script>alert('Account is Deactivated')</script>";
            }
        }
    }
   
}

function checkun(){
        $sun = $_POST["signup-un"];
        $sps = $_POST["signup-ps"];
        $scps = $_POST["signup-cps"];
        $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db, 'clinic')) die("no db");                    
        $x="select * from account where Username='$sun'";
        $result=@mysqli_query($db,$x);
        $row=mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0){
            echo"<script>alert('Username Taken')</script>";
        }
        else if (mysqli_num_rows($result) == 0 && $sps == $scps){
            $_SESSION["signup-username"]=$sun;
            $_SESSION["signup-password"]=$sps;
            echo'<script>window.onload = function(){
                                document.getElementById("login-sec").style.display = "none";
                                document.getElementById("useroption").style.display = "block";
                
                                }</script>';
        }
        else if (mysqli_num_rows($result) == 0 && $sps != $scps){
            echo"<script>alert('Passwords doesnt match')</script>";
        }
}

function insertuserp(){
        $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db, 'clinic')) die("no db");
            $asun=$_SESSION["signup-username"];
            $asps=$_SESSION["signup-password"];                    
            $sfn = $_SESSION["sfn"];
            $sln = $_SESSION["sln"];
            $se = $_SESSION["se"];
            $sph = $_SESSION["sph"];
            $sc = $_SESSION["sc"];
            $sg = $_SESSION["sg"];
            $sdob = $_SESSION["sdob"];
            //insert user account
            $q="insert into Account(Username,Password,Type_Id,Activision) values('$asun','$asps',1,'A') ";
            mysqli_query($db,$q) or die("Account Insertion Falied");
            // get user id to add into patient as foreign key
            $suid="select User_Id from Account where Username='$asun'";
            $suidr=mysqli_query($db,$suid);
            $row=mysqli_fetch_array($suidr);
            $uid=$row['User_Id'];
            //insert user into patient after inserting account
            $psql="insert into Patient(User_Id,Pfname,Plname,Pemail,Pphone,DOB,Gender,City_Id) values($uid,'$sfn','$sln','$se','$sph','$sdob','$sg',$sc) ";
            mysqli_query($db,$psql) or die("Patient Insertion Falied");
            // insert pid into portfoilo after inserting patient
            $ppsql="Insert into Patient_Portfolio(User_Id) values($uid)";
            mysqli_query($db,$ppsql) or die("Portfoilio Insertion Falied");
}

function insertuserd(){
        $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db, 'clinic')) die("no db");
            $asdun=$_SESSION["signup-username"];
            $asdps=$_SESSION["signup-password"];                    
            $sdfn = $_SESSION["sdfn"];
            $sdln = $_SESSION["sdln"];
            $sde = $_SESSION["sde"];
            $sdph = $_SESSION["sdph"];
            $ss = $_SESSION["sds"];
            //insert user account
            $qh="insert into Account(Username,Password,Type_Id,Activision) values('$asdun','$asdps',2,'D') ";
            mysqli_query($db,$qh) or die("Account Insertion Falied");
            // get user id to add into doctor as foreign key
            $suid="select User_Id from Account where Username='$asdun'";
            $suidr=mysqli_query($db,$suid);
            $row=mysqli_fetch_array($suidr);
            $uid=$row['User_Id'];
            //insert user into doctor after inserting account
            $psql="insert into Doctor(User_Id,Dfname,Dlname,Demail,Dphone,Speciality_Id) values($uid,'$sdfn','$sdln','$sde','$sdph',$ss) ";
            mysqli_query($db,$psql) or die("Doctor Insertion Falied"); 
            echo'<script>alert("Account Request sent. Please wait the Admin to accept :)")</script>';                
}
?>