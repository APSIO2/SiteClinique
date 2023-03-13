<?php

//  ---------------------------------------------------------------- Variables ----------------------------------------------------------------

// ================================================================= Patient =================================================================
$num_secu = $_POST['num_secu'];
$nom_nai = $_POST['nom_nai'];
$prenom_pat = $_POST['prenom'];
$civ_pat = $_POST['civ_pat'];
$date_nai = $_POST['date_nai'];
$adresse_pat = $_POST['adresse_pat'];
$cp_pat = $_POST['cp_pat'];
$ville_pat = $_POST['ville_pat'];
$nom_ep = $_POST['nom_ep'];
$mail_pat = $_POST['mail_pat'];
$tel_pat = $_POST['tel_pat'];

// ================================================================= Opération =================================================================

$date_op = $_POST['date_op'];
$heure_op = $_POST['heure_op'];
$pred_ad = $_POST['pre_ad'];
$nom_med = $_POST['nom_med'];
$chambre = $_POST["chambre"];

// ================================================================= Personne de confiance =================================================================

$nom_conf = $_POST["nom_conf"];
$prenom_conf = $_POST["prenom_conf"];
$tel_conf = $_POST["tel_conf"];
$cp_conf = $_POST["cp_conf"];
$ville_conf = $_POST["ville_conf"];
$adresse_conf = $_POST["adresse_conf"];

// ================================================================= Presonne à prévenir =================================================================

$nom_prev = $_POST["nom_prev"];
$prenom_prev = $_POST["prenom_prev"];
$tel_prev = $_POST["tel_prev"];
$cp_prev = $_POST["cp_prev"];
$ville_prev = $_POST["ville_prev"];
$adresse_prev = $_POST["adresse_prev"];

// ================================================================= Sécurité Sociale Patient =================================================================

$nom_secu = $_POST["nom_secu"];
$nom_mut = $_POST["nom_mut"];
$nom_assu= $_POST["assu"];
$ald = $_POST["ald"];

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

//  ---------------------------------------------------------------- Verification ----------------------------------------------------------------

// ================================================================= Numéro de Sécurité Social =================================================================



// ================================================================= Email =================================================================

// if (filter_var($mailpat, FILTER_VALIDATE_EMAIL)) {
//     echo "Email address '$mailpat' is considered valid.\n";
// } else {
//     echo "Email address '$mailpat' is considered invalid.\n";
// }

//  ---------------------------------------------------------------- Insert ----------------------------------------------------------------
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

// ================================================================= Personne de confiance  =================================================================
    
    $stmt3 = $conn->query("INSERT INTO `personneconf`(`nom_conf`, `tel_conf`, `adresse_conf`, `prenom_conf`) VALUES ('$nom_conf','$tel_conf','$adresse_conf','$prenom_conf')");
 
    
    $stmt = $conn->prepare("SELECT * FROM personneconf WHERE tel_conf = '$tel_conf'");
    $stmt->execute();
    foreach($stmt as $row){
        $num_conf = $row['num_conf']; //recup le num pour l'insert dans la table patient
    }


// ================================================================= Personne  à prevenir  =================================================================
    

    $stmt4 = $conn->query("INSERT INTO `personneprev`(`nom_prev`, `tel_prev`, `adresse_prev`, `prenom_prev`) VALUES ('$nom_prev','$tel_prev','$adresse_prev','$prenom_prev')");


    $stmt = $conn->prepare("SELECT * FROM personneprev WHERE tel_prev = '$tel_prev'");
    $stmt->execute();
    foreach($stmt as $row){
        $num_prev = $row['num_prev']; //recup le num pour l'insert dans la table patient
    }

// ================================================================= Patient =================================================================


    // On verifie si le patient existe deja.

    $stmt = $conn->prepare("SELECT * FROM `patient`;");
    $stmt->execute();
    foreach ($stmt as $row){

        if ($num_secu==$row['num_secu']) {

            echo "<br><font color='lightseagreen'>INFO: Patient déjà en Base. </font><br>";
            $patienEnBase = true; // la variable sert pour les if des insert.

        }

    }

    // on ajoute le patient dans tous les cas.

    if ($anneeActuel-$orderDateNais[0] < 18 && !$patienEnBase){ 

        $stmt2= $conn->query("INSERT INTO patient (`nom_naissance`, `prenom_pat`, `civ_pat`, `date_naissance`, `adresse_pat`, `cp_pat`, `ville_pat`, `email_pat`, `tel_pat`, `nom_epouse`, `num_secu`, `mineur`, `num_conf`, `num_prev`) VALUES ('$nom_nai','$prenom_pat','$civ_pat','$date_nai','$adresse_pat','$cp_pat','$ville_pat','$mail_pat','$tel_pat','$nom_nai','$num_secu','1',$num_conf,$num_prev)");
        echo "<font color='lightseagreen'>INFO: Insertion majeur Fait. </font><br>";

    }else if($anneeActuel-$orderDateNais[0] > 18 && !$patienEnBase){

        $stmt2= $conn->query("INSERT INTO patient (`nom_naissance`, `prenom_pat`, `civ_pat`, `date_naissance`, `adresse_pat`, `cp_pat`, `ville_pat`, `email_pat`, `tel_pat`, `nom_epouse`, `num_secu`, `mineur`, `num_conf`, `num_prev`) VALUES ('$nom_nai','$prenom_pat','$civ_pat','$date_nai','$adresse_pat','$cp_pat','$ville_pat','$mail_pat','$tel_pat','$nom_ep','$num_secu','0',$num_conf,$num_prev)");
        echo "<font color='lightseagreen'>INFO: Insertion mineur Fait.</font> <br>";
    }



    
// ================================================================= Operation =================================================================

    // On verifie si une operation existe deja dans cette horaire.

    $stmt = $conn->prepare("SELECT * FROM `operation`;");
    $stmt->execute();
    $OpEnBase = false;
    foreach ($stmt as $row){

        if ($date_op == $row['date_op'] && $heure_op == $row['heure_op']) {

            $OpEnBase = true;

        }

    }

    // Si il existe pas d'operation pendant cette horaire alors on l'ajoute sinon on met un message d'erreur.

    if(!$OpEnBase){

        $stmt2= $conn->query("INSERT INTO `operation`(`num_med`, `num_secu`, `date_op`, `heure_op`, `pre_admission`) VALUES ($num_med,'$num_secu','$date_op','$heure_op','$pred_ad')");
        echo "<font color='limegreen'>Sucess: Opération ajouter avec sucess.</font> <br>";

    }else{

        echo "<font color='darkred'>Error: Opération déjà en base.</font> <br>";
        

    }

// ================================================================= Couverture Sociale =================================================================

    $stmt=$conn->query("INSERT INTO `couverture sociale`(`nom_secu`, `num_secu`, `nom_assu`, `ald`, `num_adherent`, `chambre`) VALUES ('$nom_secu','$num_secu','$nom_assu','$ald','$num_ad','$chambre')");

}catch(PDOException $e){echo $e->getMessage();}

header("Location: pre-admission.php");
?>