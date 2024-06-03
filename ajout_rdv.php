<?php
session_start();

$database = "omnes_immobilier";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("Vous devez être connecté pour prendre un rendez-vous.");
}

if (isset($_GET['time'])) {
    $time = htmlspecialchars($_GET['time']);
    list($day, $hour, $id_agent) = explode('-', $time);

    // Vérifier si le créneau est déjà réservé pour cet agent
    $check_sql = "SELECT * FROM rdv WHERE jour = '$day' AND heure = '$hour' AND ID_agent = '$id_agent'";
    $check_result = mysqli_query($db_handle, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        die("Ce créneau est déjà réservé.");
    }

    // Insérer le nouveau rendez-vous pour l'utilisateur
    $insert_sql_user = "INSERT INTO rdv (ID_user, jour, heure, ID_agent) VALUES ('$user_id', '$day', '$hour', '$id_agent')";
    if (mysqli_query($db_handle, $insert_sql_user)) {
        // Insérer le nouveau rendez-vous pour l'agent
        $insert_sql_agent = "INSERT INTO rdv (ID_user, jour, heure, ID_agent) VALUES ('$id_agent', '$day', '$hour', '$id_agent')";
        if (mysqli_query($db_handle, $insert_sql_agent)) {
            echo "<script>
            alert('Rendez-vous pris avec succès. Un email de confirmation sera envoyé.');
            window.location.href = 'toutParcourir.php';
        </script>";
            exit();
        } else {
            echo "Erreur lors de la prise de rendez-vous pour l'agent : " . mysqli_error($db_handle);
        }
    } else {
        echo "Erreur lors de la prise de rendez-vous pour l'utilisateur : " . mysqli_error($db_handle);
    }
} else {
    echo "Aucun créneau horaire ou ID d'agent spécifié.";
}

mysqli_close($db_handle);
?>
