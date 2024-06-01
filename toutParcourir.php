<?php
session_start(); 

$database = "omnes_immobilier";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  
    $sql = "SELECT prenom, nom, adresse, permission FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db_handle, $sql);                
    if (mysqli_num_rows($result) > 0) {
                    $user_info = mysqli_fetch_assoc($result);
                    $prenom = $user_info['prenom'];   
                    $permission = $user_info['permission']; 
                } else {
                    echo "Aucune information trouvée pour l'utilisateur.";
                }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier</title>
    <link rel="stylesheet" href="./styles/toutParcourir.css">
    <script src="script.js"></script>
    <script src="infoPropriete.js"></script>
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
            <h1>DECOUVREZ TOUTES NOS PROPRIETES</h1>     
        </section>
    </main>

    <div class="container_propriete">
    <?php 

        $categories = array("Immobilier résidentiel", "Immobilier commercial", "Terrain", "Appartement à louer");

        foreach ($categories as $category) {
            echo "<h2>$category</h2>";

            $sql = "SELECT url_image, Prix, Nom, Statut, Adresse, Ville, ID_propriete, Detail FROM proprietes WHERE Categorie='$category'";
            $result = mysqli_query($db_handle, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="annonces-container">';
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="annonce">';
                    echo '<img src="' . htmlspecialchars($row["url_image"]) . '" alt="' . htmlspecialchars($row["Nom"]) . '" ' .
                        'data-prix="' . htmlspecialchars($row["Prix"]) . '" ' .
                        'data-statut="' . htmlspecialchars($row["Statut"]) . '" ' .
                        'data-adresse="' . htmlspecialchars($row["Adresse"]) . '" ' .
                        'data-ville="' . htmlspecialchars($row["Ville"]) . '" ' .
                        'data-id-propriete="' . htmlspecialchars($row["ID_propriete"]) . '" ' .
                        'data-detail="' . htmlspecialchars($row["Detail"]) . '">';
                    echo '<h3>' . htmlspecialchars($row["Nom"]) . '</h3>';
                    echo '<p>Prix: ' . htmlspecialchars($row["Prix"]) . ' €</p>';
                    echo '</div>';
                }
                
                echo '</div>';
            } else {
                echo '<div class="no-properties">Aucune propriété trouvée dans la catégorie ' . $category . '.</div>';            
            }
        }
        ?>



        
    </div>
    <div id="overlay_detail">
        <div class="detail-container" id="property_details">
            
        </div>
    </div>
</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($db_handle);
?>
