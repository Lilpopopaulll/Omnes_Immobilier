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
   
    // Récupérer la valeur de l'option sélectionnée
    $permission = $_POST['role']; // Cela récupère la valeur du champ de sélection (utilisateur, agent, admin)

    // Définir la permission en fonction de l'option choisie
    switch ($permission) {
        case "utilisateur":
            $permission_value = 0;
            break;
        case "agent":
            $permission_value = 1;
            break;
        case "admin":
            $permission_value = 2;
            break;
        default:
            // Valeur par défaut ou traitement d'erreur si nécessaire
            $permission_value = 0;
            break;
    }

    // Création de la requête SQL pour insérer les données, y compris la permission
    $sql = "INSERT INTO users (prenom, nom, adresse, email, mdp, permission) VALUES ('$prenom', '$nom', '$adresse', '$email', '$mdp', '$permission_value')";

    // Exécution de la requête et vérification du résultat
    if (mysqli_query($db_handle, $sql)) {
        $id = mysqli_insert_id($db_handle);
        if ($permission === "agent") {
            // Si l'utilisateur est un agent, insérer une ligne dans la table agents_immobilier
            $sql_agent = "INSERT INTO agents_immobilier (id) VALUES ('$id')";
            mysqli_query($db_handle, $sql_agent);
        }
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
