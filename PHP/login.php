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

            $_SESSION['role'] = $row['num_role'];

            print($row['num_role']);

            switch($row['num_role']){
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
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
  {
    $status = "<p style='color:#FFFFFF; font-size:20px'>
    <span style='background-color:#46ab4a;'>Votre code captcha est correct.</span></p>"; 
  }else{
    $status = "<p style='color:#FFFFFF; font-size:20px'>
    <span style='background-color:#FF0000;'>Le code captcha entré ne correspond pas! Veuillez réessayer.</span></p>";
  }
  echo $status;
?>