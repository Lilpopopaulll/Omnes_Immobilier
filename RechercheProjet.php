<?php
// Identifier le nom de base de données
$database = "omnes_immobilier";

// Connectez-vous dans votre BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    // Récupérer le terme de recherche
    $searchQuery = isset($_POST['search_input']) ? $_POST['search_input'] : '';

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $searchQuery = mysqli_real_escape_string($db_handle, $searchQuery);

    // Construire la requête SQL pour trouver les propriétés
    $sql_properties = "SELECT p.*, a.Nom_prenom AS agent_nom 
                       FROM proprietes p
                       LEFT JOIN agents_immobilier a ON p.Agent_ID = a.ID
                       WHERE p.Adresse LIKE '%$searchQuery%'
                       OR p.Ville LIKE '%$searchQuery%'
                       OR p.ID_propriete = '$searchQuery'
                       OR a.Nom_prenom LIKE '%$searchQuery%'";

    echo "<h1>Résultats de la recherche</h1>";

    $result_properties = mysqli_query($db_handle, $sql_properties);

    if (mysqli_num_rows($result_properties) > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Adresse</th>";
        echo "<th>Ville</th>";
        echo "<th>Prix</th>";
        echo "<th>Image</th>";
        echo "<th>Agent Immobilier</th>";
        echo "</tr>";

        // Afficher les propriétés trouvées
        while ($property = mysqli_fetch_assoc($result_properties)) {
            echo "<tr>";
            echo "<td>" . $property['ID_propriete'] . "</td>";
            echo "<td>" . $property['Adresse'] . "</td>";
            echo "<td>" . $property['Ville'] . "</td>";
            echo "<td>" . $property['Prix'] . "</td>";
            echo "<td><img src='" . $property['Image'] . "' alt='Image de la propriété' width='100'></td>";
            echo "<td>" . $property['Agent_ID'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Aucune propriété trouvée pour cette recherche.</p>";
    }
} else {
    echo "<p>Base de données non trouvée.</p>";
}

// Fermer la connexion
mysqli_close($db_handle);
?>
