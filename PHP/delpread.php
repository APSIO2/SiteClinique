<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="../JS/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Roboto&display=swap" rel="stylesheet"> 
    <title>Tableau de bord</title>
</head>
<body>
    <div class="nav">
        <a href="PHP/dashboardSecretaire.php"><h1>LPF CLINIQUE</h1></a>
        <a class="icone" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
        </svg></a>
    </div>
    <?php
        try{
            $conn = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');

        //------------------------------------------------AFFICHAGE--------------------------------------------------

            $stmt = $conn->prepare("SELECT `num_op`,`nom_med`,`date_op`,`heure_op`,`pre_admission`,`nom_naissance` FROM `operation` INNER JOIN `personnel` on `operation.num_med`=`personnel.num_med` inner join `patient` on `operation.num_secu`=`patient.num_secu`");
        
        //-------------------------------------------------SUPPRESSION------------------------------------------------
            $stmt2 = $conn->prepare("DELETE FROM `operation` WHERE `operation.num_op` = ");
        }
        catch(PDOException $e){echo $e->getMessage();}
    ?>
</body>
</html>