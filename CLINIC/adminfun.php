<?php
function updateacc(){
    $accid=$_POST['acc-id'];
    $accun=$_POST['acc-up-un'];
    $accps=$_POST['acc-up-ps'];

    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $z="select * from account where Username='$accun'";
    $result=@mysqli_query($db,$z);
    $row=mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0 and $row["User_Id"] != $accid){
        echo"<script>alert('Username Taken !! Please choose another Username')</script>";
    }
    else{
        $x="update account set Username='$accun',Password='$accps' where User_Id=$accid";
        @mysqli_query($db,$x);
    }
}
function deddacc() {
    $id=$_POST['hidden100'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $o="update account inner join doctor on account.User_Id = doctor.User_Id set Activision='D' where doctor.User_Id=$id";
    @mysqli_query($db,$o);
}
function activateddacc() {
    $id=$_POST['hidden18'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $x="update account set Activision='A' where User_Id=$id";
        @mysqli_query($db,$x);

    
    echo "<script>window.onload = function(){
        document.getElementById('maccbtn').click();
        }</script>";
}
function deleteddacc() {
    $id=$_POST['hidden6'];
    
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $x="delete  from account where User_Id=$id";
        @mysqli_query($db,$x);

    echo "<script>window.onload = function(){
        document.getElementById('maccbtn').click();
        }</script>";
}
function deleteacc1() {
    $id=$_POST['hidden6'];
    $type=$_POST['typehidden'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $x="delete  from account where User_Id=$id";
        @mysqli_query($db,$x);
    if($type == 2){
        $r="delete  from doctor where User_Id=$id";
        @mysqli_query($db,$r);
    }
    elseif($type == 1){
        $q="delete from patient where User_Id=$id";
    @mysqli_query($db,$q);
    }
    
    echo "<script>window.onload = function(){
        document.getElementById('accBtn').click();
        }</script>";
}
function displayBoth(){
    if($_POST["datesearch"] != "" && $_POST["datesearch"] != null){
        $date = $_POST["datesearch"];
        $did=$_POST["nameselect"];
        $db=@mysqli_connect('localhost','root','');
            if (!$db) die("no connection");
            if (!@mysqli_select_db($db,'clinic')) die("no db");
            $q="select * from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id where App_Date='$date' and doctor.User_Id=$did";

            $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
            echo "<table border=1 style='border-collapse:collapse;text-align:center' width=80%><tr>
                            <th>App_Id</th>
                            <th>App_Date</th>
                            <th>App_Time</th>
                            <th>Status</th>
                            <th>Patient Id</th>
                            <th>Doctor Id</th>
                            <th>Fname</th>
                            <th>Lname</th>
                            </tr>";
            while ($row=mysqli_fetch_array($result)){ 
            echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Doc_User_Id"]."</td><td>".$row["Dfname"]."</td><td>".$row["Dlname"]."</td>";
            echo '<td style="padding-top:18px;"><form method="POST"><input type="submit" name="cancel-app" value="Cancel" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;" >
            <input type="submit" name="approve-app" value="Approve" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;">
            
            <input type="hidden" name="hidden4" value="'.$row["App_Id"].'"></form></td></tr>';
        }
            echo "</table>";
            echo "<script>window.onload = function(){
                document.getElementById('viewBtn').click();
                }</script>";
    }
    else{
        echo "<script>alert('empty search date')</script>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
    }
}

function cancelapp() {
    $appid = $_POST["hidden4"];
    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="update appointment set App_Status='Canceled' where App_Id=$appid";
        mysqli_query($db,$q);
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            document.getElementById('disBtn').click();
            }</script>";
}
function approveapp() {
    $appid = $_POST["hidden4"];
    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="update appointment set App_Status='Approved' where App_Id=$appid";
        mysqli_query($db,$q);
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            document.getElementById('disBtn').click();
            }</script>";
    }
function visitapp() {
    $appid = $_POST["hidden4"];
    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="update appointment set App_Status='Visited' where App_Id=$appid";
        mysqli_query($db,$q);
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            document.getElementById('disBtn').click();
            }</script>";
    }
