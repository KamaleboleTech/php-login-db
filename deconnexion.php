<?php 
    session_start();
    $_SESSION['connect'] = false;

    header('Location: connexion.php');

    ?>