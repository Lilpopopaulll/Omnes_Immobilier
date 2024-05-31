<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Identifier le nom de la base de données
    $database = "omnes_immobilier";

    // Connectez-vous à votre BDD
    // Votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
    $db_handle = mysqli_connect('localhost', 'root', '', $database);

    if (!$db_handle) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];

    // Récupérer les informations de l'utilisateur
    $sql = "SELECT prenom, nom, adresse FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $prenom = $user_info['prenom'];
        $nom = $user_info['nom'];
        $adresse = $user_info['adresse'];
    } else {
        echo "Aucune information trouvée pour l'utilisateur.";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
} else {
    header("Location: connexion.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <script src="script.js"></script>
    <title>Profile</title>
</head>
<body>
    <header>
        <div class="logo"><img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/3826d156db6da9ee77e8511101fa6d15a6ae3801acec3c890e54f920e581cdb7?"
            class="img-2"
              /></div>
        <nav>
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="toutParcourir.html">Tout parcourir</a></li>
                <li><a href="#">Recherche</a></li>
                <li><a href="rdv.html">Rendez-vous</a></li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="#" class="btn_toggle_compte">'.$_SESSION['user_id'].'</a></li>';
                } else {
                    echo '<li><a href="#" class="btn_toggle_connexion">Connexion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    
    <div class="wrapper">
        <div class="pdp">
            <h2>Informations</h2>
            <a href="deconnexion.php" class="btn_deconnexion">Deconnexion</a>
        </div>
        <div class="info">
            <h2>Informations</h2>
            <div class="lg_info"></div>
            <div class="donnees">
                <h3>Prénom</h3>
                <p><?php echo htmlspecialchars($prenom); ?></p>
                <h3>Nom</h3>
                <p><?php echo htmlspecialchars($nom); ?></p>
                <h3>Adresse</h3>
                <p><?php echo htmlspecialchars($adresse); ?></p>
            </div>
        </div>
    </div>
    
</body>
</html>
