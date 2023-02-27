<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/1f13d79974.js" crossorigin="anonymous"></script>
</head>

<body>

    <h1> Our Doctors </h1>



    <?php
    include('./connection.php');
    $sql = "SELECT * FROM doctor INNER JOIN specialization on doctor.Speciality_Id=specialization.Speciality_Id inner join account on account.User_Id = doctor.User_Id where Activision='A' ";
    
    $result = $db->query($sql);
    



    if ($result->num_rows > 0) {
        echo "<div class='cards-container'>";
        while ($row = $result->fetch_assoc()) {

            echo "<div class='card'>
    
        <h2> <i class='fa-solid fa-user-doctor'></i>  " . $row['Dfname'] . " 
        " . $row['Dlname'] . "</h2>
       <h2><i class='fa-solid fa-stethoscope'></i> " . $row['Speciality_Name'] . "</h2>
        <h3><i class='fa-solid fa-envelope'></i> <a href='mailto:email@example.com'>" . $row['Demail'] . "</a></h3>
       <h3> <i class='fa-solid fa-phone'></i>" . $row['Dphone'] . "</h3>
       </div>";
        }





        echo "
     </table>";
    } else
        echo "0 result";
    $db->close();
    ?>

</body>

</html>