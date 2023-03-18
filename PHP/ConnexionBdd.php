<?php




function connexionBdd(){
    
    $BDD = "Hopitale";
    $USER = "Dev";
    $MDP = "Sio2021*";
    $HOST = "localhost";

    return new PDO("mysql:host=$HOST;dbname=$BDD" ,"$USER" , "$MDP");

}




?>