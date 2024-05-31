<?php
session_start(); // Démarrer la session
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
                <li><a href="rdv.html">Rendez-vous</a></li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="profil.php" class="btn_toggle_compte">'.$_SESSION['user_id'].'</a></li>';
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
                <input class="input_log" type="text" placeholder="Entrer votre identifiant" name="id" required="required">
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
    </main>
</body>
</html>
