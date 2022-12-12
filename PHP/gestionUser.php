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
        <h1>LPF CLINIQUE</h1>
        <a class="icone" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
        </svg></a>
    </div>

    <?php
        if (isset($_GET['error']) && $_GET['error'] == 1){
    ?>
        <div class="erreur">
            <p class="erreurtext">Erreur l'utilisateur existe déjà !</p>
        </div>

    <?php } ?>

    <?php
        if (isset($_GET['error']) && $_GET['error'] == 2){
    ?>
        <div class="erreur">
            <p class="erreurtext">Erreur: vous ne pouvez pas supprimer des administrateurs</p>
        </div>

    <?php } ?>

    
    <form action="adduser.php" method="post">
        <div class="formuser">
            <h2>Crée un utilisateur</h2>
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Prenom :</p>
                    <input type="text" name="prenom" class="fullform" required>
                </div>
            </div>  
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Nom :</p>
                    <input type="text" name="nom" class="fullform" required>
                </div>
            </div>  
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Identifiant :</p>
                    <input type="text" name="id" class="fullform" required>
                </div>
            </div>  
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Mot de passe :</p>
                    <input type="text" name="mdp" class="fullform" required>
                </div>
            </div>
            <div class="formItem">
                <div class="midblock">
                    <p class="fullform">Services</p>
                    <select name="service" id="" class="fullform" required>

                        <?php
                        $conn = new PDO('mysql:host=localhost:3307;dbname=Hopitale', 'root');
                        $stmt = $conn->prepare('SELECT * FROM service');
                        $stmt->execute();

                        foreach ($stmt as $row) {

                            $num_services = $row['num_serv'];
                            $libelle = $row['libelle'];

                            echo "<option value='$num_services'>$libelle</option>";

                        }
                        ?>


                    </select>
                </div>
            </div>

            <div class="formItem">
                <input type="submit" class="buttonFormValid" value="Crée l'utilisateur">
            </div>  
        </div>
    </form>

    <div class="formusersup">
        <h2>Supprimer un utilisateur</h2>
        <div class="flexuser">
        <?php

            try{
                $stmt = $conn->prepare('SELECT * FROM personnel');
                $stmt->execute();
                        
            foreach ($stmt as $row) {
                ?>
                
                <div class="user">
                
                <?php
            
                $nom = $row["nom_med"];
                $serv = $row["num_serv"];
                $id = $row["num_med"];
                echo '<p class="textuser">'. $nom ."</p>";
                echo '<p class="textuser">' . $serv . "</p>";
                echo '<p class="btn"><a href="supuser.php?id='.$id.'&serv='.$serv.'">Supprimer</a></p>';
                echo '</div>';
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
            
        ?>

                
            </div>
        </div>
    </div>
</div>
</body>
</html>