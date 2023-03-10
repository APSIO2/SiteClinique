<?php

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "03"){
    header("Location: ../index.php");
}


$num_op = $_GET['num_op'];
$num_med = $_GET['nom_med'];
$date_op = $_GET['date_op'];
$heure_op = $_GET['heure_op'];
$pread = $_GET['pre_ad'];
$nom_nai = $_GET['nom_nai'];


try{
    $conn = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');
    $stmt2 = $conn->query("SELECT * FROM `patient`");

    foreach($stmt2 as $row){
        $num_secu = $row["num_secu"];
    }

    $stmt3 = $conn->query("UPDATE `operation` SET `num_op`=$num_op,`num_med`=$num_med,`num_secu`=$num_secu,`date_op`=$date_op,`heure_op`=$heure_op,`pre_admission`=$pread WHERE operation.num_op = $num_op");
}
catch(PDOException $e){}

echo $num_med;
// header("Location: gestionPread.php");

?>