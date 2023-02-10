<?php

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "02"){
    header("Location: ../index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Roboto&display=swap" rel="stylesheet"> 
    <title>Gestion des utilisateur</title>
</head>
<body>
    <div class="nav">
    <a href="/PHP/dashboard.php"><h1>LPF CLINIQUE</h1></a>
        <a class="icone" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
        </svg></a>
    </div>

    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1){
    ?>
        <div class="erreur">
            <p class="erreurtext">Erreur: le service existe déja !</p>
        </div>

    <?php } ?>

    <?php
        if (isset($_GET['success']) && $_GET['success'] == 1){
    ?>
        <div class="success">
            <p class="successtext">Le services a bien etais crée!</p>
        </div>

    <?php } ?>

    <?php
        if (isset($_GET['error']) && $_GET['error'] == 2){
    ?>
        <div class="erreur">
            <p class="erreurtext">Erreur: vous ne pouvez pas supprimer ce service !</p>
        </div>

    <?php } ?>

    
    <form action="addserv.php" method="post">
        <div class="formuser">
            <h2>Crée un Service</h2>
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Libelle :</p>
                    <input type="text" name="libelle" class="fullform" required>
                </div>
            </div> 
            <div class="formItem">
                <input type="submit" class="buttonFormValid" value="Crée un Service">
            </div>  
        </div>
    </form>
</body>
</html>