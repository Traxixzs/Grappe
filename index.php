<?php
$existe = false
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=grappe;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }

    if (isset($_POST["email"]) && isset($_POST["pseudo"]) && isset($_POST["password"])){
        $createid = $db->prepare('INSERT INTO utilisateur (email, pseudo, password ) VALUES (:email, :pseudo, :password)');

        try{
            $createid->execute([
                'email' => $_POST["email"],
                'pseudo' => $_POST["pseudo"],
                'password' => $_POST["password"]
            ]);
            }
        catch(Exception $erreur){

            if ($erreur->getCode() == 23000) {
                $existe = true
                echo "Ce pseudo/email est déjà utiliser";
            }
            else{
                echo $erreur->getCode();
            }
    
                     
        }   
    }
    
?>



<html>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grappes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
    <form action="connexion.php " method="post">
        <div id="div_connexion">
            <div id="logo_connexion">
                 <img src="./assest/logo.png" alt=""> 
                    <div id=text>
                        <h1>Grappes</h1>
                    </div>
            </div>
            <div class="et">
                <h3><strong>Inscrivez-vous <strong></h3>
            </div>
            <div id="div_input">
                <div class="et" id="div_email">
                    <label><h6>email : </h6> </label><input placeholder="email" type="email" id="email" name="email" class="champ">
                </div>
                <br>
                <div class="et" id="div_id">
                <label><h6>pseudo : </h6></label><input placeholder="pseudo"  type="text" id="pseudo" name="pseudo" class="champ">       
                </div>
                <br>
                <div class="et" id="div_password">
                    <label><h6>mot de passe : </h6></label> <input placeholder="mot de passe" type="password" id="password" name="password" class="champ">
                </div>
                <br>
                <button class="et" type="submit" >Valider</button>
            </div>
        </div>
        
    </form>
</body>

</html>