function displayByDoctor() {
    
    $dname = $_POST["nameselect"];
    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="select App_Id,App_Date,App_Time,AppType_Id,Pat_User_Id,App_Status from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id  where doctor.User_Id=$dname";

        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=80%><tr>
                        <th>App Id</th>
                        <th>App status</th>
                        <th>App Date</th>
                        <th>App Time</th>
                        <th>Patient Id</th></tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Status"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["Pat_User_Id"]."</td>";
        echo '<td style="padding-top:18px;"><form method="POST"><input type="submit" name="cancel-app" value="Cancel" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;" >
        <input type="submit" name="approve-app" value="Approve" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;" >
        <input type="hidden" name="hidden4" value="'.$row["App_Id"].'"></form></td></tr>';
    
    }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
        }

        function displayBystatus() {
    
            $appstatus = $_POST["sapptype"];
            $db=@mysqli_connect('localhost','root','');
                if (!$db) die("no connection");
                if (!@mysqli_select_db($db,'clinic')) die("no db");
                $q="select * from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id  where appointment.App_Status='$appstatus'";
        
                $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                        <th>App Id</th>
                        <th>App Date</th>
                        <th>App Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Doctor Id</th>
                        <th>Doc Fname</th>
                        <th>Doc Lname</th></tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Doc_User_Id"]."</td><td>".$row["Dfname"]."</td><td>".$row["Dlname"]."</td>";
        echo '<td><form method="POST"><input type="submit" name="cancel-app" value="Cancel" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;" >
        <input type="submit" name="approve-app" value="Approve" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;" >
        
        <input type="hidden" name="hidden4" value="'.$row["App_Id"].'"></form></td></tr>';
        }
                echo "</table>";
                echo "<script>window.onload = function(){
                    document.getElementById('viewBtn').click();
                    }</script>";
                }
        
        

