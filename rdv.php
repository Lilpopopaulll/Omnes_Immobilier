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
    $sql = "SELECT prenom, nom, adresse, permission FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db_handle, $sql);                
    if (mysqli_num_rows($result) > 0) {
                    $user_info = mysqli_fetch_assoc($result);
                    $prenom = $user_info['prenom'];
                    $nom = $user_info['nom'];
                    $adresse = $user_info['adresse'];
                    $permission = $user_info['permission']; // Nouvelle ligne pour récupérer la permission
                } else {
                    echo "Aucune information trouvée pour l'utilisateur.";
                }

    // Requête pour récupérer tous les rendez-vous de l'utilisateur
    $sql = "SELECT * FROM rdv WHERE ID_user = $user_id";
    $result = $db_handle->query($sql);
    
    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier - RDV</title>
    <link rel="stylesheet" href="./styles/rdv.css">
    <script src="script.js"></script>
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
                <li><a href="rdv.php">Rendez-vous</a></li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="profil.php" class="btn_toggle_compte">'.htmlspecialchars($prenom).'</a></li>';
                } else {
                    echo '<li><a href="#" class="btn_toggle_connexion">Connexion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main class="container">
        <section class="hero">
            <img
          src="https://cdn.builder.io/api/v1/image/assets/TEMP/3826d156db6da9ee77e8511101fa6d15a6ae3801acec3c890e54f920e581cdb7?"
          class="img-2"
            />
            <h1>PRENEZ RENDEZ VOUS AVEC LES MEILLEURS AGENTS</h1>     
        </section>
        
        <div class="calendrier_container">
            <?php
            if ($result && $result->num_rows > 0) {
                // Affichage des rendez-vous dans un tableau
                echo "<h2>Rendez-vous de l'utilisateur :</h2>";
                echo "<table>";
                echo "<tr><th>Jour</th><th>Heure</th><th>Action</th></tr>";
                while($row = $result->fetch_assoc()) {
                    foreach($row as $day => $time) {
                        if ($day !== 'ID_rdv' && $day !== 'ID_user' && $time !== null) {
                            echo "<tr>";
                            echo "<td>$day</td>";
                            echo "<td>$time</td>";
                            echo '<td><form action="annulation.php" method="post"><a href="deconnexion.php" class="btn_deconnexion">Deconnexion</a>
                            <input type="hidden" name="rdv_id" value="'.$row['ID_rdv'].'"><button type="submit">Annuler</button></form></td>';
                            echo "</tr>";
                        }
                    }
                }
                echo "</table>";
            } else {
                echo "Aucun rendez-vous trouvé pour cet utilisateur.";
            }
            ?>
        </div>
    </main>
    <div class="fond_noir_dg"></div>
    <div class="fond_noir" ></div>
</body>
</html>
