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

// Récupérer l'ID de la propriété à partir de l'URL
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
        echo "Nom: " . $row["Nom_prenom"]. "<br>";
        echo "Courriel: " . $row["Courriel"]. "<br>";
        echo "Numéro de téléphone: " . $row["Numéro de téléphone"]. "<br>";
        echo "Spécialité: " . $row["Spécialité"]. "<br>";
    }
} else {
    echo "0 résultats";
}

// Fermer la connexion
$conn->close();
?>
