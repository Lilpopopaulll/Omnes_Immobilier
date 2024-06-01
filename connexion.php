<?php
session_start(); // Démarrer la session

// Identifier le nom de la base de données
$database = "omnes_immobilier";

// Connectez-vous à votre BDD
// Votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if ($db_handle) {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $mdp = $_POST['password'];
        if ($email != "" && $mdp != "") {
            $req = $db_handle->query("SELECT * FROM users WHERE email = '$email' AND mdp = '$mdp'");
            $rep = mysqli_fetch_assoc($req);
            if ($rep) {
                $id = $rep['id']; // Récupérer l'id de l'utilisateur à partir du résultat de la requête
                $_SESSION['user_id'] = $id; // Définir une variable de session
                header("Location: accueil.php");
                exit();
            } else {
                echo "Vous n'êtes pas connecté";
            }
        }
    }
}
?>
