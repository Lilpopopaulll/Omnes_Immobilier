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
    $sql = "SELECT * FROM rdv";
    $result = $db_handle->query($sql);
 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'Agent</title>
    <link rel="stylesheet" type="text/css" href="infoAgent.css">
    <script src="script.js"></script>
    <script src="Calendrier.js"></script>


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
                $sql = "SELECT Nom_prenom, Courriel, Spécialité, téléphone FROM agents_immobilier WHERE Nom_prenom = '$nom'";
                $result = mysqli_query($db_handle, $sql);                
                if (mysqli_num_rows($result) > 0) {
                    $user_info = mysqli_fetch_assoc($result);
                    $email = $user_info['Courriel'];   
                    $specialite = $user_info['Spécialité']; 
                    $telephone = $user_info['téléphone']; 
                } else {
                    echo "Aucune information trouvée pour l'utilisateur.";
                } 
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
                            <th colspan="2">Spécialité et Agent</th>
                            <th colspan="2">Lundi</th>
                            <th colspan="2">Mardi</th>
                            <th colspan="2">Mercredi</th>
                            <th colspan="2">Jeudi</th>
                            <th colspan="2">Vendredi</th>
                            <th colspan="2">Samedi</th>
                        </tr>
                        <tr>
                            <th colspan="2"></th>
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
                            <td colspan="2" rowspan="9">Immobilier Résidentiel - Jean-Pierre SEGADO</td>
                            <!-- Lundi -->
                            <td class="available" id="lundi-09:00">09:00</td>
                            <td class="available" id="lundi-14:00">14:00</td>
                            <!-- Mardi -->
                            <td class="available" id="mardi-09:00">09:00</td>
                            <td class="available" id="mardi-14:00">14:00</td>
                            <!-- Mercredi -->
                            <td class="available" id="mercredi-09:00">09:00</td>
                            <td class="available" id="mercredi-14:00">14:00</td>
                            <!-- Jeudi -->
                            <td class="available" id="jeudi-09:00">09:00</td>
                            <td class="available" id="jeudi-14:00">14:00</td>
                            <!-- Vendredi -->
                            <td class="available" id="vendredi-09:00">09:00</td>
                            <td class="available" id="vendredi-14:00">14:00</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-09:00">09:00</td>
                            <td class="available" id="samedi-14:00">14:00</td>
                        </tr>

                        <tr>
                            <!-- Lundi -->
                            <td class="available" id="lundi-09:30">09:30</td>
                            <td class="available" id="lundi-14:30">14:30</td>
                            <!-- Mardi -->
                            <td class="available" id="mardi-09:30">09:30</td>
                            <td class="unavailable" id="mardi-14:30">14:30</td>
                            <!-- Mercredi -->
                            <td class="unavailable" id="mercredi-09:30">09:30</td>
                            <td class="available" id="mercredi-14:30">14:30</td>
                            <!-- Jeudi -->
                            <td class="available" id="jeudi-09:30">09:30</td>
                            <td class="unavailable" id="jeudi-14:30">14:30</td>
                            <!-- Vendredi -->
                            <td class="unavailable" id="vendredi-09:30">09:30</td>
                            <td class="available" id="vendredi-14:30">14:30</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-09:30">09:30</td>
                            <td class="unavailable" id="samedi-14:30">14:30</td>
                        </tr>

                        <tr>
                            <!-- Lundi -->
                            <td class="unavailable" id="lundi-10:00">10:00</td>
                            <td class="available" id="lundi-15:00">15:00</td>
                            <!-- Mardi -->
                            <td class="unavailable" id="mardi-10:00">10:00</td>
                            <td class="available" id="mardi-15:00">15:00</td>
                            <!-- Mercredi -->
                            <td class="available" id="mercredi-10:00">10:00</td>
                            <td class="unavailable" id="mercredi-15:00">15:00</td>
                            <!-- Jeudi -->
                            <td class="unavailable" id="jeudi-10:00">10:00</td>
                            <td class="available" id="jeudi-15:00">15:00</td>
                            <!-- Vendredi -->
                            <td class="available" id="vendredi-10:00">10:00</td>
                            <td class="unavailable" id="vendredi-15:00">15:00</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-10:00">10:00</td>
                            <td class="unavailable" id="samedi-15:00">15:00</td>
                        </tr>

                        <tr>
                            <!-- Lundi -->
                            <td class="available" id="lundi-10:30">10:30</td>
                            <td class="unavailable" id="lundi-15:30">15:30</td>
                            <!-- Mardi -->
                            <td class="available" id="mardi-10:30">10:30</td>
                            <td class="unavailable" id="mardi-15:30">15:30</td>
                            <!-- Mercredi -->
                            <td class="unavailable" id="mercredi-10:30">10:30</td>
                            <td class="available" id="mercredi-15:30">15:30</td>
                            <!-- Jeudi -->
                            <td class="available" id="jeudi-10:30">10:30</td>
                            <td class="unavailable" id="jeudi-15:30">15:30</td>
                            <!-- Vendredi -->
                            <td class="unavailable" id="vendredi-10:30">10:30</td>
                            <td class="available" id="vendredi-15:30">15:30</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-10:30">10:30</td>
                            <td class="unavailable" id="samedi-15:30">15:30</td>
                        </tr>

                        <tr>
                            <!-- Lundi -->
                            <td class="unavailable" id="lundi-11:00">11:00</td>
                            <td class="available" id="lundi-16:00">16:00</td>
                            <!-- Mardi -->
                            <td class="unavailable" id="mardi-11:00">11:00</td>
                            <td class="available" id="mardi-16:00">16:00</td>
                            <!-- Mercredi -->
                            <td class="available" id="mercredi-11:00">11:00</td>
                            <td class="unavailable" id="mercredi-16:00">16:00</td>
                            <!-- Jeudi -->
                            <td class="unavailable" id="jeudi-11:00">11:00</td>
                            <td class="available" id="jeudi-16:00">16:00</td>
                            <!-- Vendredi -->
                            <td class="available" id="vendredi-11:00">11:00</td>
                            <td class="unavailable" id="vendredi-16:00">16:00</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-11:00">11:00</td>
                            <td class="unavailable" id="samedi-16:00">16:00</td>
                        </tr>


                        <tr>
                            <!-- Lundi -->
                            <td class="available" id="lundi-11:30">11:30</td>
                            <td class="unavailable" id="lundi-16:30">16:30</td>
                            <!-- Mardi -->
                            <td class="available" id="mardi-11:30">11:30</td>
                            <td class="unavailable" id="mardi-16:30">16:30</td>
                            <!-- Mercredi -->
                            <td class="unavailable" id="mercredi-11:30">11:30</td>
                            <td class="available" id="mercredi-16:30">16:30</td>
                            <!-- Jeudi -->
                            <td class="available" id="jeudi-11:30">11:30</td>
                            <td class="unavailable" id="jeudi-16:30">16:30</td>
                            <!-- Vendredi -->
                            <td class="unavailable" id="vendredi-11:30">11:30</td>
                            <td class="available" id="vendredi-16:30">16:30</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-11:30">11:30</td>
                            <td class="unavailable" id="samedi-16:30">16:30</td>
                        </tr>


                        <tr>
                            <!-- Lundi -->
                            <td class="unavailable" id="lundi-12:00">12:00</td>
                            <td class="available" id="lundi-17:00">17:00</td>
                            <!-- Mardi -->
                            <td class="unavailable" id="mardi-12:00">12:00</td>
                            <td class="available" id="mardi-17:00">17:00</td>
                            <!-- Mercredi -->
                            <td class="available" id="mercredi-12:00">12:00</td>
                            <td class="unavailable" id="mercredi-17:00">17:00</td>
                            <!-- Jeudi -->
                            <td class="unavailable" id="jeudi-12:00">12:00</td>
                            <td class="available" id="jeudi-17:00">17:00</td>
                            <!-- Vendredi -->
                            <td class="available" id="vendredi-12:00">12:00</td>
                            <td class="unavailable" id="vendredi-17:00">17:00</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-12:00">12:00</td>
                            <td class="unavailable" id="samedi-17:00">17:00</td>
                        </tr>


                        <tr>
                            <!-- Lundi -->
                            <td class="available" id="lundi-12:30">12:30</td>
                            <td class="unavailable" id="lundi-17:30">17:30</td>
                            <!-- Mardi -->
                            <td class="available" id="mardi-12:30">12:30</td>
                            <td class="unavailable" id="mardi-17:30">17:30</td>
                            <!-- Mercredi -->
                            <td class="unavailable" id="mercredi-12:30">12:30</td>
                            <td class="available" id="mercredi-17:30">17:30</td>
                            <!-- Jeudi -->
                            <td class="available" id="jeudi-12:30">12:30</td>
                            <td class="unavailable" id="jeudi-17:30">17:30</td>
                            <!-- Vendredi -->
                            <td class="unavailable" id="vendredi-12:30">12:30</td>
                            <td class="available" id="vendredi-17:30">17:30</td>
                            <!-- Samedi -->
                            <td class="available" id="samedi-12:30">12:30</td>
                            <td class="unavailable" id="samedi-17:30">17:30</td>
                        </tr>

                        <tr>
                        <!-- Lundi -->
                        <td class="unavailable" id="lundi-13:00">13:00</td>
                        <td class="unavailable" id="lundi-18:00">18:00</td>
                        <!-- Mardi -->
                        <td class="unavailable" id="mardi-13:00">13:00</td>
                        <td class="unavailable" id="mardi-18:00">18:00</td>
                        <!-- Mercredi -->
                        <td class="unavailable" id="mercredi-13:00">13:00</td>
                        <td class="unavailable" id="mercredi-18:00">18:00</td>
                        <!-- Jeudi -->
                        <td class="unavailable" id="jeudi-13:00">13:00</td>
                        <td class="unavailable" id="jeudi-18:00">18:00</td>
                        <!-- Vendredi -->
                        <td class="unavailable" id="vendredi-13:00">13:00</td>
                        <td class="unavailable" id="vendredi-18:00">18:00</td>
                        <!-- Samedi -->
                        <td class="unavailable" id="samedi-13:00">13:00</td>
                        <td class="unavailable" id="samedi-18:00">18:00</td>
                    </tr>


                        
                    </tbody>
                </table>
            </div>
        <div class="buttons">
            <button id="book-appointment">Prendre un RDV</button>
            <button id="contact-agent">Communiquer avec l'agent immobilier</button>
            <button id="view-cv">Voir son CV</button>
        </div>
        <div id="confirmationMessage"></div>
    </div>
            </div>         
        </div>
    </main>

    <?php 
        if ($result && $result->num_rows > 0) {
            // Affichage des rendez-vous dans un tableau
            while($row = $result->fetch_assoc()) {
                foreach($row as $day => $time) {
                    if ($day !== 'ID_rdv' && $day !== 'ID_user' && $time !== null) {
                        echo "<td>$day</td>";
                        echo "<td>$time</td>";
                        echo '<td>
                            <form action="annulation.php" method="post">
                                <input type="hidden" name="ID_rdv" value="' . htmlspecialchars($row['ID_rdv']) . '">
                                <button type="submit" class="btn_deconnexion">Annuler</button>
                            </form>
                        </td>';
                        echo "</tr>";
                    }
                }
            }
            echo "</table>";
        } else {
            echo "Vous avez aucun rendez-vous de prévu";
        }
        ?>
    <script>
        
    </script>
</body>
</html>
