<?php
function insertapp(){
    
    $db=@mysqli_connect('localhost','root','');
                            if (!$db) die("no connection");
                            if (!@mysqli_select_db($db,'clinic')) die("no db");
                            
                            $b=$_SESSION['happdoc'];
                            $a=$_SESSION['pid'];
                            $c=$_SESSION['happtype'];
                            $d=$_SESSION['happdate'];
                            $e=$_SESSION['happtime'];

                            $q="insert into appointment(Pat_User_Id,Doc_User_Id,AppType_Id,App_Date,App_Time,App_Status) values($a,$b,$c,'$d','$e','Pending') ";
            
                            if(mysqli_query($db,$q)){
                                echo "<script>alert('Appointment Booked')</script>";
                            }
                            else{
                                echo "<script>alert('Failed To Book Appointment ')</script>";
                            }
                            
                    }
                            
                        
                            


                            function checkapp(){
                                if(isset($_POST['appdate']) && isset($_POST['apptime'])){
                                $db=@mysqli_connect('localhost','root','');
                                if (!$db) die("no connection");
                                if (!@mysqli_select_db($db,'clinic')) die("no db");
                                $type=$_POST["apptype"];
                                $doctor=$_POST["doctorname"];
                                $d=$_POST['appdate'];
                                $t=$_POST['apptime'];
                                $q="select * from appointment where App_Date='$d' and App_Time='$t' and Doc_User_Id=$doctor";
                                $result=mysqli_query($db,$q) or die("query failed");
                                if( $d > date('Y-m-d')){
                                    if (mysqli_num_rows($result) == 0){   
                                            $_SESSION["ava"] = "yes";
                                            $_SESSION["happdate"] = $_POST["appdate"];
                                            $_SESSION["happtime"] = $_POST["apptime"];
                                            $_SESSION["happdoc"] = $_POST["doctorname"];
                                            $_SESSION["happtype"] = $_POST["apptype"];

                                    }else if (mysqli_num_rows($result) > 0){
                                            $_SESSION["ava"] = "no";
                                            echo'<script>alert("Appointment Unavaliable");</script>';
                                    }
                                }
                                else{
                                    echo'<script>alert("Invalid Date");</script>';
                                        $_SESSION["ava"] = "no";
                                }
                            }
                            else{
                                echo "<script>alert('Please fill fields required for appointment booking')</script>";
                            }
                            }

                            
?>