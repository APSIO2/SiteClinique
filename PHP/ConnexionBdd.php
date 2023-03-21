<?php




function connexionBdd(){
    
    $BDD = "Hopitale";
    $USER = "root";
    $MDP = "";
    $HOST = "localhost:3307";

    return new PDO("mysql:host=$HOST;dbname=$BDD" ,"$USER" , "$MDP");

}




?>