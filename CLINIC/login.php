<?php
    include 'common.php';
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="login2.css">
    <script src="login3.js"></script>
</head>
<body>

    <div class="tittle" id="tittle">
        <span>LOG-<span class="red">IN</span></span>
    </div>
    <div class="container">
        <div class="login-sec" id="login-sec">
            <form method="get">
                <fieldset class="login-field">
                    <table>
                        <tr><td><label>Username  </label></td></tr><tr><td><input type="text" name="login-un" id="login-un" placeholder="Enter Your Username" required></td></tr>
                        <tr><td><label>Password  </label></td></tr><tr><td><input type="text" name="login-ps" id="login-ps" placeholder="Enter Your Password" required></td></tr>
                        <tr><td><input type="submit" name="logbtn" value="Login"></td></tr>
                    </table>
                </fieldset>
            </form>
            <?php 
            if(array_key_exists('logbtn', $_GET)) {
                loginuser();
            }else if(array_key_exists('next', $_POST)) {
                checkun();    
            }else if(array_key_exists('signupbtn', $_POST)) {
                if(isset($_POST["signupbtn"])){
                    $_SESSION["sfn"] = ucfirst($_POST["signup-fn"]);
                    $_SESSION["sln"] = ucfirst($_POST["signup-ln"]);
                    $_SESSION["se"] = $_POST["signup-e"];
                    $_SESSION["sph"] = $_POST["signup-ph"];
                    $_SESSION["sc"] = $_POST["signup-c"];
                    $_SESSION["sg"] = ucfirst($_POST["signup-g"]);
                    $_SESSION["sdob"] = $_POST["signup-dob"];
                $pemail=$_POST["signup-e"];
                $db=@mysqli_connect('localhost','root','');
                if (!$db) die("no connection");
                if (!@mysqli_select_db($db,'clinic')) die("no db");
                $q="select * from patient where Pemail='$pemail'"; 
                $result=mysqli_query($db,$q) or die("query failed");
                if (mysqli_num_rows($result) > 0){
                    echo'<script>alert("Email Is Used Please Choose Another One")</script>';
                }
                else{
                    insertuserp();
                }    
            }
        }
        else if(array_key_exists('signupdbtn', $_POST)) {
            if(isset($_POST["signupdbtn"])){
                
                $_SESSION["sdfn"] = ucfirst($_POST["signupd-fn"]);
                $_SESSION["sdln"] = ucfirst($_POST["signupd-ln"]);
                $_SESSION["sde"]  = $_POST["signupd-e"];
                $_SESSION["sdph"] = $_POST["signupd-ph"];
                $_SESSION["sds"] = $_POST["signupd-s"];
                $pemail = $_POST["signupd-e"];
            $db=@mysqli_connect('localhost','root','');
            if (!$db) die("no connection");
            if (!@mysqli_select_db($db,'clinic')) die("no db");
            $q="select * from doctor where Demail='$pemail'"; 
            $result=mysqli_query($db,$q) or die("query failed");
            if (mysqli_num_rows($result) > 0){
                echo'<script>alert("Email Is Used Please Choose Another One")</script>';
            }
            else{
                insertuserd();
            }    
        }
    }
            ?>
            &nbsp;&nbsp;&nbsp; <span style="color: red;">Don't Have An Account?</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="supbtn" onclick="signup();">Sign-up</button>
        </div>
        <div class="useroption" id="useroption">
            <button id="patient" onclick="showp();">Patient</button>
            <button id="doctor" onclick="showd();">Doctor</button>
        </div>
        <div class="supacc-sec" id="supacc-sec" >
            
                <form method="POST"   >
                    <fieldset>
                        <table>
                            <tr><td><label>Username</label></td></tr><tr><td><input type="text" name="signup-un" id="signup-un" required></td></tr>
                            <tr><td><label>Password</label></td></tr><tr><td><input type="text" name="signup-ps" id="signup-ps" required></td></tr>
                            <tr><td><label>Confirm password</label></td></tr><tr><td><input type="text" name="signup-cps" id="signup-cps" required></td></tr> 
                            <tr><td><input type="hidden" name="unc" id="unc"></td></tr><tr><td><input type="hidden" name="psc" id="psc" ></td></tr>
                            <tr><td><input type="submit" value="Next" name="next" onclick="nextfield();"></td></tr>   
                        </table>
                    </fieldset>
                </form>
        </div>
        <div class="super" id="super">
            <form method="POST" >
                <fieldset>
                    <table>
                    <tr><td><label>First Name</label></td></tr><tr><td><input type="text" name="signup-fn" id="signup-fn" required></td></tr>
                    <tr><td><label>Last Name</label></td></tr><tr><td><input type="text" name="signup-ln" id="signup-ln" required></td></tr>
                    <tr><td><label>Email</label></td></tr><tr><td><input type="email" name="signup-e" id="signup-e" required></td></tr>
                    <tr><td><label>Phone</label></td></tr><tr><td><input type="tel" name="signup-ph" id="signup-ph" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000" required></td></tr>
                    <tr><td><label>Date Of Birth</label></td></tr><tr><td><input type="date" name="signup-dob" id="signup-dob" required></td></tr>
                    <tr><td><label>Gender</label></td></tr><tr><td><select name="signup-g" id="signup-g"><option value="f">Female</option><option value="m">Male</option></select></td></tr>
                    <tr><td><label>City</label></td></tr><tr><td><select name="signup-c" id="signup-c"><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select * from city "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["City_Id"]."'>".$row["City_Name"]."</option>";
                                                                            }
                                                                        ?></select></td></tr>
                    <tr><td><input type="submit" value="Submit" name="signupbtn"></td></tr>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="sud" id="sud">
        <form method="POST" >
                <fieldset>
                    <table>
                    <tr><td><label>First Name</label></td></tr><tr><td><input type="text" name="signupd-fn" id="signupd-fn" required></td></tr>
                    <tr><td><label>Last Name</label></td></tr><tr><td><input type="text" name="signupd-ln" id="signupd-ln" required></td></tr>
                    <tr><td><label>Email</label></td></tr><tr><td><input type="email" name="signupd-e" id="signupd-e" required></td></tr>
                    <tr><td><label>Phone</label></td></tr><tr><td><input type="tel" name="signupd-ph" id="signupd-ph" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000" required></td></tr>
                    <tr><td><label>Speciality</label></td></tr><tr><td><select name="signupd-s" id="signupd-s"><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select * from specialization "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option value='".$row["Speciality_Id"]."'>".$row["Speciality_Name"]."</option>";
                                                                            }
                                                                        ?></select></td></tr>
                    <tr><td><input type="submit" value="Submit" name="signupdbtn"></td></tr>
                    </table>
                </fieldset>
            </form>
        </div>
    </div>

</body>
<footer><script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script></footer>
</html>