<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Agent Immobilier</title>
    <link rel="stylesheet" href="RechercherProjet.css">
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
    <form action="RechercheProjet.php" method="post">
        <div id="search-container">
            <input type="text" name="search_input" id="search-input" placeholder="Numéro de propriété, Nom de l'agent immobilier, Adresse, ou Ville">
            <input type="submit" value="Rechercher" id="search-button">
        </div>
    </form>
</body>
</html>
