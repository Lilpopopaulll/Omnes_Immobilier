<?php
session_start(); 

$database = "omnes_immobilier";
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if (!$db_handle) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  
    $sql = "SELECT prenom, nom, adresse, permission FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db_handle, $sql);                
    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $prenom = $user_info['prenom'];   
        $permission = $user_info['permission']; 
    } else {
        echo "Aucune information trouvée pour l'utilisateur.";
    }
}

// Requête pour récupérer tous les rendez-vous de l'utilisateur

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'Agent</title>
    <link rel="stylesheet" type="text/css" href="./styles/infoAgent.css">
    <script src="script.js"></script>
    <script src="Calendrier.js"></script>
</head>
<body>
    <header>
        <div class="logo"><img src="https://cdn.builder.io/api/v1/image/assets/TEMP/3826d156db6da9ee77e8511101fa6d15a6ae3801acec3c890e54f920e581cdb7?" class="img-2" /></div>
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
    <main>
        <div class="container">
            <?php
            if (isset($_GET['property'])) {
                $nom = htmlspecialchars($_GET['property']);
            } 
            
            ?>
            <h1>Informations sur l'agent <?php echo htmlspecialchars($nom); ?></h1>       
            <div class="agent-info">
                <div id="agent-info">
                    <img src="agent.jpg" alt="Jean-Pierre SEGADO">
                    <?php
                    $sql = "SELECT Nom_prenom, Courriel, Spécialité, téléphone,ID  FROM agents_immobilier WHERE Nom_prenom = '$nom'";
                    $result = mysqli_query($db_handle, $sql);                
                    if (mysqli_num_rows($result) > 0) {
                        $user_info = mysqli_fetch_assoc($result);
                        $email = $user_info['Courriel'];   
                        $specialite = $user_info['Spécialité']; 
                        $telephone = $user_info['téléphone']; 
                        $id_agent = $user_info['ID'];
                    } else {
                        echo "Aucune information trouvée pour l'utilisateur.";
                    } 
                    $sql = "SELECT * FROM rdv WHERE ID_user = '$id_agent'";
                    $rdv = $db_handle->query($sql);
                    ?>
                    <div>
                        <h2><?php echo htmlspecialchars($nom); ?></h2>
                        <p>Agent Immobilier agréé</p>
                        <p>Téléphone : <?php echo htmlspecialchars($telephone); ?></p>
                        <p>Email : <?php echo htmlspecialchars($email); ?></p>
                    </div>
                </div>
                <div class="table-container">
                    <table id="availability">
                        <thead>
                            <tr>
                                <th colspan="2">Lundi</th>
                                <th colspan="2">Mardi</th>
                                <th colspan="2">Mercredi</th>
                                <th colspan="2">Jeudi</th>
                                <th colspan="2">Vendredi</th>
                                <th colspan="2">Samedi</th>
                            </tr>
                            <tr>
                                <th>AM</th>
                                <th>PM</th>
                                <th>AM</th>
                                <th>PM</th>
                                <th>AM</th>
                                <th>PM</th>
                                <th>AM</th>
                                <th>PM</th>
                                <th>AM</th>
                                <th>PM</th>
                                <th>AM</th>
                                <th>PM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-09:00"><a id="lundi-09:00-a" href="ajout_rdv.php?time=lundi-09:00-<?php echo $id_agent; ?>">09:00</a></td>
                                <td class="available" id="lundi-14:00"><a id="lundi-14:00-a" href="ajout_rdv.php?time=lundi-14:00-<?php echo $id_agent; ?>">14:00</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-09:00"><a id="mardi-09:00-a" href="ajout_rdv.php?time=mardi-09:00-<?php echo $id_agent; ?>">09:00</a></td>
                                <td class="available" id="mardi-14:00"><a id="mardi-14:00-a" href="ajout_rdv.php?time=mardi-14:00-<?php echo $id_agent; ?>">14:00</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-09:00"><a id="mercredi-09:00-a" href="ajout_rdv.php?time=mercredi-09:00-<?php echo $id_agent; ?>">09:00</a></td>
                                <td class="available" id="mercredi-14:00"><a id="mercredi-14:00-a" href="ajout_rdv.php?time=mercredi-14:00-<?php echo $id_agent; ?>">14:00</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-09:00"><a id="jeudi-09:00-a" href="ajout_rdv.php?time=jeudi-09:00-<?php echo $id_agent; ?>">09:00</a></td>
                                <td class="available" id="jeudi-14:00"><a id="jeudi-14:00-a" href="ajout_rdv.php?time=jeudi-14:00-<?php echo $id_agent; ?>">14:00</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-09:00"><a id="vendredi-09:00-a" href="ajout_rdv.php?time=vendredi-09:00-<?php echo $id_agent; ?>">09:00</a></td>
                                <td class="available" id="vendredi-14:00"><a id="vendredi-14:00-a" href="ajout_rdv.php?time=vendredi-14:00-<?php echo $id_agent; ?>">14:00</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-09:00"><a id="samedi-09:00-a" href="ajout_rdv.php?time=samedi-09:00-<?php echo $id_agent; ?>">09:00</a></td>
                                <td class="available" id="samedi-14:00"><a id="samedi-14:00-a" href="ajout_rdv.php?time=samedi-14:00-<?php echo $id_agent; ?>">14:00</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-09:30"><a id="lundi-09:30-a" href="ajout_rdv.php?time=lundi-09:30-<?php echo $id_agent; ?>">09:30</a></td>
                                <td class="available" id="lundi-14:30"><a id="lundi-14:30-a" href="ajout_rdv.php?time=lundi-14:30-<?php echo $id_agent; ?>">14:30</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-09:30"><a id="mardi-09:30-a" href="ajout_rdv.php?time=mardi-09:30-<?php echo $id_agent; ?>">09:30</a></td>
                                <td class="available" id="mardi-14:30"><a id="mardi-14:30-a" href="ajout_rdv.php?time=mardi-14:30-<?php echo $id_agent; ?>">14:30</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-09:30"><a id="mercredi-09:30-a" href="ajout_rdv.php?time=mercredi-09:30-<?php echo $id_agent; ?>">09:30</a></td>
                                <td class="available" id="mercredi-14:30"><a id="mercredi-14:30-a" href="ajout_rdv.php?time=mercredi-14:30-<?php echo $id_agent; ?>">14:30</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-09:30"><a id="jeudi-09:30-a" href="ajout_rdv.php?time=jeudi-09:30-<?php echo $id_agent; ?>">09:30</a></td>
                                <td class="available" id="jeudi-14:30"><a id="jeudi-14:30-a" href="ajout_rdv.php?time=jeudi-14:30-<?php echo $id_agent; ?>">14:30</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-09:30"><a id="vendredi-09:30-a" href="ajout_rdv.php?time=vendredi-09:30-<?php echo $id_agent; ?>">09:30</a></td>
                                <td class="available" id="vendredi-14:30"><a id="vendredi-14:30-a" href="ajout_rdv.php?time=vendredi-14:30-<?php echo $id_agent; ?>">14:30</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-09:30"><a id="samedi-09:30-a" href="ajout_rdv.php?time=samedi-09:30-<?php echo $id_agent; ?>">09:30</a></td>
                                <td class="available" id="samedi-14:30"><a id="samedi-14:30-a" href="ajout_rdv.php?time=samedi-14:30-<?php echo $id_agent; ?>">14:30</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-10:00"><a id="lundi-10:00-a" href="ajout_rdv.php?time=lundi-10:00-<?php echo $id_agent; ?>">10:00</a></td>
                                <td class="available" id="lundi-15:00"><a id="lundi-15:00-a" href="ajout_rdv.php?time=lundi-15:00-<?php echo $id_agent; ?>">15:00</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-10:00"><a id="mardi-10:00-a" href="ajout_rdv.php?time=mardi-10:00-<?php echo $id_agent; ?>">10:00</a></td>
                                <td class="available" id="mardi-15:00"><a id="mardi-15:00-a" href="ajout_rdv.php?time=mardi-15:00-<?php echo $id_agent; ?>">15:00</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-10:00"><a id="mercredi-10:00-a" href="ajout_rdv.php?time=mercredi-10:00-<?php echo $id_agent; ?>">10:00</a></td>
                                <td class="available" id="mercredi-15:00"><a id="mercredi-15:00-a" href="ajout_rdv.php?time=mercredi-15:00-<?php echo $id_agent; ?>">15:00</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-10:00"><a id="jeudi-10:00-a" href="ajout_rdv.php?time=jeudi-10:00-<?php echo $id_agent; ?>">10:00</a></td>
                                <td class="available" id="jeudi-15:00"><a id="jeudi-15:00-a" href="ajout_rdv.php?time=jeudi-15:00-<?php echo $id_agent; ?>">15:00</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-10:00"><a id="vendredi-10:00-a" href="ajout_rdv.php?time=vendredi-10:00-<?php echo $id_agent; ?>">10:00</a></td>
                                <td class="available" id="vendredi-15:00"><a id="vendredi-15:00-a" href="ajout_rdv.php?time=vendredi-15:00-<?php echo $id_agent; ?>">15:00</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-10:00"><a id="samedi-10:00-a" href="ajout_rdv.php?time=samedi-10:00-<?php echo $id_agent; ?>">10:00</a></td>
                                <td class="available" id="samedi-15:00"><a id="samedi-15:00-a" href="ajout_rdv.php?time=samedi-15:00-<?php echo $id_agent; ?>">15:00</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-10:30"><a id="lundi-10:30-a" href="ajout_rdv.php?time=lundi-10:30-<?php echo $id_agent; ?>">10:30</a></td>
                                <td class="available" id="lundi-15:30"><a id="lundi-15:30-a" href="ajout_rdv.php?time=lundi-15:30-<?php echo $id_agent; ?>">15:30</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-10:30"><a id="mardi-10:30-a" href="ajout_rdv.php?time=mardi-10:30-<?php echo $id_agent; ?>">10:30</a></td>
                                <td class="available" id="mardi-15:30"><a id="mardi-15:30-a" href="ajout_rdv.php?time=mardi-15:30-<?php echo $id_agent; ?>">15:30</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-10:30"><a id="mercredi-10:30-a" href="ajout_rdv.php?time=mercredi-10:30-<?php echo $id_agent; ?>">10:30</a></td>
                                <td class="available" id="mercredi-15:30"><a id="mercredi-15:30-a" href="ajout_rdv.php?time=mercredi-15:30-<?php echo $id_agent; ?>">15:30</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-10:30"><a id="jeudi-10:30-a" href="ajout_rdv.php?time=jeudi-10:30-<?php echo $id_agent; ?>">10:30</a></td>
                                <td class="available" id="jeudi-15:30"><a id="jeudi-15:30-a" href="ajout_rdv.php?time=jeudi-15:30-<?php echo $id_agent; ?>">15:30</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-10:30"><a id="vendredi-10:30-a" href="ajout_rdv.php?time=vendredi-10:30-<?php echo $id_agent; ?>">10:30</a></td>
                                <td class="available" id="vendredi-15:30"><a id="vendredi-15:30-a" href="ajout_rdv.php?time=vendredi-15:30-<?php echo $id_agent; ?>">15:30</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-10:30"><a id="samedi-10:30-a" href="ajout_rdv.php?time=samedi-10:30-<?php echo $id_agent; ?>">10:30</a></td>
                                <td class="available" id="samedi-15:30"><a id="samedi-15:30-a" href="ajout_rdv.php?time=samedi-15:30-<?php echo $id_agent; ?>">15:30</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-11:00"><a id="lundi-11:00-a" href="ajout_rdv.php?time=lundi-11:00-<?php echo $id_agent; ?>">11:00</a></td>
                                <td class="available" id="lundi-16:00"><a id="lundi-16:00-a" href="ajout_rdv.php?time=lundi-16:00-<?php echo $id_agent; ?>">16:00</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-11:00"><a id="mardi-11:00-a" href="ajout_rdv.php?time=mardi-11:00-<?php echo $id_agent; ?>">11:00</a></td>
                                <td class="available" id="mardi-16:00"><a id="mardi-16:00-a" href="ajout_rdv.php?time=mardi-16:00-<?php echo $id_agent; ?>">16:00</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-11:00"><a id="mercredi-11:00-a" href="ajout_rdv.php?time=mercredi-11:00-<?php echo $id_agent; ?>">11:00</a></td>
                                <td class="available" id="mercredi-16:00"><a id="mercredi-16:00-a" href="ajout_rdv.php?time=mercredi-16:00-<?php echo $id_agent; ?>">16:00</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-11:00"><a id="jeudi-11:00-a" href="ajout_rdv.php?time=jeudi-11:00-<?php echo $id_agent; ?>">11:00</a></td>
                                <td class="available" id="jeudi-16:00"><a id="jeudi-16:00-a" href="ajout_rdv.php?time=jeudi-16:00-<?php echo $id_agent; ?>">16:00</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-11:00"><a id="vendredi-11:00-a" href="ajout_rdv.php?time=vendredi-11:00-<?php echo $id_agent; ?>">11:00</a></td>
                                <td class="available" id="vendredi-16:00"><a id="vendredi-16:00-a" href="ajout_rdv.php?time=vendredi-16:00-<?php echo $id_agent; ?>">16:00</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-11:00"><a id="samedi-11:00-a" href="ajout_rdv.php?time=samedi-11:00-<?php echo $id_agent; ?>">11:00</a></td>
                                <td class="available" id="samedi-16:00"><a id="samedi-16:00-a" href="ajout_rdv.php?time=samedi-16:00-<?php echo $id_agent; ?>">16:00</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-11:30"><a id="lundi-11:30-a" href="ajout_rdv.php?time=lundi-11:30-<?php echo $id_agent; ?>">11:30</a></td>
                                <td class="available" id="lundi-16:30"><a id="lundi-16:30-a" href="ajout_rdv.php?time=lundi-16:30-<?php echo $id_agent; ?>">16:30</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-11:30"><a id="mardi-11:30-a" href="ajout_rdv.php?time=mardi-11:30-<?php echo $id_agent; ?>">11:30</a></td>
                                <td class="available" id="mardi-16:30"><a id="mardi-16:30-a" href="ajout_rdv.php?time=mardi-16:30-<?php echo $id_agent; ?>">16:30</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-11:30"><a id="mercredi-11:30-a" href="ajout_rdv.php?time=mercredi-11:30-<?php echo $id_agent; ?>">11:30</a></td>
                                <td class="available" id="mercredi-16:30"><a id="mercredi-16:30-a" href="ajout_rdv.php?time=mercredi-16:30-<?php echo $id_agent; ?>">16:30</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-11:30"><a id="jeudi-11:30-a" href="ajout_rdv.php?time=jeudi-11:30-<?php echo $id_agent; ?>">11:30</a></td>
                                <td class="available" id="jeudi-16:30"><a id="jeudi-16:30-a" href="ajout_rdv.php?time=jeudi-16:30-<?php echo $id_agent; ?>">16:30</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-11:30"><a id="vendredi-11:30-a" href="ajout_rdv.php?time=vendredi-11:30-<?php echo $id_agent; ?>">11:30</a></td>
                                <td class="available" id="vendredi-16:30"><a id="vendredi-16:30-a" href="ajout_rdv.php?time=vendredi-16:30-<?php echo $id_agent; ?>">16:30</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-11:30"><a id="samedi-11:30-a" href="ajout_rdv.php?time=samedi-11:30-<?php echo $id_agent; ?>">11:30</a></td>
                                <td class="available" id="samedi-16:30"><a id="samedi-16:30-a" href="ajout_rdv.php?time=samedi-16:30-<?php echo $id_agent; ?>">16:30</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-12:00"><a id="lundi-12:00-a" href="ajout_rdv.php?time=lundi-12:00-<?php echo $id_agent; ?>">12:00</a></td>
                                <td class="available" id="lundi-17:00"><a id="lundi-17:00-a" href="ajout_rdv.php?time=lundi-17:00-<?php echo $id_agent; ?>">17:00</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-12:00"><a id="mardi-12:00-a" href="ajout_rdv.php?time=mardi-12:00-<?php echo $id_agent; ?>">12:00</a></td>
                                <td class="available" id="mardi-17:00"><a id="mardi-17:00-a" href="ajout_rdv.php?time=mardi-17:00-<?php echo $id_agent; ?>">17:00</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-12:00"><a id="mercredi-12:00-a" href="ajout_rdv.php?time=mercredi-12:00-<?php echo $id_agent; ?>">12:00</a></td>
                                <td class="available" id="mercredi-17:00"><a id="mercredi-17:00-a" href="ajout_rdv.php?time=mercredi-17:00-<?php echo $id_agent; ?>">17:00</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-12:00"><a id="jeudi-12:00-a" href="ajout_rdv.php?time=jeudi-12:00-<?php echo $id_agent; ?>">12:00</a></td>
                                <td class="available" id="jeudi-17:00"><a id="jeudi-17:00-a" href="ajout_rdv.php?time=jeudi-17:00-<?php echo $id_agent; ?>">17:00</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-12:00"><a id="vendredi-12:00-a" href="ajout_rdv.php?time=vendredi-12:00-<?php echo $id_agent; ?>">12:00</a></td>
                                <td class="available" id="vendredi-17:00"><a id="vendredi-17:00-a" href="ajout_rdv.php?time=vendredi-17:00-<?php echo $id_agent; ?>">17:00</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-12:00"><a id="samedi-12:00-a" href="ajout_rdv.php?time=samedi-12:00-<?php echo $id_agent; ?>">12:00</a></td>
                                <td class="available" id="samedi-17:00"><a id="samedi-17:00-a" href="ajout_rdv.php?time=samedi-17:00-<?php echo $id_agent; ?>">17:00</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-12:30"><a id="lundi-12:30-a" href="ajout_rdv.php?time=lundi-12:30-<?php echo $id_agent; ?>">12:30</a></td>
                                <td class="available" id="lundi-17:30"><a id="lundi-17:30-a" href="ajout_rdv.php?time=lundi-17:30-<?php echo $id_agent; ?>">17:30</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-12:30"><a id="mardi-12:30-a" href="ajout_rdv.php?time=mardi-12:30-<?php echo $id_agent; ?>">12:30</a></td>
                                <td class="available" id="mardi-17:30"><a id="mardi-17:30-a" href="ajout_rdv.php?time=mardi-17:30-<?php echo $id_agent; ?>">17:30</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-12:30"><a id="mercredi-12:30-a" href="ajout_rdv.php?time=mercredi-12:30-<?php echo $id_agent; ?>">12:30</a></td>
                                <td class="available" id="mercredi-17:30"><a id="mercredi-17:30-a" href="ajout_rdv.php?time=mercredi-17:30-<?php echo $id_agent; ?>">17:30</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-12:30"><a id="jeudi-12:30-a" href="ajout_rdv.php?time=jeudi-12:30-<?php echo $id_agent; ?>">12:30</a></td>
                                <td class="available" id="jeudi-17:30"><a id="jeudi-17:30-a" href="ajout_rdv.php?time=jeudi-17:30-<?php echo $id_agent; ?>">17:30</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-12:30"><a id="vendredi-12:30-a" href="ajout_rdv.php?time=vendredi-12:30-<?php echo $id_agent; ?>">12:30</a></td>
                                <td class="available" id="vendredi-17:30"><a id="vendredi-17:30-a" href="ajout_rdv.php?time=vendredi-17:30-<?php echo $id_agent; ?>">17:30</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-12:30"><a id="samedi-12:30-a" href="ajout_rdv.php?time=samedi-12:30-<?php echo $id_agent; ?>">12:30</a></td>
                                <td class="available" id="samedi-17:30"><a id="samedi-17:30-a" href="ajout_rdv.php?time=samedi-17:30-<?php echo $id_agent; ?>">17:30</a></td>
                            </tr>

                            <tr>
                                <!-- Lundi -->
                                <td class="available" id="lundi-13:00"><a id="lundi-13:00-a" href="ajout_rdv.php?time=lundi-13:00-<?php echo $id_agent; ?>">13:00</a></td>
                                <td class="available" id="lundi-18:00"><a id="lundi-18:00-a" href="ajout_rdv.php?time=lundi-18:00-<?php echo $id_agent; ?>">18:00</a></td>
                                <!-- Mardi -->
                                <td class="available" id="mardi-13:00"><a id="mardi-13:00-a" href="ajout_rdv.php?time=mardi-13:00-<?php echo $id_agent; ?>">13:00</a></td>
                                <td class="available" id="mardi-18:00"><a id="mardi-18:00-a" href="ajout_rdv.php?time=mardi-18:00-<?php echo $id_agent; ?>">18:00</a></td>
                                <!-- Mercredi -->
                                <td class="available" id="mercredi-13:00"><a id="mercredi-13:00-a" href="ajout_rdv.php?time=mercredi-13:00-<?php echo $id_agent; ?>">13:00</a></td>
                                <td class="available" id="mercredi-18:00"><a id="mercredi-18:00-a" href="ajout_rdv.php?time=mercredi-18:00-<?php echo $id_agent; ?>">18:00</a></td>
                                <!-- Jeudi -->
                                <td class="available" id="jeudi-13:00"><a id="jeudi-13:00-a" href="ajout_rdv.php?time=jeudi-13:00-<?php echo $id_agent; ?>">13:00</a></td>
                                <td class="available" id="jeudi-18:00"><a id="jeudi-18:00-a" href="ajout_rdv.php?time=jeudi-18:00-<?php echo $id_agent; ?>">18:00</a></td>
                                <!-- Vendredi -->
                                <td class="available" id="vendredi-13:00"><a id="vendredi-13:00-a" href="ajout_rdv.php?time=vendredi-13:00-<?php echo $id_agent; ?>">13:00</a></td>
                                <td class="available" id="vendredi-18:00"><a id="vendredi-18:00-a" href="ajout_rdv.php?time=vendredi-18:00-<?php echo $id_agent; ?>">18:00</a></td>
                                <!-- Samedi -->
                                <td class="available" id="samedi-13:00"><a id="samedi-13:00-a" href="ajout_rdv.php?time=samedi-13:00-<?php echo $id_agent; ?>">13:00</a></td>
                                <td class="available" id="samedi-18:00"><a id="samedi-18:00-a" href="ajout_rdv.php?time=samedi-18:00-<?php echo $id_agent; ?>">18:00</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="buttons">
                    <button id="contact-agent" onclick="location.href='chat.php'">Communiquer avec l'agent immobilier</button>
                    <button id="view-cv" onclick="location.href='CVpdf.html'">Voir son CV</button>
                </div>
                <div id="confirmationMessage"></div>
            </div>         
        </div>
        <?php 
        if ($rdv && $rdv->num_rows > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {";
            while($row = $rdv->fetch_assoc()) {
                foreach($row as $day => $time) {
                    if ($day !== 'ID_rdv' && $day !== 'ID_user' && $time !== null) {
                        $time_formatted = substr($time, 0, 5);
                        $id = htmlspecialchars($row['jour']) . '-' . $time_formatted;
                        echo "var elementId = '{$id}';
                            var element = document.getElementById(elementId);
                            if (element) {
                                element.className = 'unavailable';
                            }
                            var link = document.getElementById(elementId + '-a');
                            if (link) {
                                link.removeAttribute('href');
                            }";
                    }
                }
            }
            echo "});
            </script>";
        } else {
            echo "Vous avez aucun rendez-vous de prévu";
        }
        ?> 
    </main>
</body>
</html>
