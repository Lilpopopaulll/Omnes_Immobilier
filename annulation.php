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
    $rdv_id = $_POST['ID_rdv'];
    $user_id = $_SESSION['user_id'];

    // Supprimer le rendez-vous
    $sql = "DELETE FROM rdv WHERE ID_rdv = '$rdv_id' AND ID_user = '$user_id'";
    if (mysqli_query($db_handle, $sql)) {
        echo "Rendez-vous annulé avec succès.";
        // Rediriger vers la page des rendez-vous après annulation
        header("Location: rdv.php");
        exit;
    } else {
        echo "Erreur lors de l'annulation du rendez-vous : " . mysqli_error($db_handle);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
} else {
    echo "Accès non autorisé.";
}
?>
