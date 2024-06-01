<?php
session_start(); // Démarrer la session

// Identifier le nom de la base de données
$database = "omnes_immobilier";

// Connectez-vous à votre BDD
// Votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '', $database);
  if (isset($_POST['inscrire'])) {

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
   
    

    // Création de la requête SQL pour insérer les données
    $sql = "INSERT INTO users (prenom, nom, adresse, email, mdp) VALUES ('$prenom', '$nom', '$adresse', '$email', '$mdp')";

    // Exécution de la requête et vérification du résultat
    if (mysqli_query($db_handle, $sql)) {
        $id = mysqli_insert_id($db_handle);
        $_SESSION['user_id'] = $id; // Définir une variable de session
        header("Location: accueil.php");
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($db_handle);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
    }
  ?>