<?php

require("ConnexionBdd.php");

session_start();
if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
}else if($_SESSION['role'] != "02"){
    header("Location: ../index.php");
}


$id = $_GET['id'];
$serv = $_GET['role'];

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