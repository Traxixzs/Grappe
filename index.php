<?php
 $existe = FALSE;
 $host  = $_SERVER['HTTP_HOST'];
 $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
 $extra = 'connexion.php';

try
{
    $db = new PDO('mysql:host=localhost;dbname=grappe;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

if (isset($_POST["email"]) && isset($_POST["nom_complet"]) && isset($_POST["pseudo"]) && isset($_POST["password"])){
    $createid = $db->prepare('INSERT INTO utilisateur (email, nom_complet, pseudo, password ) VALUES (:email, :nom_complet, :pseudo, :password)');

    try{
        $createid->execute([
            'email' => $_POST["email"],
            'nom_complet' => $_POST["nom_complet"],
            'pseudo' => $_POST["pseudo"],
            'password' => $_POST["password"]
        ]);
    }
    catch(Exception $erreur){

        if ($erreur->getCode() == 23000) {
            echo "Ce pseudo/email est déjà utiliser";
            $existe = TRUE;
        }
        else{
            echo $erreur->getCode();
        }          
    }
    if ($existe == FALSE) {
        echo "toz ta raté ta vie";
        header("Location: http://$host$uri/$extra");
    }
}


?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grappes</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
        <div id="div_connexion">
            <div id=logo>
                <img src="./assest/Grappes.png" alt="">
            </div>

            <div>
                <h2 id="text1">Inscrivez-vous</h2>
            </div>
            <div id="div_input">
                <div id="div_email">
                   </label><input placeholder="email" type="email" id="email" name="email" class="champ">
                </div>
                <br>
                <div  id="div_nom">
                    <input placeholder="Nom complet"  type="text" id="nom_complet" name="nom_complet" class="champ">       
                </div>
                <br>
                <div  id="div_id">
                    <input placeholder="Nom d'utilisateur"  type="text" id="pseudo" name="pseudo" class="champ">       
                </div>
                <br>

                <div  id="div_password">
                    </label> <input placeholder="Mot de passe" type="password" id="password" name="password" class="champ">
                </div>
                <br>
                <button type="submit" id="btnValider">Valider</button>
                
                </form>   
            </div>
        </div>
    
</body>

</html>
