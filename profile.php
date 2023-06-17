<?php 
    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=membres', 'root', '');

    if(isset($_GET['id']) AND $_GET['id'] > 0)
    {
        $getId = intval ($_GET['id']);
        $reqUser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
        $reqUser->execute(array($getId));
        $Userinfo = $reqUser->fetch();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Profil</title>
</head>
<body>
    <div class="container">
        <div class="profil">
            <h1>Profil</h1>
            <div class="profilImg">
                <img src="images/LOGO.PNG" alt="image">
            </div>
            <h3>Bienvenue dans votre compte, <?php echo $Userinfo ['nom']; ?>
            <br />
            <?php echo $Userinfo ['pseudo']; ?>
            <br />
            <?php echo $Userinfo ['email']; ?>
            <br /> <br />
            <form action="deconnexion.php">
                <button class="btndisconnect">Deconnexion</button>
            </form>
            <?php  
        if (isset($erreur))
        {
            echo '<font color="red">' .$erreur. "</font>"; 
        }
        ?>
        </div>
    </div>
</body>
</html>
<?php
}
?>