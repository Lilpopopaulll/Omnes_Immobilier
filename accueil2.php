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
                    $permission = $user_info['permission']; // Nouvelle ligne pour récupérer la permission
                } else {
                    echo "Aucune information trouvée pour l'utilisateur.";
                }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
} 
?>

<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "omnes_immobilier";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'identifiant de la propriété depuis l'URL
$property_id = $_GET['ID'];

// Échapper les caractères spéciaux pour éviter les injections SQL
$property_id = $conn->real_escape_string($property_id);

// Requête SQL pour obtenir les détails de la propriété
$sql = "SELECT * FROM properties WHERE ID_propiete = $property_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les détails de la propriété
    $property = $result->fetch_assoc();
    echo "<h1>" . $property["Adresse"] . "</h1>";
    echo "<p>Location: " . $property["Ville"] . "</p>";
    echo "<p>Price: $" . $property["Prix"] . "</p>";
    echo "<p>Description: " . $property["Statut"] . "</p>";
    // Ajoutez d'autres champs selon votre base de données
} else {
    echo "Property not found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier</title>
    <link rel="stylesheet" href="./styles/accueil.css">
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
            <h1>OMNES IMMOBILIER</h1>
            <div id="lg"></div>
            <p>Trouver le bien de vos rêves grâce à notre sélection unique en son genre et nos agents.</p>
        </section>
        
        <div class="separation"></div>
        <section class="features">
            <div class="feature">
                <h2>ACCOMPAGNEMENT</h2>
                <p>L'accompagnement est au cœur de notre démarche chez Omnes Immobilier. Nous croyons fermement que chaque projet immobilier est unique et mérite une attention particulière...</p>
            </div>
            <div class="feature">
                <h2>TRANSPARENCE</h2>
                <p>La transparence est une valeur fondamentale de notre agence. Chez Omnes Immobilier, nous nous engageons à fournir des informations claires et précises à nos clients...</p>
            </div>
            <div class="feature">
                <h2>INNOVATION</h2>
                <p>Omnes Immobilier se distingue par son approche innovante. Nous utilisons des technologies pour optimiser nos services et améliorer la communication avec nos clients...</p>
            </div>
            <div class="feature">
                <h2>EXPERTISE</h2>
                <p>Chez Omnes Immobilier, nous nous distinguons par notre expertise inégalée dans le domaine de l'immobilier. Nos agents possèdent une connaissance approfondie du marché...</p>
            </div>
        </section>

        
        <section class="actions">
            <div class="action">
                <button class="action-btn">Nous contacter</button>
            </div>
            <div class="action">
                <button class="action-btn">Informations</button>
            </div>
            <div class="action">
                <button class="action-btn">Membres</button>
            </div>
        </section>
        <img class="transition-image"src="pngegg.png" alt="Description de l'image" width="500" height="300">

<section class="about" id="about">

    <h1 class="heading"> <span>Notre </span> histoire </h1>

    <div class="row">

        <div class="image">
            <img src="images/immo2.png" alt="" >
        </div>

        <div class="features">
            <h3>Qui suis-je ?</h3>
            <p>Bienvenue chez Omnes Immobilier, votre expert en immobilier de luxe. Nous sommes spécialisés dans la vente et la location de propriétés prestigieuses, offrant un service sur-mesure pour répondre à toutes vos attentes. 
                Notre équipe dévouée met son expertise et son réseau exclusif à votre service pour trouver la résidence de vos rêves. Aujourd'hui installés au cœur de Paris,Notre équipe met son expertise  expertise au service de nos clients, en proposant des biens d'exception et en réinventant les codes du luxe immobilier. Avec une attention particulière aux détails et une passion pour l'excellence, ils transforment chaque projet en une expérience unique.</p>
            <a href="#" class="btn">Decouvrez notre histoire</a>
        </div>

    </div>

</section>

<!-- about section ends -->
<section class="listings">
    <h1 class="heading"> Nos <span>Biens</span> </h1>
    <div class="box-container">
 
       <div class="box">
          <div class="admin">
             <h3>j</h3>
             <div>
                <p>john deo</p>
                <span>10-11-2022</span>
             </div>
          </div>
          <div class="thumb">
             <p class="total-images"><i class="far fa-image"></i><span>4</span></p>
             <p class="type"><span>house</span><span>sale</span></p>
             <form action="" method="post" class="save">
                <button type="submit" name="save" class="far fa-heart"></button>
             </form>
             <img src="R.jpg" alt="">
          </div>
          <h3 class="name">modern flats and appartments</h3>
          <p class="location"><i class="fas fa-map-marker-alt"></i><span>andheri, mumbai, india - 401303</span></p>
          <div class="flex">
             <p><i class="fas fa-bed"></i><span>3</span></p>
             <p><i class="fas fa-bath"></i><span>2</span></p>
             <p><i class="fas fa-maximize"></i><span>750sqft</span></p>
          </div>
          <a href="accueil2.php?ID_propriete=1001" class="btn">view property</a>
       </div>
 
       <div class="box">
          <div class="admin">
             <h3>j</h3>
             <div>
                <p>john deo</p>
                <span>10-11-2022</span>
             </div>
          </div>
          <div class="thumb">
             <p class="total-images"><i class="far fa-image"></i><span>4</span></p>
             <p class="type"><span>flat</span><span>sale</span></p>
             <form action="" method="post" class="save">
                <button type="submit" name="save" class="far fa-heart"></button>
             </form>
             <img src="R1.jpg" alt="">
          </div>
          <h3 class="name">modern flats and appartments</h3>
          <p class="location"><i class="fas fa-map-marker-alt"></i><span>andheri, mumbai, india - 401303</span></p>
          <div class="flex">
             <p><i class="fas fa-bed"></i><span>3</span></p>
             <p><i class="fas fa-bath"></i><span>2</span></p>
             <p><i class="fas fa-maximize"></i><span>750sqft</span></p>
          </div>
          <a href="view_property.html" class="btn">view property</a>
       </div>
 
       <div class="box">
          <div class="admin">
             <h3>j</h3>
             <div>
                <p>john deo</p>
                <span>10-11-2022</span>
             </div>
          </div>
          <div class="thumb">
             <p class="total-images"><i class="far fa-image"></i><span>4</span></p>
             <p class="type"><span>flat</span><span>sale</span></p>
             <form action="" method="post" class="save">
                <button type="submit" name="save" class="far fa-heart"></button>
             </form>
             <img src="m.jpg" alt="">
          </div>
          <h3 class="name">modern flats and appartments</h3>
          <p class="location"><i class="fas fa-map-marker-alt"></i><span>andheri, mumbai, india - 401303</span></p>
          <div class="flex">
             <p><i class="fas fa-bed"></i><span>3</span></p>
             <p><i class="fas fa-bath"></i><span>2</span></p>
             <p><i class="fas fa-maximize"></i><span>750sqft</span></p>
          </div>
          <a href="view_property.html" class="btn">view property</a>
       </div>
 
       <div class="box">
          <div class="admin">
             <h3>j</h3>
             <div>
                <p>john deo</p>
                <span>10-11-2022</span>
             </div>
          </div>
          <div class="thumb">
             <p class="total-images"><i class="far fa-image"></i><span>4</span></p>
             <p class="type"><span>flat</span><span>sale</span></p>
             <form action="" method="post" class="save">
                <button type="submit" name="save" class="far fa-heart"></button>
             </form>
             <img src="RO.jpg" alt="">
          </div>
          <h3 class="name">modern flats and appartments</h3>
          <p class="location"><i class="fas fa-map-marker-alt"></i><span>andheri, mumbai, india - 401303</span></p>
          <div class="flex">
             <p><i class="fas fa-bed"></i><span>3</span></p>
             <p><i class="fas fa-bath"></i><span>2</span></p>
             <p><i class="fas fa-maximize"></i><span>750sqft</span></p>
          </div>
          <a href="view_property.html" class="btn">view property</a>
       </div>
    </div>
</div>
<div class="view-more">
    <center><a href="#" class="btn">Voir plus</a></center>
</div>
</section>    

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> nos meilleurs <span>avis</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Cette personne a un don pour capturer l'essence et l'histoire de chaque meuble qu'ils restaurent. Leur sensibilité artistique et leur savoir-faire technique se combinent pour créer des pièces qui racontent une histoire et qui ajoutent une touche d'élégance et de caractère à n'importe quel espace.</p>
            <img src="avis.jpg" class="user" alt="">
            <h3>XXXX </h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/quote-img.png" alt="" class="features">
            <p>Je suis impressionné par le souci du détail de cette personne dans son travail de restauration de meubles. Chaque petite imperfection est soigneusement corrigée, et le résultat final est toujours impeccable.</p>
            <img src="avisf.jpg" class="user" alt="">
            <h3>XXXX XXXXX</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
        
        <div class="box">
            <img src="images/quote-img.png" alt="" class="features">
            <p>Une véritable magicienne du bois ! Cette personne a transformé un vieux meuble terne en une pièce d'art digne d'un musée. Leur talent pour restaurer et redonner vie aux meubles est tout simplement incroyable</p>
            <img src="OIP.jpg" class="user" alt="">
            <h3>XXX XXXXX</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

    </div>

</section>
<!-- review section ends -->
<!-- blogs section starts  -->
<section class="blogs" id="blogs">

    <h1 class="heading"> Nos <span>Evenement</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="1.jpg" alt="">
            </div>
            <div class="content">
                <a href="#" class="title">Le bien phare de cette semaine</a>
                <span>by Deborah / 21st may, 2024</span>
                <p>Dans cet article, Nous allons vous présenter le nouveau... </p>
                <a href="#" class="btn">Lire l'article</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="3.jpg" alt="">
            </div>
            <div class="content">
                <a href="#" class="title">Omnes Immobilier: Hommage et Histoire</a>
                <span>by Deborah / 1st may, 2024</span>
                <p>Si vous connaissez l'enseigne Omnes ou que vous suivez notre travail depuis...</p>
                <a href="#" class="btn">Lire l'article</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="2.jpg" alt="">
            </div>
            <div class="content">
                <a href="#" class="title">Le Bailleul:L'histoire derriere ce bien </a>
                <span>by Deborah / 21st April, 2024</span>
                <p>Le Bailleul: L'histoire de ce bien d'exception et de sa decouverte recente...</p>
                <a href="#" class="btn">Lire l'article</a>
            </div>
        </div>

    </div>

</section>

<section class="footer">
    <section class="contact" id="contact">

        <h1 class="heading"> <span>contactez </span>nous </h1>
    
        <div class="row">
    
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26270.882644926523!2d2.136442787218693!3d48.90775307647415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67167354a5c13%3A0x40dc6e44fb4d4b0!2sMontesson%2C%2078340!5e0!3m2!1sen!2sfr!4v1629452077891!5m2!1sen!2sfr" allowfullscreen="" loading="lazy"></iframe>
    
    
            <form action="">
                <h3>Prenez contact</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="nom">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="email">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" placeholder="numero de telephone">
                </div>
                <input type="submit" value="envoyer" class="btn">
            </form>
    
        </div>
    
    </section>
    
    

    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        <a href="#" class="fab fa-pinterest"></a>
    </div>

    <div class="links">
        <a href="#home">home</a>
        <a href="#about">a propos</a>
        <a href="#products">creations</a>
        <a href="#review">avis</a>
        <a href="#contact">contact</a>
        <a href="#blogs">blogs</a>
    </div>

    <div class="credit">created by <span>Benoit Quaranta For Omnes Immobilier</span> | all rights reserved</div>

</section>

    </main>
    <script src="scripts2.js"></script>
    </main>
</body>
</html>
