<?php 
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=membres', 'root', '');
    if(isset($_POST['formconnexion']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = sha1($_POST['password']);
        if(!empty($_POST['pseudo']) AND !empty($_POST['password']))
        {
            $reqUser = $bdd->prepare("SELECT * FROM users WHERE pseudo = ? AND password = ?");
            $reqUser->execute(array($pseudo, $password));
            $UserExist = $reqUser -> rowCount();
            if($UserExist == 1)
            {
                $Userinfo = $reqUser->fetch();
                $_SESSION['id'] = $Userinfo['id'];
                $_SESSION['username'] = $Userinfo['username'];
                $_SESSION['email'] = $Userinfo['email'];
                                

                header("Location: profile.php?id=".$_SESSION['id']);

            }
            else
            {
                $erreur = "Nom d'Utilisateur ou Mot de passe incorrect";
            }
        }
        else
        {
            $erreur = "Veuillez remplir tous les champs!!!";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="" method="post">
            <div>
                <label for="email"></label>
                <input class="input" type="text" name="pseudo" id="pseudo" placeholder="Nom d'utilisateur" autocomplete="off" required>
            </div>
            <div>
                <label for="password"></label>
                <input class="input" type="password" name="password" id="password" placeholder="Mot de passe" autocomplete="off" required>
            </div>
            <div>
                <p class="error"><?php if(isset($_SESSION['error'])) {echo $_SESSION['error']; }?></p>
            </div>
            <button class="button" type="submit" name="formconnexion">Se Connecter</button>
        </form>
        <?php  
        if (isset($erreur))
        {
            echo '<font color="red">' .$erreur. "</font>"; 
        }
        ?> <br>
        <span>Pas encore membre? <a href="inscription.php">créer un compte</a></span>
    </div>
</body>
</html>