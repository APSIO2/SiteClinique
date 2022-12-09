<?php 
    $id = $_POST["id"];
    $mdp = $_POST["mdp"];
    echo "$id";
    echo "$mdp";
    try{
        $conn = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');
        $stmt = $conn->prepare('SELECT * FROM personnel WHERE id=:id and mdp=:mdp;');
        $stmt->execute([":id"=>$id,":mdp"=>$mdp]);
                
    foreach ($stmt as $row) {
        echo "1";
        header("Location: dashboard.php");
        die();
        }
        header("Location: ../index.php");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>