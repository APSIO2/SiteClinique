<?php

require("ConnexionBdd.php");

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "02"){
    header("Location: ../index.php");
}


$id = $_GET['id'];
$serv = $_GET['serv'];

if ($serv == "02") {

    header("Location: gestionUser.php?error=2");
    die();

}

try{
    $conn = connexionBdd();
    $stmt2= $conn->query("DELETE FROM personnel WHERE num_med = $id;");
}
catch(PDOException $e){}

header("Location: gestionUser.php");

?>