<?php

//  ---------------------------------------------------------------- Variable ----------------------------------------------------------------

$num_secu = $_POST['num_secu'];
$nom_nai = $_POST['nom_nai'];
$prenom_pat = $_POST['prenom'];
$civ_pat = $_POST['civ_pat'];
$date_nai = $_POST['date_nai'];
$adresse_pat = $_POST['adresse_pat'];
$cp_pat = $_POST['cp_pat'];
$ville_pat = $_POST['ville_pat'];
$nom_ep = $_POST['nom_ep'];
$date_op = $_POST['date_op'];
$heure_op = $_POST['heure_op'];
$pred_ad = $_POST['pre_ad'];
$nom_med = $_POST['nom_med'];
$mail_pat = $_POST['mail'];
$tel_pat = $_POSt['tel'];
$num_conf = "1";
$num_prev = "1";
$num_secu_conf = $_POST["num_secu_conf"];
$nom_conf = $_POST["nom_conf"];
$prenom_conf = $_POST["prenom_conf"];
$tel_conf = $_POST["tel_conf"];
$cp_conf = $_POST["cp_conf"];
$ville_conf = $_POST["ville_conf"];
$adresse_conf = $_POST["adresse_conf"];
$num_secu_prev = $_POST["num_secu_prev"];
$nom_prev = $_POST["nom_prev"];
$prenom_prev = $_POST["prenom_prev"];
$tel_prev = $_POST["tel_prev"];
$cp_prev = $_POST["cp_prev"];
$ville_prev = $_POST["ville_prev"];
$adresse_prev = $_POST["adresse_prev"];

//  ---------------------------------------------------------------- Uploads ----------------------------------------------------------------


$orderDateNais = explode('-', $date_nai);
$anneeActuel = date('Y');
echo "Année de naissance : $orderDateNais[0] <br>";
echo "numero du patient : $num_secu <br><br>";

$pathimage = "../scan/$num_secu";
if(!file_exists($pathimage)){
    mkdir($pathimage);
}


uploads("ci","Carte_didentites",$pathimage);
uploads("cv","Carte_vitale",$pathimage);
uploads("mutuel","mutuel",$pathimage);
uploads("livret","livret_de_famille",$pathimage);

function uploads($namef,$namefile,$path) {
    $tmpname = $_FILES[$namef]['tmp_name'];
    $name =  $_FILES[$namef]['name'];
    $extension = strrchr($name, '.');
    move_uploaded_file($tmpname, $path."/".$namefile.$extension);
    echo "Files uploads : $namefile$extension <br>";
}



//  ---------------------------------------------------------------- Insert ----------------------------------------------------------------
// ================================================================= Patient =================================================================
try{
    
    $conn = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');

    // On recupere le numero du medecin.

    $stmt = $conn->prepare("SELECT * FROM `personnel`;");
    $stmt->execute();
    foreach ($stmt as $row){

        if ($nom_med==$row['prenom_med']) {

            $num_med = $row['num_med'];
    
        }

    } 

    // On verifie si le patien existe deja.

    $stmt = $conn->prepare("SELECT * FROM `patient`;");
    $stmt->execute();
    foreach ($stmt as $row){

        if ($num_secu==$row['num_secu']) {

            echo "<br><font color='lightseagreen'>INFO: Patient déjà en Base. </font><br>";
            $patienEnBase = true; // la variable sert pour les if des insert.

        }

    }

    // on ajoute le patient dans tout les cas.

    if ($anneeActuel-$orderDateNais[0] < 18 && !$patienEnBase){ 

        $stmt2= $conn->query("INSERT INTO patient (`nom_naissance`, `prenom_pat`, `civ_pat`, `date_naissance`, `adresse_pat`, `cp_pat`, `ville_pat`, `email_pat`, `tel_pat`, `nom_epouse`, `num_secu`, `mineur`, `num_conf`, `num_prev`) VALUES ('$nom_nai','$prenom_pat','$civ_pat','$date_nai','$adresse_pat','$cp_pat','$ville_pat','$mail_pat','$tel_pat','$nom_nai','$num_secu','1','$num_conf','$num_prev')");
        echo "<font color='lightseagreen'>INFO: Insertion majeur Fait. </font><br>";

    }else if($anneeActuel-$orderDateNais[0] > 18 && !$patienEnBase){

        $stmt2= $conn->query("INSERT INTO patient (`nom_naissance`, `prenom_pat`, `civ_pat`, `date_naissance`, `adresse_pat`, `cp_pat`, `ville_pat`, `email_pat`, `tel_pat`, `nom_epouse`, `num_secu`, `mineur`, `num_conf`, `num_prev`) VALUES ('$nom_nai','$prenom_pat','$civ_pat','$date_nai','$adresse_pat','$cp_pat','$ville_pat','$mail_pat','$tel_pat','$nom_ep','$num_secu','0','$num_conf','$num_prev')");
        echo "<font color='lightseagreen'>INFO: Insertion mineur Fait.</font> <br>";
    }


// ================================================================= Operation =================================================================

    // On verifie si une operation existe deja dans cest horraire.

    $stmt = $conn->prepare("SELECT * FROM `operation`;");
    $stmt->execute();
    $OpEnBase = false;
    foreach ($stmt as $row){

        if ($date_op == $row['date_op'] && $heure_op == $row['heure_op']) {

            $OpEnBase = true;

        }

    }

    // Si il existe pas d'operation pendants cette horraire alors on l'ajoute sinon on mes un message d'erreur.

    if(!$OpEnBase){

        $stmt2= $conn->query("INSERT INTO `operation`(`num_med`, `num_secu`, `date_op`, `heure_op`, `pre_admission`) VALUES ('$num_med','$num_secu','$date_op','$heure_op','$pred_ad')");
        echo "<font color='limegreen'>Sucess: Opération ajouter avec sucess.</font> <br>";

    }else{

        echo "<font color='darkred'>Error: Opération déjà en base.</font> <br>";

    }

}catch(PDOException $e){echo $e->getMessage();}

?>