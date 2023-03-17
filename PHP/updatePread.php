<?php
require("ConnexionBdd.php");
session_start();
if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
}else if($_SESSION['role'] != "03"){
    header("Location: ../index.php");
}


$num_op = $_GET['num_op'];
$num_med = $_GET['num_med'];
$date_op = $_GET['date_op'];
$heure_op = $_GET['heure_op'];
$pread = $_GET['pre-ad'];
$nom_nai = $_GET['nom_nai'];
$num_secu = $_GET['num_secu'];


try{
    $conn = connexionBdd();
    $sql = "UPDATE `operation` SET `num_med`=$num_med,`num_secu`='$num_secu',`date_op`='$date_op',`heure_op`='$heure_op',`pre_admission`='$pread' WHERE operation.num_op = $num_op";
    echo $sql;
    $stmt3 = $conn->query("UPDATE `operation` SET `num_med`=$num_med,`num_secu`='$num_secu',`date_op`='$date_op',`heure_op`='$heure_op',`pre_admission`='$pread' WHERE operation.num_op = $num_op");
}
catch(PDOException $e){}


header("Location: gestionPread.php");

?>