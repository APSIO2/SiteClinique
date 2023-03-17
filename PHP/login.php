<?php 
    require("ConnexionBdd.php");
    $id = $_POST["id"];
    $mdp = $_POST["mdp"];
    echo "$id";
    echo "$mdp";
    session_start();


    try{
        $conn = connexionBdd();
        $stmt = $conn->prepare('SELECT * FROM personnel WHERE id=:id and mdp=:mdp;');
        $stmt->execute([":id"=>$id,":mdp"=>$mdp]);
                
    foreach ($stmt as $row) {

        $_SESSION['services'] = $row['num_serv'];

        switch($row['num_serv']){
            case 01:
                header("Location: medecin.php");
                $_SESSION['id'] = $row['num_med'];
                die();
            case 02:
                //  ADMIN
                header("Location: dashboard.php");
                die();
            case 03:
                // Sectretaire
                header("Location: dashboardSecretaire.php");
                die();
            }
        
        }
        header("Location: ../index.php");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>