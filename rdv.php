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
    $sql = "SELECT jour, heure, ID_rdv FROM rdv WHERE ID_user = $user_id";
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
                <li><a href="toutParcourir.php">Tout parcourir</a></li>
                <li><a href="RechercherProjet.php">Recherche</a></li>
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
    <!-- Formulaire  -->
    <form method="post" action="connexion.php">
        <div id="overlay_connexion" class="overlay hidden">
            <h1>CONNEXION</h1>
            <div class="log">
                <h2>IDENTIFIANT</h2>
                <input class="input_log" type="text" placeholder="Entrer votre identifiant" name="email" required="required">
                <div class="lg_log"></div>
            </div>
            <div class="log">
                <h2>MOT DE PASSE</h2>
                <input class="input_log" type="password" placeholder="Entrer votre mot de passe" required="required" name="password">
                <div class="lg_log"></div>
            </div>
            <input value="Connexion" type ="submit" class="btn_connexion" name="login"></input>
            <p>Mot de passe oublié ?</p>
            <div class="inscription">
                <p>Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
            </div>
        </div>
    </form>
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
            
            if (isset($_SESSION['user_id'])) {
                if ($result && $result->num_rows > 0) {
                    // Affichage des rendez-vous dans un tableau
                    echo "<h2>Vos rendez-vous </h2>";
                    echo "<table>";
                    echo "<tr><th>Jour</th><th>Heure</th><th>Action</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['jour']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['heure']) . "</td>";
                        echo '<td>
                            <form action="annulation.php" method="post">
                                <input type="hidden" name="ID_rdv" value="' . htmlspecialchars($row['ID_rdv']) . '">
                                <button type="submit" class="btn_deconnexion">Annuler</button>
                            </form>
                        </td>';
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Vous avez aucun rendez-vous de prévu";
                }
            } else {
                echo "Vous n'êtes pas connecté";
            }
            ?>
        </div>
    </main>
    <div class="fond_noir_dg"></div>
    <div class="fond_noir" ></div>
</body>
</html>
