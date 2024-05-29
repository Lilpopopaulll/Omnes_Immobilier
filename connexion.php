<?php
// Identifier le nom de base de données
$database = "omnes_immobilier";

// Connectez-vous dans votre BDD
// Votre serveur = localhost | votre login = root | votre mot de passe = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '', $database);

if ($db_handle) {

if(isset($_POST['login'])) {
    $id = $_POST['id'];
    $mdp = $_POST['password'];
    if($id !="" && $mdp !="") {
        $req = $db_handle->query("SELECT * FROM users WHERE id = '$id' AND mdp ='$mdp'");
        $rep = mysqli_fetch_assoc($req);
        if ($rep) {
            echo "Vous êtes connecté";
        } else {
            echo "Vous n'êtes pas connecté";
        }
    }
}
}
    

?>