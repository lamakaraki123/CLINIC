<?php
    session_start();
    include 'common.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verfication</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <Label>Your Code :</Label><input type="text" name="code">
            <input type="submit" name="csub">
        </form>
        <?php
        if(array_key_exists('csub', $_POST)) {
            if($_POST["code"] == $_SESSION["rand"]){
                insertuser();
                header('Location: ' . "login.php");
            }
            else{
                echo'wrong code try again;';
            }
        }?>
        <select>
            <option value="1">patient</option>
            <option value="2">doctor</option>
        </select>
    </div>
</body>
</html>