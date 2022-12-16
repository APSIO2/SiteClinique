<?php



// Verifie si il est admin 

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "02"){
    header("Location: ../index.php");
}

// ================================================================= Variable =================================================================

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$id = $_POST['id'];
$mdp = $_POST['mdp'];
$service = $_POST['service'];

// ================================================================= Insert =================================================================


$conn  = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev','Sio2021*');

$stmt = $conn->prepare('SELECT * FROM personnel');
$stmt->execute();
foreach ($stmt as $row) {


    if($row['id'] == $id){

        header("Location: gestionUser.php?error=1");
        die();
    }

}

$stmt2 = $conn->prepare("INSERT INTO personnel (num_serv, prenom_med, nom_med, id, mdp) VALUES($service, '$prenom', '$nom', '$id' , '$mdp');");
$stmt2->execute();

header("Location: gestionUser.php");
?>