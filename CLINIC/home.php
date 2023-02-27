<?php
    session_start();
    include 'functions.php';

    if(array_key_exists('checkb', $_POST)) {
        checkapp();
        
    }else if(array_key_exists('bookb', $_POST)) {
        insertapp();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLINIC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="home.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
    <section class="home" id="home">
        
            <div class="nav">
                <div class="logo">
                    MEDI<span class="x">X</span> 
                </div>
                <ul>
                    <li><a id="2" href="profile.php">PROFILE</a></li>
                    <li>
                        <a id="3" onclick="showappdrop();" style="color: white;cursor: pointer;"><span class="drm">APPOINTMENT <i class="fa fa-caret-down"></i></span></a>
                        <ul class="appdrop" id="appdrop" style="display: none;color: white;cursor: pointer;">
                            <li><a href="#apphours" class="dr">BOOK APPOINTMENT</a></li>
                            <li><a href="app.php" class="dr">RESERVED APPOINTMENT</a></li>
                        </ul>
                    </li>
                    <li><a id="4" href="#doc">DOCTORS</a></li>
                    <li><a id="5" href="#contact">CONTACT US</a></li>
                    <li><a id="6" href="#aboutus">ABOUT US</a></li>
                    <li><a href="login.php">LOG-OUT</a></li>
                </ul>
            </div>

        <div class="animated-title">
            <div class="text-bottom">
              <div>
                <span class="l2">YOUR HEALTH</span>
                <span class="l3">IS OUR PRIORITY</span>
              </div>
            </div>
            <div class="text-top">
              <div class="l1">MEDICAL CENTER</div>
            </div>
          </div>
</section>
    <section class="apphours" id="apphours">
        <div class="secflex">
            
            <div id="d2">
                <div class="dtitle">
                    <span id="top">MAKE AN</span><br>
                    <span id="bot">APPOINTMENT</span>
                </div>
                <form action="#" method="post" name="bookform1" id="bookform1">
                <?php echo'<input type="hidden" id="patientid" name="patientid" value="'.$_SESSION["pid"].'">';?>
                <table class="tableapp">
                    <tr> <td><select style="height: 40%;
                                            background-color: transparent;
                                            width: 200px;
                                            border: 1px solid white;
                                            color : white;
                                            padding-left: 8px;
                                            font-size: large;" name="apptype" required><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select AppType_Id,Name from appointment_type "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option style='color:black;' value='".$row["AppType_Id"]."'>".$row["Name"]."";
                                                                            }
                                                                        ?></select></td>
                         <td><select style="height: 40%;
                                            background-color: transparent;
                                            width: 200px;
                                            border: 1px solid white;
                                            color : white;
                                            padding-left: 8px;
                                            font-size: large;" name="doctorname" required><?php $db=@mysqli_connect('localhost','root','');
                                                                        if (!$db) die("no connection");
                                                                        if (!@mysqli_select_db($db,'clinic')) die("no db");
                                                                        $q="select doctor.User_Id,Dfname from doctor inner join account on account.User_Id = doctor.User_Id where Activision='A' "; 
                                                                        $result=mysqli_query($db,$q) or die("query failed");
                                                                        while ($row=mysqli_fetch_array($result)){ 
                                                                            echo "<option style='color:black;' value='".$row["User_Id"]."'>".$row["Dfname"]."</option>";
                                                                            }
                                                                        ?></select></td></tr>
                    <tr> <td><input type="text" placeholder="DATE" name="appdate" onfocus="(this.type='date')" onchange="var a = getDayName(this.value);" required></td>
                         <td><select id="timeselect" style="height: 40%;
                                            background-color: transparent;
                                            width: 200px;
                                            border: 1px solid white;
                                            color : white;
                                            padding-left: 8px;
                                            font-size: large;" name="apptime" required>
                                                    <option style='color:black;' value='' disabled selected hidden>TIME</option>
                                                </select></td> </tr>
                    <tr> <td><input type="submit" id="checkbtn" style="background-color: white;color: black;font-weight: bold;border-radius: 20px;cursor: pointer;" class="checkbtn" value="CHECK APPOINTMENT" name="checkb"></td></tr>
                </table>
                </form>
            </div>
            <div id="d3">
                <div class="dtitle">
                    <span id="top">OPENING</span><br>
                    <span id="bot">HOURS</span>
                    <table class="tablehours">
                        <tr>
                            <td>MONDAY - FRIDAY</td><td>8:00 - 17:00<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                              </svg></td>
                        </tr>
                        <tr>
                            <td>SATURDAY</td><td>9:20 - 17:00<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                              </svg></td>
                        </tr>
                        <tr>
                            <td id="tdbot">SUNDAY</td><td id="tdbot">10:00 - 14:00<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                              </svg></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="doctors" id="doc">
        <div class="doctitle"><span id="top">OUR<br></span><span id="bot">DOCTORS</span></div>
        <div class="cardsgroup">
            <?php
                $db=@mysqli_connect('localhost','root','');
                if (!$db) die("no connection");
                if (!@mysqli_select_db($db,'clinic')) die("no db");
                $q="select * from doctor inner join specialization on specialization.Speciality_Id = doctor.Speciality_Id inner join account on account.User_Id = doctor.User_Id where Activision='A'"; 
                $result=mysqli_query($db,$q) or die("query failed");
                $i = 0;
                while ($row=mysqli_fetch_array($result) and $i<3){ 
                    echo '
                    <div class="card" style="width: 18rem;">
                    <img src="profile.png" class="card-img-top">
                    <div class="card-body">
                    <h5 class="card-title">Dr. '.$row["Dfname"].'</h5>
                    <p class="card-text">Special In '.$row["Speciality_Name"].'</p>
                    <p class="card-text">'.$row["Demail"].'</p>
                    <p class="card-text">'.$row["Dphone"].'</p>
                    </div>
                    </div>';
                    $i = $i + 1;
                    }
            ?>
                
        </div>
        <div class="doctorpic">
            <img src="doctor.png" alt="">
        </div>
        <button id="more"><a href="doc.php" color="black">SEE MORE>></a></button>
    </section>
    
    <section class="contact" id="contact">
        <div class="dtitle">
            <span id="top">OUR</span><br>
            <span id="bot">CONTACTS</span>
        </div>
        <div id="d1">
            <table class="tablecontacts">
                <tr>
                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                      </svg>alhamra street-beurit-lebanon</td>
                </tr>
                <tr>
                    <td id="tdbot"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                      </svg> 01 / 571289 - 01 / 231432</td>
                </tr>
                <tr>
                    <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                      </svg>clinic123@outlook.com</td>
                </tr>
            </table>
        </div>
        <div class="socialmedia">
            <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
              </svg><a href="#" id="slink">FACEBOOK</a></div>
                <div> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
              </svg><a href="#" id="slink">INSTAGRAM</a></div>
              <div> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
              </svg><a href="#" id="slink">TWITTER</a></div>
              <div> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
              </svg><a href="#" id="slink">GOOGLE</a></div>
        </div>
        <h6></h6>
        <h6></h6>
    </section>
    <section class="aboutus" id="aboutus">
        <div class="abouttitle">
            <span id="top">ABOUT</span><br>
            <span id="bot">US</span>
        </div>
        <div id="d1">
            <div class="aboutp">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae voluptates delectus reprehenderit ab 
            cupiditate harum ad necessitatibus tenetur soluta repellat. Tempore fuga dolores, animi sunt qui earum
             repellendus quaerat beatae. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis, aliquid!
             Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore enim, eos nulla molestias aliquid
              accusamus illo quam recusandae esse ratione quia ex sapiente, rerum ullam! Officiis quo eos debitis mollitia.
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis, hic!
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio repellendus dicta porro recusandae nobis obcaecati?
               Rerum distinctio velit exercitationem cum autem animi temporibus iste! Facilis culpa maiores modi pariatur odio.
            </div>
        </div>
        <h6>Copyright © MediX - All Rights Reserved </h6>
        <h6>Powered and designed by yousef & karaki</h6>
    </section>
    <?php if(isset($_POST["checkb"])){
                            if($_SESSION["ava"] == 'yes'){
                                echo'<div class="appalert" id="appalert">
                                <br>
                                <button class="alertb"  onclick="hidealert();">X</button>
                                <br><br><p class="alerttext" ><span id="evo">Appointment Avaliable</span> <br><br> Please Confirm to Complete booking</p><br><br>
                                <div class="bcon">
                                    <form method="post">
                                            <input type="submit" name="bookb" value="Confirm Appointment">
                                    </form>
                                </div>
                            </div>';
                            }
                                }?>
</body>
<script>window.onload = function(){
    document.getElementById('appdrop').style.display = "none";
    }</script>
    <script>
if(window.history.replaceState ){
  window.history.replaceState( null, null, window.location.href );
  }
</script>
</html>