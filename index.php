<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>

    <form action="gat.php" class="formflex">
        <div class="enabled" id="form1">
            <h1>Hospitalisation</h1>

            <div class="flexdiv">
                <div>
                    <p>Pré-Admission pour</p>
                    <select name="pre-admi" id="" class="vw40">
                        <option>Ambulatoire chiurgie</option>
                        <option>Hospitalisation</option>
                    </select>
                </div>
            </div>

            <div class="flexdiv">
                <div>
                    <p>Date d'hospitalisation</p>
                    <input type="date" name="dateDosp" class="vw20">
                </div>
                <div class="form2">
                    <p>Date d'hospitalisation</p>
                    <input type="time" name="dateDosp" class="vw20">
                </div> 
            </div>

            <div class="flexdiv">
                <div>
                <p>Nom du medecin</p>
                    <select name="medecin" id="" class="vw40">
                        <?php
                        try{
                            $conn = new PDO('mysql:host=localhost:3307;dbname=Hopital', "root");
                            $stmt = $conn->prepare('SELECT * FROM personnel WHERE service="medecin"');
                            $stmt->execute();
                
                            foreach ($stmt as $row) {
                                $prenom = $row[2];
                                echo "<option>" . $prenom . "</option>";
                            }
                        }
                        catch(PDOException $e){}
                        ?>
                    </select>
                </div>
            </div>
            <div class="flexbtn">
                <a class="btn" onclick="classSuivante(1)">suivant</a>
            </div>
        </div>


        <div class="disabled" id="form2">
            <h1>Patient</h1>
            
            <div class="flexdiv">
                <div>
                    <p>Civ.</p>
                    <select name="civ" class="vw10">
                        <option value="">Mr</option>
                        <option value="">Mee</option>
                    </select>
                </div>
                <div class="form2">
                    <p>Nom de naissance</p>
                    <input type="text" name="nomNais" class="vw15">
                </div>
                <div class="form2">
                    <p>Nom d'épouse</p>
                    <input type="text" name="NomEpou" class="vw15">
                </div>
            </div>

            <div class="flexdiv">
                <div>
                    <p>Prénom</p>
                    <input type="text" name="prenom" id="" class="vw20">
                </div>
                <div class="form2">
                    <p>Date de naissance</p>
                    <input type="date" name="dateNais" id="" class="vw20">
                </div>
            </div>

            <div class="flexdiv">
                <div>
                    <p>Addresse</p>
                    <input type="text" name="address" id="" class="vw40">
                </div>
            </div>

            <div class="flexbtn">
                <a class="btn2" onclick="classPrecedente(2)">precedent</a>
                <a class="btn2 form2" onclick="classSuivante(2)">suivant</a>
            </div>
        </div>


        <div class="disabled" id="form3">
            <h1>Couverture Sociale</h1>

            <div class="flexdiv">
                <div>
                    <p>Organisme de sécurité social</p>
                    <input type="text" name="OrgaSocial" id="" class="vw40">
                </div>
            </div>
            <div class="flexdiv">
                <div>
                    <p>Numéro de sécurité sociale</p>
                    <input type="text" name="NumSecu" id="" class="vw40">
                </div>
            </div>
            <div class="flexdiv">
                <div>
                    <p>Le patient est-il l'assuré ?</p>
                    <select name="" id="" class="vw20">
                        <option value="">Oui</option>
                        <option value="">Non</option>
                    </select>
                </div>
                <div class="form2">
                    <p>Le patient est-il en ALD ?</p>
                    <select name="" id="" class="vw20">
                        <option value="">Oui</option>
                        <option value="">Non</option>
                    </select>
                </div>
            </div>
            
            <div class="flexdiv">
                <div>
                    <p>Nom de la mutuelle ou de l'assurance</p>
                    <input type="text" name="OrgaSocial" id="" class="vw40">
                </div>
            </div>

            <div class="flexdiv">
                <div>
                    <p>Nom d'adhérent</p>
                    <input type="text" name="nomAde" id="" class="vw40">
                </div>
            </div>

            <div class="flexbtn">
                <a class="btn2" onclick="classPrecedente(3)">precedent</a>
                <a class="btn2 form2" onclick="classSuivante(3)">suivant</a>
            </div>

        </div>


        <div class="disabled" id="form4">
            <h1>Documents</h1>
            
            <div class="flexdiv">
                <div>
                    <p>Carte d'identité (recto /verso)</p>
                    <input type="file" name="cd" id="" class="file"> 
                </div>
                <div class="form2">
                    <p>Carte Vitale</p>
                    <input type="file" name="cd" id=""> 
                </div>
            </div>
            <div class="flexdiv">
                <div>
                    <p>Carte mutuelle</p>
                    <input type="file" name="cd" id=""> 
                </div>
                <div class="form2">
                    <p>Livret de famille(pour enfants mineurs)</p>
                    <input type="file" name="cd" id=""> 
                </div>
            </div>

            <div class="flexbtn">
                <a class="btn2" onclick="classPrecedente(4)">precedent</a>
                <input class="submit form2" type="submit" value="Valider">
            </div>
            
        </div>
    </form>
    
</body>
</html>