<?php

require("ConnexionBdd.php");

session_start();
if(!isset($_SESSION['role'])){
    header("Location: ../index.php");
}else if($_SESSION['role'] != "02"){
    header("Location: ../index.php");
}


$id = $_GET['id'];

try{
    $conn = connexionBdd();
    $sth = $conn->prepare("SELECT * FROM personnel where num_serv = $id");
    $sth->execute();
    $result = $sth->fetchColumn();
    if($result != null){

        header("Location: gestionservices.php?error=3");


    }else{
        $stmt2= $conn->query("DELETE FROM service WHERE num_serv = $id;");
        header("Location: gestionservices.php?success=2");
    }




}
catch(PDOException $e){
    echo $e->getMessage();
}
?>