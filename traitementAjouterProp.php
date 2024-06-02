<?php
session_start(); // Démarrer la session

// Identifier le nom de la base de données
$database = "omnes_immobilier";

// Connectez-vous à votre BDD
// Votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '', $database);
if (isset($_POST['Ajouter'])) {
    $ville = $_POST['ville'];
    $url_image = $_POST['url_image'];
    $prix = $_POST['prix'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
   
    // Récupérer la valeur de l'option sélectionnée
    $permission = $_POST['type']; // Cela récupère la valeur du champ de sélection (utilisateur, agent, admin)

    // Définir la permission en fonction de l'option choisie
    switch ($permission) {
        case "com":
            $permission_value = "Immobilier commercial";
            break;
        case "res":
            $permission_value = "Immobilier résidentiel";
            break;
        case "ter":
            $permission_value = "Terrain";
            break;
        case "lou":
            $permission_value = "Appartement à louer";
            break;
        default:
            // Valeur par défaut ou traitement d'erreur si nécessaire
            $permission_value = 0;
            break;
    }

    // Création de la requête SQL pour insérer les données, y compris la permission
    $sql = "INSERT INTO proprietes ( Nom, Adresse, Ville, Prix , url_image, Categorie) VALUES ('$nom', '$adresse', '$ville', '$prix', '$url_image', '$permission_value')";

    // Exécution de la requête et vérification du résultat
    if (mysqli_query($db_handle, $sql)) {
    
        header("Location: profil.php");
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($db_handle);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
}
?>
