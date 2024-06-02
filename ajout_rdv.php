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
    list($day, $hour) = explode('-', $time);
    
    // Check if the slot is already booked
    $check_sql = "SELECT * FROM rdv WHERE jour = '$day' AND heure = '$hour'";
    $check_result = mysqli_query($db_handle, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        die("Ce créneau est déjà réservé.");
    }

    // Insert the new appointment into the database
    $insert_sql = "INSERT INTO rdv (ID_user, jour, heure) VALUES ('$user_id', '$day', '$hour')";
    if (mysqli_query($db_handle, $insert_sql)) {
        echo "<script>
        alert('Rendez-vous pris avec succès. Un email de confirmation sera envoyé.');
        window.location.href = 'toutParcourir.php';
    </script>";
        header("Location: toutParcourir.php");
        exit();
    } else {
        echo "Erreur lors de la prise de rendez-vous : " . mysqli_error($db_handle);
    }
} else {
    echo "Aucun créneau horaire spécifié.";
}

mysqli_close($db_handle);
?>