function displayByDate() {
    if($_POST["datesearch"] != "" && $_POST["datesearch"] != null){
    $date = $_POST["datesearch"];
    $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="select * from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id where App_Date='$date' ";

        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=80%><tr>
                        <th>App_Id</th>
                        <th>App_Date</th>
                        <th>App_Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Doctor Id</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        </tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Doc_User_Id"]."</td><td>".$row["Dfname"]."</td><td>".$row["Dlname"]."</td>";
        echo '<td style="padding-top:18px;"><form method="POST"><input type="submit" name="cancel-app" value="Cancel" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;" >
        <input type="submit" name="approve-app" value="Approve" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;" >
        
        <input type="hidden" name="hidden4" value="'.$row["App_Id"].'"></form></td></tr>';
    }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
}
else{
    echo "<script>alert('empty search date')</script>";
    echo "<script>window.onload = function(){
        document.getElementById('viewBtn').click();
        }</script>";
}
}
function displayBypid() {
if($_POST["patid"] != "" && $_POST["patid"] != null){
$pid = $_POST["patid"];
$db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    $q="select * from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id where Pat_User_Id=$pid ";

    $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
    echo "<table border=1 style='border-collapse:collapse;text-align:center' width=80%><tr>
                    <th>App_Id</th>
                    <th>App_Date</th>
                    <th>App_Time</th>
                    <th>Status</th>
                    <th>Patient Id</th>
                    <th>Doctor Id</th>
                    <th>Fname</th>
                    <th>Lname</th>
                    </tr>";
    while ($row=mysqli_fetch_array($result)){ 
    echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Doc_User_Id"]."</td><td>".$row["Dfname"]."</td><td>".$row["Dlname"]."</td>";
    echo '<td style="padding-top:18px;"><form method="POST"><input type="submit" name="cancel-app" value="Cancel" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;" >
    <input type="submit" name="approve-app" value="Approve" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;" >
    
    <input type="hidden" name="hidden4" value="'.$row["App_Id"].'"></form></td></tr>';
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
function displayAll() {
    
        $db=@mysqli_connect('localhost','root','');
        if (!$db) die("no connection");
        if (!@mysqli_select_db($db,'clinic')) die("no db");
        $q="select * from appointment inner join doctor on appointment.Doc_User_Id = doctor.User_Id";

        $result=mysqli_query($db,$q) or die("query failed"); // two dim array n rows by 3 columns
        echo "<table border=1 style='border-collapse:collapse;text-align:center' width=100%><tr>
                        <th>App Id</th>
                        <th>App Date</th>
                        <th>App Time</th>
                        <th>Status</th>
                        <th>Patient Id</th>
                        <th>Doctor Id</th>
                        <th>Doc Fname</th>
                        <th>Doc Lname</th></tr>";
        while ($row=mysqli_fetch_array($result)){ 
        echo "<tr><td>".$row["App_Id"]."</td><td>".$row["App_Date"]."</td><td>".$row["App_Time"]."</td><td>".$row["App_Status"]."</td><td>".$row["Pat_User_Id"]."</td><td>".$row["Doc_User_Id"]."</td><td>".$row["Dfname"]."</td><td>".$row["Dlname"]."</td>";
        echo '<td style="padding-top:18px;"><form method="POST"><input type="submit" name="cancel-app" value="Cancel" style="background-color:red;color:white;width:80px;cursor:pointer;border-radius:6px;" >
        <input type="submit" name="approve-app" value="Approve" style="background-color:greenyellow;color:black;width:80px;cursor:pointer;border-radius:6px;" >
        
        <input type="hidden" name="hidden4" value="'.$row["App_Id"].'"></form></td></tr>';
        }
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('viewBtn').click();
            }</script>";
}

function deletedoc() {
    $id=$_POST['hidden100'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");

    $q="delete from doctor where User_Id=$id";
    @mysqli_query($db,$q);
    echo "<script>window.onload = function(){
        document.getElementById('doctorBtn').click();
        }</script>";
}
function deletepat() {
    $pid=$_POST['hidden2'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");

    $q="delete from patient where User_Id=$pid";
    @mysqli_query($db,$q);
    echo "<script>window.onload = function(){
        document.getElementById('patientBtn').click();
        }</script>";
}
function deletedacc() {
    $id=$_POST['hidden100'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");

    $q="delete from account where User_Id=$id";
    @mysqli_query($db,$q);
    echo "<script>window.onload = function(){
        document.getElementById('doctorBtn').click();
        }</script>";
}
function deletepacc() {
    $id=$_POST['hidden2'];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");

    $q="delete from account  where User_Id = $id";
    @mysqli_query($db,$q);
    echo "<script>window.onload = function(){
        document.getElementById('patientBtn').click();
        }</script>";
}
function updatedoc() {
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $udid = $_POST["doc-up-id"];
    $udfn = ucfirst($_POST["doc-up-fn"]);
    $udln = ucfirst($_POST["doc-up-ln"]);
    $udem = $_POST["doc-up-em"];
    $udph = $_POST["doc-up-ph"];
    $udsp = $_POST["doc-up-sp"];
    $q="update doctor set Dfname='$udfn',Dlname='$udln',Demail='$udem',Dphone='$udph',Speciality_Id=$udsp where User_Id=$udid";
    @mysqli_query($db,$q);
    echo "<script>window.onload = function(){
        document.getElementById('doctorBtn').click();
        }</script>";
}
function updatepat() {
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db, 'clinic')) die("no db");
    $upid = $_POST["pat-up-id"];
    $upfn = ucfirst($_POST["pat-up-fn"]);
    $upln = ucfirst($_POST["pat-up-ln"]);
    $upem = $_POST["pat-up-em"];
    $upph = $_POST["pat-up-ph"];
    $upci = $_POST["pat-up-ci"];
    $q="update patient set Pfname='$upfn',Plname='$upln',Pemail='$upem',Pphone='$upph',City_Id=$upci where User_Id=$upid";
    @mysqli_query($db,$q);
    echo "<script>window.onload = function(){
        document.getElementById('patientBtn').click();
        }</script>";
}
function insertvisit(){
    $id=$_POST["appoiid"];
    $appdate=$_POST["appdate"];
    $ptype=$_POST["pt"];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    // get app fees
    $q="select * from appointment inner join  appointment_type on appointment.AppType_Id = appointment_type.AppType_Id where App_Id=$id"; 
    $result=mysqli_query($db,$q) or die("query failed");
    if (mysqli_num_rows($result) > 0){
    $row=mysqli_fetch_array($result);
    $appfees=$row["Fees"];
    // insert into visit
    $vq="insert into visit(App_Id,Date) values($id,'$appdate')"; 
    mysqli_query($db,$vq) or die("query failed");
    //get visit id
    $vq2="select * from visit where App_Id =$id";
    $result2=mysqli_query($db,$vq2) or die("query failed");
    $row2=mysqli_fetch_array($result2);
    $visitid=$row2["Visit_Id"];
    //insert into payment
    $pq1="insert into payment(PayType_Id,Visit_Id,Ammount) values($ptype,$visitid,$appfees)";
    mysqli_query($db,$pq1) or die("query failed");
    // set app status visit
    $av="update appointment set App_Status='Visited' where App_Id=$id";
    mysqli_query($db,$av) or die("query failed");
}
else{
    echo "<script>alert('Appointment Id is Unavaliable')</script>";
}
    echo "<script>window.onload = function(){
        document.getElementById('visitBtn').click();
        }</script>";
}
function searchvisitdate(){
    if(isset($_POST["visitdate"]) && $_POST["visitdate"] != null && $_POST["visitdate"] != ''){
    $visitdate=$_POST["visitdate"];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    // get app fees
    $q="select * from visit inner join payment on visit.Visit_Id = payment.Visit_Id inner join payment_Type on payment.PayType_Id = payment_Type.PayType_Id where Date='$visitdate'"; 
    $result=mysqli_query($db,$q) or die("query failed");
    echo "<table border=1 style='border-collapse:collapse;text-align:center;width:80%;'>
        <tr><th>Visit Id</th>
        <th>Appointment Id</th>
        <th>Payment Id</th>
        <th>Payment Type</th>
        <th>Ammount</th>
        <th>Date</th></tr>" ;
    while ($row=mysqli_fetch_array($result)){
        echo'<tr><td>'.$row["Visit_Id"].'</td><td>'.$row["App_Id"].'</td><td>'.$row["Payment_Id"].'</td><td>'.$row["PayName"].'</td><td>'.$row["Ammount"].'</td><td>'.$row["Date"].'</td></tr>';
        }
        //echo"<tr>"; foreach($row as $k=>$v) echo "<td>".$v."</td>"; echo "</tr>";
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('visitBtn').click();
            }</script>";  
        }
        else{
            echo "<script>alert('Please enter visit date')</script>";
        }

}
function searchvid(){
    if(isset($_POST["visitid"]) && $_POST["visitid"] != null && $_POST["visitid"] != ''){
    $visitid=$_POST["visitid"];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    // get app fees
    $q="select * from visit inner join payment on visit.Visit_Id = payment.Visit_Id inner join payment_Type on payment.PayType_Id = payment_Type.PayType_Id where visit.Visit_Id=$visitid"; 
    $result=mysqli_query($db,$q) or die("query failed");
    echo "<table border=1 style='border-collapse:collapse;text-align:center;width:80%;'>
        <tr><th>Visit Id</th>
        <th>Appointment Id</th>
        <th>Payment Id</th>
        <th>Payment Type</th>
        <th>Ammount</th>
        <th>Date</th></tr>" ;
    while ($row=mysqli_fetch_array($result)){
        echo'<tr><td>'.$row["Visit_Id"].'</td><td>'.$row["App_Id"].'</td><td>'.$row["Payment_Id"].'</td><td>'.$row["PayName"].'</td><td>'.$row["Ammount"].'</td><td>'.$row["Date"].'</td></tr>';
        }
        //echo"<tr>"; foreach($row as $k=>$v) echo "<td>".$v."</td>"; echo "</tr>";
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('visitBtn').click();
            }</script>";
           }   else{
                echo "<script>alert('Please enter visit id')</script>";
            }
}
function searchpid(){
    if(isset($_POST["vpid"])  && $_POST["vpid"] != null && $_POST["vpid"] != ''){
    $pid=$_POST["vpid"];
    $db=@mysqli_connect('localhost','root','');
    if (!$db) die("no connection");
    if (!@mysqli_select_db($db,'clinic')) die("no db");
    // get app fees
    $q="select * from visit inner join payment on visit.Visit_Id = payment.Visit_Id inner join payment_Type on payment.PayType_Id = payment_Type.PayType_Id inner join appointment on appointment.App_Id = visit.App_Id where appointment.Pat_User_Id=$pid"; 
    $result=mysqli_query($db,$q) or die("query failed");
    echo "<table border=1 style='border-collapse:collapse;text-align:center;width:80%;'>
        <tr><th>Visit Id</th>
        <th>Appointment Id</th>
        <th>Payment Id</th>
        <th>Payment Type</th>
        <th>Ammount</th>
        <th>Date</th></tr>" ;
    while ($row=mysqli_fetch_array($result)){
        echo'<tr><td>'.$row["Visit_Id"].'</td><td>'.$row["App_Id"].'</td><td>'.$row["Payment_Id"].'</td><td>'.$row["PayName"].'</td><td>'.$row["Ammount"].'</td><td>'.$row["Date"].'</td></tr>';
        }
        //echo"<tr>"; foreach($row as $k=>$v) echo "<td>".$v."</td>"; echo "</tr>";
        echo "</table>";
        echo "<script>window.onload = function(){
            document.getElementById('visitBtn').click();
            }</script>";
}
else{
    echo "<script>alert('Please enter patient id')</script>";
}
}




?>