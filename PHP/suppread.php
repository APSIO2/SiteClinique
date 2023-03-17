<?php

require("ConnexionBdd.php");

session_start();
if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
}else if($_SESSION['role'] != "03"){
    header("Location: ../index.php");
}


$num_op = $_GET['num_op'];
echo "$num_op";

try{
    $conn = connexionBdd();
    $stmt2 = $conn->query("DELETE FROM `operation` WHERE operation.num_op = $num_op");
}
catch(PDOException $e){}

header("Location: gestionPread.php");

?>