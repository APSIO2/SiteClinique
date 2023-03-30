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
        <a href="/PHP/dashboardSecretaire.php"><h1>LPF CLINIQUE</h1></a>
        <a class="icone" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
        </svg></a>
    </div>

    <div class="formpreadsup">
        <h2>Les rendez-vous :</h2>
        <div class="flexpread">
            <?php
            require("ConnexionBdd.php");
                try{

                    $conn = connexionBdd();
                    $stmt = $conn->query("SELECT `num_op`,`nom_med`,`date_op`,`heure_op`,`pre_admission`,`nom_naissance`, operation.`num_secu`, personnel.`num_med` FROM `operation` INNER JOIN `personnel` on operation.num_med=personnel.num_med inner join `patient` on operation.num_secu=patient.num_secu order by date_op asc");
                    foreach ($stmt as $row){
                ?>
            <div class="pread">

            <?php
                $num_med = $row["num_med"];
                $num_op = $row["num_op"];
                $nom_med = $row["nom_med"];
                $date_op = $row["date_op"];
                $heure_op = $row["heure_op"];
                $pre_ad = $row["pre_admission"];
                $nom_nai = $row["nom_naissance"];
                $num_secu = $row["num_secu"];
                $today = date('Y-m-d');
            
                echo "<form action='updatePread.php' class='' method='get'>";
                echo "<label>Numéro de l'opération :</label><br>";
                echo '<input name="num_op" type="text" value="'. $num_op .'" readonly class="info_pat"> <br>';
                echo "<label>Nom du médecin : $nom_med</label><br>";
                echo '<select name="num_med" value="'.$nom_med.'" id="" class="list_med">';
                    try{
                        $conn = connexionBdd();
                        $stmt = $conn->prepare('SELECT * FROM personnel WHERE num_role="01";');
                        $stmt->execute();

                        foreach ($stmt as $row) {
                            $num_med = $row[0];
                            $nom = $row[3];
                            echo "<option value='$num_med'> $nom</option>";
                            }
                        }
                        catch(PDOException $e){
                            echo $e->getMessage();


                            
                        }

                echo '</select>';
                echo "<label>La date du rendez-vous :</label><br>";
                echo '<input name="date_op" type="date"  min="'.$today.'" value="'. $date_op .'"> <br>';
                echo "<label>L'heure du rendez-vous :</label><br>";
                echo '<input name="heure_op" type="time" value="'. $heure_op .'"> <br>';
                echo "<label>Admissions pour :</label><br>";
                echo '<input name="pre-ad" type="text" value="'. $pre_ad .'"> <br>';
                echo "<label>Nom du patient : Numéro Sécurité Social :</label><br>";
                echo '<input name="nom_nai" type="text" value="'. $nom_nai .'" readonly class="info_pat">';
                echo '<input name="num_secu" type="text" value="'. $num_secu .'" readonly class="info_pat"><br>';
                echo '<button class="btn" type="submit">Modifier</button>';
                echo "</form>";
                echo '<p class="btn"><a href="suppread.php?num_op='.$num_op.'">Supprimer</a></p>';
                echo '</div>';
                
                }
                }
                catch(PDOException $e){echo $e->getMessage();}
            ?>
        </div>
    </div>

    <?php
        try{
            $conn = connexionBdd();

        //------------------------------------------------AFFICHAGE--------------------------------------------------

            $stmt = $conn->prepare("SELECT `num_op`,`nom_med`,`date_op`,`heure_op`,`pre_admission`,`nom_naissance` FROM `operation` INNER JOIN `personnel` on `operation.num_med`=`personnel.num_med` inner join `patient` on `operation.num_secu`=`patient.num_secu`");

        //-------------------------------------------------SUPPRESSION------------------------------------------------
            $stmt2 = $conn->prepare("DELETE FROM `operation` WHERE `operation.num_op` = ");

        //-------------------------------------------------FILTRER----------------------------------------------------


        
        }
        catch(PDOException $e){echo $e->getMessage();}
    ?>
</body>
</html>
