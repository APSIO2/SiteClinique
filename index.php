<?php

session_start();

// si la session et deja crée
if(!isset($_SESSION['services'])){

}else if($_SESSION['services'] == "01"){

    header("Location: PHP/medecin.php");
    // MEDECIN

}else if($_SESSION['services'] == "02"){

    // Admin
    header("Location: PHP/dashboard.php");
    die();

}else if($_SESSION['services'] == "03"){

    // Sectretaire
    header("Location: PHP/pre-admission.php");
    die();

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
    <link rel="icon" href="IMG/lpf.png" />
    <title>LPF CLINIQUE</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    
    <div class="nav">
    <h1>LPF CLINIQUE</h1>
    </div>
    <form action="PHP/login.php" method="POST">
        <div class="formcon">
            <h2>Connectez-vous</h2>
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Identifiant :</p>
                    <input type="text" name="id" class="fullform">
                </div>
            </div>
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Mot de passe :</p>
                    <input type="password" name="mdp" class="fullform">
                </div>
            </div>
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Captcha</p>
                    <input name="captcha" type="text">
                    <img src="PHP/captcha.php" style="vertical-align: middle;"/>
                </div>
            </div>
            <div class="formItem">
                <input type="submit" class="buttonFormValid" value="Connexion">
            </div>
        </div>
    </form>
</body>
</html>