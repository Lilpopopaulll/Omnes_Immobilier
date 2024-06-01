<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'Agent</title>
    <link rel="stylesheet" type="text/css" href="infoAgent.css">
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
    <main>
        <div class="container">
            <h1>Informations de l'Agent Immobilier</h1>
            <?php
            // Connexion à la base de données
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "omnes_immobilier";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué: " . $conn->connect_error);
            }

            // Vérifier si l'ID de la propriété est défini
            if (isset($_GET['ID_propriete'])) {
                $property_id = intval($_GET['ID_propriete']);

                // Préparer la requête SQL
                $sql = "SELECT 
                            a.`Nom_prenom`, 
                            a.`Courriel`, 
                            a.`Numéro de téléphone`, 
                            a.`Spécialité`
                        FROM 
                            `proprietes` p
                        JOIN 
                            `agents_immobilier` a 
                        ON 
                            p.`Agent_ID` = a.`ID`
                        WHERE 
                            p.`ID_propriete` = ?";

                // Préparer et exécuter la requête
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $property_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Afficher les résultats
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='agent-info'>";
                        echo "<p><strong>Nom:</strong> " . $row["Nom_prenom"]. "</p>";
                        echo "<p><strong>Courriel:</strong> " . $row["Courriel"]. "</p>";
                        echo "<p><strong>Numéro de téléphone:</strong> " . $row["Numéro de téléphone"]. "</p>";
                        echo "<p><strong>Spécialité:</strong> " . $row["Spécialité"]. "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>0 résultats</p>";
                }
            } else {
                echo "<p>ID de propriété non spécifié.</p>";
            }

            // Fermer la connexion
            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
