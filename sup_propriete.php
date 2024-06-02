<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Identifier le nom de la base de données
    $database = "omnes_immobilier";

    // Connectez-vous à votre BDD
    $db_handle = mysqli_connect('localhost', 'root', '', $database);

    if (!$db_handle) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Récupérer l'ID du rendez-vous depuis le formulaire
    $ID = $_POST['ID_propriete'];
    $user_id = $_SESSION['user_id'];

    // Supprimer le rendez-vous
    $sql = "DELETE FROM proprietes WHERE ID_propriete = '$ID'";
    if (mysqli_query($db_handle, $sql)) {
        header("Location: profil.php");
        exit;
    } else {
        echo "Erreur lors de la supression du rendez-vous : " . mysqli_error($db_handle);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
} else {
    echo "Accès non autorisé.";
}
?>
