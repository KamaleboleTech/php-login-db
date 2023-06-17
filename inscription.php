<?php 
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=membres', 'root', '');
    if(isset($_POST['forminscription']))
    {
        if(!empty($_POST['name']) AND !empty($_POST['email']) AND !empty($_POST['pseudo']) AND !empty($_POST['password']))
        {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $password = sha1($_POST['password']);

            $Insertmbr = $bdd->prepare("INSERT INTO users(nom, email, pseudo, password) VALUES (?, ?, ?, ?)");
            $Insertmbr->execute(array($name, $email, $pseudo, $password));
            $_SESSION['compte crée'] = "Votre compte a été bien crée";
            header('Location: profile.php');
        }
        else
        {
            $erreur = "Veuillez remplir tous les champs";
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
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <h1>S'enregistrer</h1>
        <form method="POST" action="">
            <div>
                <label for="name"></label>
                <input class="input" type="text" name="name" id="name" placeholder="Nom complet" autocomplete="off" required>
            </div>
            <div>
                <label for="email"></label>
                <input class="input" type="mail" name="email" id="email" placeholder="Adresse email" autocomplete="off" required>
            </div>
            <div>
                <label for="pseudo"></label>
                <input class="input" type="text" name="pseudo" id="pseudo" placeholder="Nom d'utilisateur" autocomplete="off" required>
            </div>
            <div>
                <label for="password"></label>
                <input class="input" type="password" name="password" id="password" placeholder="Mot de passe" autocomplete="off" required>
            </div>
            <button class="button" type="submit" name= "forminscription">Créer un compte</button>
        </form>
        <?php  
        if (isset($erreur))
        {
            echo '<font color="red">' .$erreur. "</font>"; 
        }
        ?> <br>
        <span>Déjà membre? <a href="connexion.php">connectez-vous</a></span>
    </div>
</body>
</html>