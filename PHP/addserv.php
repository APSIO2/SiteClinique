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

$libelle = $_POST['libelle'];

// ================================================================= Insert =================================================================

try{

$conn  = connexionBdd();
$stmt = $conn->prepare('SELECT * FROM service');
$stmt->execute();
foreach ($stmt as $row) {


    if($row['libelle'] == $libelle){

        header("Location: gestionservices.php?error=1");
        die();
    }

}

$stmt2 = $conn->prepare("INSERT INTO service(`libelle`) VALUES ('$libelle');");
$stmt2->execute();
header("Location: gestionservices.php?success=1");

}catch (PDOException $e){

}


?>

