<?php

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "01"){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Roboto&display=swap" rel="stylesheet"> 
    <title>Page de connexion</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stats.css">
</head>
<body>
    <div class="nav">
    <h1>LPF CLINIQUE</h1>
    <a class="icone" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
    </svg></a>
    </div>

    <div class="statslist">
        <div class="stats" style="background-color:#6a7eb6; background-image: url('../img/mec.png');">
            <h2 class="textstats">50</h2>
            <p class="libelstats">Nombre d'homme patient<p>
        </div>
        <div class="stats" style="background-color:#c459a0; background-image: url('../img/meuf.png');">
            <h2 class="textstats">50</h2>
            <p class="libelstats">Nombre de femme patiente<p>
        </div>
        <div class="stats" style="background-color:#c45959; background-image: url('../img/kids.png');">
            <h2 class="textstats">50</h2>
            <p class="libelstats">Nombre de patient mineur<p>
        </div>
        <div class="stats" style="background-color:#59c466; background-image: url('../img/fleche.png');">
            <h2 class="textstats">50</h2>
            <p class="libelstats">Nombre de patient<p>
        </div>
    </div>


</body>
</html>