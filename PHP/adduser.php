<?php
require("ConnexionBdd.php");


// Verifie si il est admin 

session_start();
if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
}else if($_SESSION['role'] != "02"){
    header("Location: ../index.php");
}

// ================================================================= Variable =================================================================

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$id = $_POST['id'];
$mdp = $_POST['mdp'];
$service = $_POST['service'];
$role = $_POST['role'];

// ================================================================= Insert =================================================================

try{

$conn  = connexionBdd();
$stmt = $conn->prepare('SELECT * FROM personnel');
$stmt->execute();
foreach ($stmt as $row) {


    if($row['id'] == $id){

        header("Location: gestionUser.php?error=1");
        die();
    }

}

$stmt2 = $conn->prepare("INSERT INTO personnel (num_serv, prenom_med, nom_med, id, mdp, num_role) VALUES($service, '$prenom', '$nom', '$id', '$mdp', $role);");
$stmt2->execute();
header("Location: gestionUser.php");

}catch (PDOException $e){

}

?>