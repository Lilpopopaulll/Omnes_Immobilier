<?php
// Identifier le nom de base de données
$database = "omnes_immobilier";

// Connectez-vous dans votre BDD
// Votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if ($db_handle) {
    // Récupérer le terme de recherche
    $searchQuery = isset($_POST['search_input']) ? $_POST['search_input'] : '';

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $searchQuery = mysqli_real_escape_string($db_handle, $searchQuery);
    $searchQuery = "%$searchQuery%";

    // Construire la requête SQL
    $sql = "SELECT * FROM agents_immobilier WHERE `Nom et Prénom` LIKE '$searchQuery' OR Ville LIKE '$searchQuery'";

    echo "<h1>Résultats de la recherche</h1>";

    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nom et Prénom</th>";
        echo "<th>Ville</th>";
        echo "<th>Numéro de téléphone</th>";
        echo "</tr>";

        // Afficher le résultat
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($data['ID']) . "</td>";
            echo "<td>" . htmlspecialchars($data['Nom et Prénom']) . "</td>";
            echo "<td>" . htmlspecialchars($data['Ville']) . "</td>";
            echo "<td>" . htmlspecialchars($data['Numéro de téléphone']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats trouvés";
    }
} else {
    echo "Database not found";
}

// Fermer la connexion
mysqli_close($db_handle);
?>
