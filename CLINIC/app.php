
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app2.css">
    <script src="app1.js"></script>
    <title>My Appointments</title>
    <?php
 session_start();
?>
</head>
<body>
    <div class="contanier">
        
            <fieldset class="view"><legend><span id="top">MY</span><br><span id="bot">APPOINTMENTS</span></legend>
            <br><br><br><br>
                <?php
                    $db=@mysqli_connect('localhost','root','');
                    if (!$db) die("no connection");
                    $id = $_SESSION["pid"];
                    if (!@mysqli_select_db($db,'clinic')) die("no db");
                    $q="select * from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id inner join appointment_type on appointment.AppType_Id = appointment_type.AppType_Id where appointment.Pat_User_Id=$id "; 
                    $result=mysqli_query($db,$q) or die("query failed");
                    echo "<table border=1 style='border-collapse:collapse;text-align:center;color:white; border:white;' width=100%><tr>
                    <th>Appointment_Id</th>
                    <th>Appointment_Date</th>
                    <th>Appointment_Time</th>
                    <th>Doctor</th>
                    <th>Appointment_type</th>
                    <th>Status</th>
                    <th>      </th>
                    </tr>";
                    while ($row=mysqli_fetch_array($result)){ 
                    echo '<tr><td>'.$row["App_Id"].'</td><td>'.$row["App_Date"].'</td><td>'.$row["App_Time"].'</td><td>'.$row["Dfname"].'</td><td>'.$row["Name"].'</td><td>'.$row["App_Status"].'</td><td>
                    <form method="POST" style="display:inline-block;"><input type="hidden" name="hiddenappid" value="'.$row["App_Id"].'">
                    <input type="submit" value="Cancel" name="cancelb"></form>';
                    echo '<input style="display:inline-block;" type="button" value="Update" name="updateb;" onclick="upapp('.$row["App_Id"].');"></tr>';
                    }
                    echo '</table>';
                ?>
                <div  style="position:relative;" id="popupp">
                    <input type="button" value="X" class="x" onclick="hidepop();">
                    <table>
                        <form method="POST">
                                <tr><td>Appointment ID : </td><td><input type="number" name="appid" id="appid" readonly></td></tr>
                                <tr><td>Doctor name : </td><td><select name="doctorname" id="doctorname" required><?php $db=@mysqli_connect('localhost','root','');
                                                                                if (!$db) die("no connection");
                                                                                if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                                $q="select User_Id,Dfname from doctor "; 
                                                                                $result=mysqli_query($db,$q) or die("query failed");
                                                                                while ($row=mysqli_fetch_array($result)){ 
                                                                                    echo "<option style='color:black;' value='".$row["User_Id"]."'>".$row["Dfname"]."</option>";
                                                                                    }
                                                                                ?></select></td></tr>
                                <tr><td>Appointment Date : </td><td><input type="date" name="appdate" id="appdate" onchange="var a = getDayName(this.value);"required></td></tr>
                                <tr><td>Appointment Time : </td><td><select name="apptime" id="apptime" required >
                                                            
                                                        </select></td></tr>
                                <tr><td>Appointment Type : </td><td><select name="apptype" id="apptype" required><?php $db=@mysqli_connect('localhost','root','');
                                                                                if (!$db) die("no connection");
                                                                                if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                                $q="select AppType_Id,Name from appointment_type "; 
                                                                                $result=mysqli_query($db,$q) or die("query failed");
                                                                                while ($row=mysqli_fetch_array($result)){ 
                                                                                    echo "<option style='color:black;' value='".$row["AppType_Id"]."'>".$row["Name"]."";
                                                                                    }
                                                                                ?></select></td></tr>
                                <tr><td><input type="submit" value="Update Appointment" name="updateappb"></td></tr>
                        
                        </form>
                    </table>
                </div>
            </fieldset>
    </div>
    <?php 
    if(array_key_exists('updateappb', $_POST)) {
        updateapp();
    }else if(array_key_exists('cancelb', $_POST)) {
        cancelapp();
    }
    function cancelapp(){
        $a=$_POST["hiddenappid"];
        $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        
        $q="delete from appointment where App_Id=$a"; 
        mysqli_query($db,$q) or die("query failed");
    }
        function updateapp(){
            $pid=$_SESSION["pid"];
            $a=$_POST["appid"];
            $b=$_POST["doctorname"];
            $c=$_POST["appdate"];
            $d=$_POST["apptime"];
            $e=$_POST["apptype"];
            $db=@mysqli_connect('localhost','root','');
            if (!$db) die("no connection");
            if (!@mysqli_select_db($db,'clinic')) die("no db");
            
            $q="select * from appointment where Doc_User_Id=$b and App_Date='$c' and App_Time='$d'"; 
            $result=mysqli_query($db,$q) or die("query failed");
            $row=mysqli_fetch_array($result);
            if (mysqli_num_rows($result) == 0){
                
                $x2="update appointment set Doc_User_Id=$b,App_Date='$c',App_Time='$d',AppType_Id=$e where App_Id=$a";
                if(mysqli_query($db,$x2)){
                echo"<script>alert('Appointment Updated')</script>";
                }
                else{
                    echo"<script>alert('Appointment Unavaliable')</script>";
                }
            }
            else{
                if(mysqli_num_rows($result) > 0){
                if($row["Pat_User_Id"] == $pid){
                    $x2="update appointment set Doc_User_Id=$b,App_Date='$c',App_Time='$d',AppType_Id=$e where App_Id=$a";
                if(mysqli_query($db,$x2)){
                echo"<script>alert('Appointment Updated')</script>";
                }
                else{
                    echo"<script>alert('Appointment Unavaliable')</script>";
                }
                }
                else{
                    echo"<script>alert('Appointment Unavaliable')</script>";
                }
            }
        }
    }


    ?>
</body>
<script>
if(window.history.replaceState ){
  window.history.replaceState( null, null, window.location.href );
  }
</script>
</html>