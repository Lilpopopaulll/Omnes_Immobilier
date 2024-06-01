<?php
session_start(); // Démarrer la session

// Connectez-vous à votre base de données
$database = "omnes_immobilier";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Connection failed: " . mysqli_connect_error());
}

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Récupérer les informations de l'utilisateur
    $sql = "SELECT prenom, nom, adresse, permission FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db_handle, $sql);                
    if (mysqli_num_rows($result) > 0) {
                    $user_info = mysqli_fetch_assoc($result);
                    $prenom = $user_info['prenom'];   
                    $permission = $user_info['permission']; // Nouvelle ligne pour récupérer la permission
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
        // Sélectionner les catégories
        $categories = array("Immobilier résidentiel", "Immobilier commercial", "Terrain", "Appartement à louer");

        foreach ($categories as $category) {
            echo "<h2>$category</h2>";

            // Récupérer les informations des propriétés pour cette catégorie
            $sql = "SELECT url_image, Prix, Nom FROM proprietes WHERE Categorie='$category'";
            $result = mysqli_query($db_handle, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="annonces-container">';
                
                // Afficher les données de chaque propriété
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="annonce">';
                    echo '<img src="' . htmlspecialchars($row["url_image"]) . '" alt="' . htmlspecialchars($row["Nom"]) . '">';
                    echo '<h3>' . htmlspecialchars($row["Nom"]) . '</h3>';
                    echo '<p>Prix: ' . htmlspecialchars($row["Prix"]) . ' €</p>';
                    echo '</div>';
                }
                
                echo '</div>';
            } else {
                echo '<div class="no-properties">Aucune propriété trouvée dans la catégorie ' . $category . '.</div>';            }
        }
        ?>
        
    </div>
    <div id="overlay_detail">
        <div class="detail-container" id="property_details">
            <!-- Les détails de la propriété seront remplis ici par JavaScript -->
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var images = document.querySelectorAll(".annonce img");

            images.forEach(function(image) {
                image.addEventListener("click", function() {
                    // Récupérer les informations de la propriété correspondante
                    var propertyDetails = this.parentNode.querySelector("p").innerText;

                    // Afficher l'overlay avec les détails de la propriété
                    document.getElementById("property_details").innerHTML = "<img src='" + this.src + "' alt='Property Image'><p>" + propertyDetails + "</p>";
                    document.getElementById("overlay_detail").style.display = "block";
                });
            });

            // Fermer l'overlay lorsque l'utilisateur clique à l'extérieur des détails de la propriété
            document.getElementById("overlay_detail").addEventListener("click", function(event) {
                if (event.target === this) {
                    this.style.display = "none";
                }
            });
        });
    </script>


</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($db_handle);
?>
