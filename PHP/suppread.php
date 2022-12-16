<?php

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "03"){
    header("Location: ../index.php");
}


$num_op = $_GET['num_op'];


try{
    $conn = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');
    $stmt2 = $conn->prepare("DELETE FROM `operation` WHERE `operation.num_op` = $num_op");
}
catch(PDOException $e){}

header("Location: delpread.php");

?>