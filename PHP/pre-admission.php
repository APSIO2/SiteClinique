<?php

session_start();
if(!isset($_SESSION['services'])){
    header("Location: ../index.php");
}else if($_SESSION['services'] != "03"){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="../JS/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Roboto&display=swap" rel="stylesheet"> 
    <title>Tableau de bord</title>
</head>
<body>
    <div class="nav">
        <a href="/dashboard.php"><h1>LPF CLINIQUE</h1></a>
        <a class="icone" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
        </svg></a>
    </div>
    <form action="pread-sql.php" method="post" enctype="multipart/form-data">
        <div class="form">
            <div id="form1">
                <h2>Hospitalisation</h2>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Pre-admission pour</p>
                        <select name="pre_ad" id="" class="fullform">
                            <option value="hospitalisation">Hospitalisasion</option>
                            <option value="chirurgie_ambulatoire">Chiurgie ambulatoire</option>
                        </select>
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Date d'hospitalisation</p>
                        <input type="date" name="date_op" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Heure d'hospitalisation</p>
                        <input type="time" name="heure_op" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Nom du medecin</p>
                        <select name="nom_med" id="" class="fullform">
                            <?php
                                try{
                                    $conn = new PDO('mysql:host=localhost;dbname=Hopitale', 'Dev' , 'Sio2021*');
                                    $stmt = $conn->prepare('SELECT * FROM personnel WHERE num_serv="01";');
                                    $stmt->execute();
                                            
                                foreach ($stmt as $row) {
                                    $prenom = $row[2];
                                    echo "<option>" . $prenom . "</option>";
                                    }
                                    echo "1";
                                }
                                catch(PDOException $e){
                                    echo $e->getMessage();
                                }

                            ?>
                        </select>
                    </div>
                </div>
                <div id="formItem">
                    <p><a class="ButtonForm" onclick="classSuivante(1)">Suivant</a></p>
                </div>
            </div>
            <div class="disabled" id="form2">
                <h2>Patient</h2>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Numéro de sécurité social</p>
                        <input maxlenght="15" type="text" name="num_secu" id="" class="fullform">
                    </div>
                    </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Civ.</p>
                        <select name="civ_pat" id="" class="midform">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="midblock">
                        <p class="midform">Nom de naissance</p>
                        <input type="text" name="nom_nai" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Nom Épouse</p>
                        <input type="text" name="nom_ep" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Prénom</p>
                        <input type="text" name="prenom" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Date de naissance</p>
                        <input type="date" name="date_nai" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Téléphone</p>
                        <input type="text" name="tel_pat" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Mail</p>
                        <input type="text" name="mail_pat" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Code Postal</p>
                        <input type="text" name="cp_pat" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Ville</p>
                        <input type="text" name="ville_pat" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Adresse</p>
                        <input type="text" name="adresse_pat" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="pbut"><a class="ButtonFormMid" onclick="classPrecedente(2)">Precedent</a></p>
                        <p class="pbut"><a class="ButtonFormMid" onclick="classSuivante(2)">Suivant</a></p>
                    </div>
                </div>
            </div>
            <div class="disabled" id="form3">
                <h2>Couverture Sociale</h2>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Organisme de Sécurité Sociale</p>
                        <input type="text" name="nom_secu" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Assuré ?</p>
                        <select name="assu" id="" class="midform">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                    <div class="midblock">
                        <p class="midform">ALD ?</p>
                        <select name="ald" id="" class="midform">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Nom de la mutuelle ou de l'assurance</p>
                        <input type="text" name="nom_mut" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Numéro d'adhérent</p>
                        <input type="text" name="num_ad" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Chambre particulière ?</p>
                        <select name="chambre" id="" class="fullform">
                            <option value="oui">Oui</option>
                            <option value="non">Non</option>
                        </select>
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="pbut"><a class="ButtonFormMid" onclick="classPrecedente(3)">Precedent</a></p>
                        <p class="pbut"><a class="ButtonFormMid" onclick="classSuivante(3)">Suivant</a></p>
                    </div>
                </div>
            </div>
            <div class="disabled" id="form4">
                <h2>Personne de Confiance</h2>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Nom</p>
                        <input type="text" name="nom_conf" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Prénom</p>
                        <input type="text" name="prenom_conf" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Téléphone</p>
                        <input type="text" name="tel_conf" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Code Postal</p>
                        <input type="text" name="cp_conf" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Ville</p>
                        <input type="text" name="ville_conf" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Adresse</p>
                        <input type="text" name="adresse_conf" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="pbut"><a class="ButtonFormMid" onclick="classPrecedente(4)">Precedent</a></p>
                        <p class="pbut"><a class="ButtonFormMid" onclick="classSuivante(4)">Suivant</a></p>
                    </div>
                </div>
            </div>
            <div class="disabled" id="form5">
                <h2>Personne à Prévenir</h2>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Nom</p>
                        <input type="text" name="nom_prev" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Prénom</p>
                        <input type="text" name="prenom_prev" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Téléphone</p>
                        <input type="text" name="tel_prev" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="midform">Code Postal</p>
                        <input type="text" name="cp_prev" id="" class="midform">
                    </div>
                    <div class="midblock">
                        <p class="midform">Ville</p>
                        <input type="text" name="ville_prev" id="" class="midform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="fullform">Adresse</p>
                        <input type="text" name="adresse_prev" id="" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <p class="pbut"><a class="ButtonFormMid" onclick="classPrecedente(5)">Precedent</a></p>
                        <p class="pbut"><a class="ButtonFormMid" onclick="classSuivante(5)">Suivant</a></p>
                    </div>
                </div>
            </div>
            <div class="disabled" id="form6">
                <div class="formItem">
                    <div class="formfile">
                        <p class="fullform">Carte identitée (Recto/verso)</p>
                        <input type="file" name="ci" id="ci" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="formfile">
                        <p class="fullform">Carte Vitale</p>
                        <input type="file" name="cv" id="cv" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="formfile">
                        <p class="fullform">Mutuel</p>
                        <input type="file" name="mutuel" id="mutuel" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="formfile">
                        <p class="fullform">Livret de famille (si mineur)</p>
                        <input type="file" name="livret" id="livret" class="fullform">
                    </div>
                </div>
                <div class="formItem">
                    <div class="midblock">
                        <button class="buttonFormValid" onclick="classSuivante(6)">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>