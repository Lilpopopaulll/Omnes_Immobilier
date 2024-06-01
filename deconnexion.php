<?php
    // Démarrer la session
    session_start();

    // Détruire toutes les données de session
    session_destroy();

    // Supprimer le cookie de session côté client
    setcookie(session_name(), '', time() - 3600, '/');

    // Rediriger vers la page d'accueil
    header("Location: accueil.php");
    exit;
?>
