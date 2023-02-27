<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="view">
        <div id="profile-sec" >
            <?php
            if(array_key_exists('updatepro', $_POST)) {
                updateprofile();
            } else if(array_key_exists('updategacc', $_POST)) {
                updategacc();
            }
            echo '<form name="profile-form" method="POST">
                    <fieldset class="profile-f">
                    <legend><span class="spanmy">MY </span>PROFILE</legend>
                    <table>
                        <tr><td><label>ID :</label></td><td><input type="number" name="pid" readonly value="'.$_SESSION["pid"].'"></td></tr>
                        <tr><td><label>First Name : </label></td><td><input type="text" name="pfn" value="'.$_SESSION["pfname"].'" required></td></tr>
                        <tr><td><label>Last Name : </label></td><td><input type="text" name="pln" value="'.$_SESSION["plname"].'" required></td></tr>
                        <tr><td><label>Email : </label></td><td><input type="email" name="pe" value="'.$_SESSION["pemail"].'" required></td></tr>
                        <tr><td><label>Phone : </label></td><td><input type="tel" pattern="[0-9]{2}-[0-9]{6}" placeholder="00-000000" name="pph" value="'.$_SESSION["pphone"].'" required></td></tr>
                        <tr><td><input type="submit" value="Update" name="updatepro"</td></tr>
                    </table>
                    </fieldset>
                    </form> ';


            echo '<form name="general-form" method="POST">
                    <fieldset class="profile-f">
                    <legend><span class="spanmy">ACCOUNT </span>INFO</legend>
                    <table>
                        <tr><td><label>Username :</label></td><td><input type="text" name="puun"  value="'.$_SESSION["pun"].'" required></td></tr>
                        <tr><td><label>Password : </label></td><td><input type="text" name="ppps" value="'.$_SESSION["pps"].'" required></td></tr>
                        <tr><td><input type="submit" value="Update" name="updategacc"</td></tr>
                    </table>
                    </fieldset>
                    </form> ';
                    function updategacc(){
                        $sun = $_POST["puun"];
                        $sps = $_POST["ppps"];
                        $db=@mysqli_connect('localhost','root','');
                        if (!$db) die("no connection");
                        if (!@mysqli_select_db($db, 'clinic')) die("no db");                    
                        $x1="select * from account where Username='$sun'";
                        $result1=@mysqli_query($db,$x1);
                        $row1=mysqli_fetch_array($result1);
                        
                        if (mysqli_num_rows($result1) > 0){
                            if($row1["Type_Id"] == 1){
                            $v="select * from account inner join patient on account.User_Id = patient.User_Id where account.Username='$sun'";
                            $result2=@mysqli_query($db,$v);
                            $row=mysqli_fetch_array($result2);
                            if($row["Patient_Id"] == $_SESSION["pid"]){
                                $x2="update account inner join patient on account.User_Id = patient.User_Id set Username='$sun',Password='$sps' where patient.Patient_Id=".$_SESSION["pid"];
                                @mysqli_query($db,$x2);
                                $_SESSION["pun"]=$sun;
                                $_SESSION["pps"]=$sps;
                            }
                            else if($row["Patient_Id"] != $_SESSION["pid"]){
                                echo"<script>alert('Username Taken');</script>";
                            }
                        }
                        else{
                            echo"<script>alert('Username Taken')</script>";
                        }
                        }
                        else{
                            $x2="update account inner join patient on account.User_Id = patient.Patient_Id set Username='$sun',Password='$sps' where patinet.Patient_Id=".$_SESSION["pid"];
                            @mysqli_query($db,$x2);
                            $_SESSION["pun"]=$sun;
                            $_SESSION["pps"]=$sps;
                        }
                }
        function updateprofile(){
            $i = $_POST["pid"];
            $a= ucfirst($_POST["pfn"]);
            $b= ucfirst($_POST["pln"]);
            $c=$_POST["pe"];
            $d=$_POST["pph"];
        
            $db=@mysqli_connect('localhost','root','');
                if (!$db) die("no connection");
                if (!@mysqli_select_db($db, 'clinic')) die("no db");                    
                $q="update patient set Fname='$a',Lname='$b',Email='$c',Phone='$d' where Patient_Id=$i ";
                @mysqli_query($db,$q);

                $_SESSION["pphone"]= $_POST["pph"];
                $_SESSION["pfname"]= ucfirst($_POST["pfn"]);
                $_SESSION["plname"]= ucfirst($_POST["pln"]);
                $_SESSION["pemail"]= $_POST["pe"];
        }
            ?>
        </div>

        <div id="portfolio-sec">
            <?php
            
            echo '<form name="profile-form" method="POST">
                <fieldset class="port-f">
                    <legend><span class="spanmy">MY </span>PORTFOLIO</legend>
                    <table>
                        <tr><td><label>Portfolio Id : </label></td><td><input type="number"  value="'.$_SESSION["pd"].'" readonly></td></tr>
                        <tr><td><label>Blood Group : </label></td><td><input type="text"  value="'.$_SESSION["bg"].'" readonly></td></tr>
                        <tr><td><label>Has Allergy : </label></td><td><input type="text"  value="'.$_SESSION["ha"].'" readonly></td></tr>
                        <tr><td><label>Has Diabetes : </label></td><td><input type="text"  value="'.$_SESSION["had"].'" readonly></td></tr>
                        <tr><td><label>Has Pressure : </label></td><td><input type="text"  value="'.$_SESSION["hp"].'" readonly></td></tr>
                        <tr><td><label>Heart Disease : </label></td><td><textarea readonly >'.$_SESSION["hd"].'</textarea></td></tr>
                        <tr><td><label>Herditary Disease : </label></td><td><textarea  readonly>'.$_SESSION["hed"].'</textarea></td></tr>
                        <tr><td><label>Permenant Medications : </label></td><td><textarea readonly>'.$_SESSION["pm"].'</textarea></td></tr>
                        <tr><td><label>Previous Surgeries : </label></td><td><textarea readonly>'.$_SESSION["ps"].'</textarea></td></tr>
                        
                    </table>
                    
                </fieldset>
        </form> ';
            
            ?>
        </div>
    </div>
    
</body>
</html>