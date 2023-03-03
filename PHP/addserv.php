<?php



// Verifie si il est admin 

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "02"){
    header("Location: ../index.php");
}

// ================================================================= Variable =================================================================

$libelle = $_POST['libelle'];

// ================================================================= Insert =================================================================

try{

$conn  = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');
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