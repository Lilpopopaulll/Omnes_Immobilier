<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Identifiez le nom de la base de données
    $database = "omnes_immobilier";

    // Connectez-vous à votre BDD
    $db_handle = mysqli_connect('localhost', 'root', '', $database);

    if (!$db_handle) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];

    // Récupérez les informations de l'utilisateur
    $sql = "SELECT prenom, nom, adresse, permission FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $prenom = $user_info['prenom'];
        $nom = $user_info['nom'];
        $adresse = $user_info['adresse'];
        $permission = $user_info['permission']; // Nouvelle ligne pour récupérer la permission

        // Définir le nom de l'utilisateur dans la session
        $_SESSION['name'] = $prenom;
    } else {
        echo "Aucune information trouvée pour l'utilisateur.";
    }

    // Fermez la connexion à la base de données
    mysqli_close($db_handle);
}

// Déconnexion de l'utilisateur
if (isset($_GET['logout'])) {
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>" . $_SESSION['name'] . "</b> a quitté la session de chat.</span><br></div>";
    $myfile = fopen(__DIR__ . "/log.html", "a") or die("Impossible d'ouvrir le fichier!" . __DIR__ . "/log.html");
    fwrite($myfile, $logout_message);
    fclose($myfile);
    session_destroy();
    sleep(1);
    header("Location: chat.php"); //Rediriger l'utilisateur
}

function loginForm() {
    echo '<div id="loginform">
            <p>Veuillez saisir votre nom pour continuer!</p>
            <form action="chat.php" method="post">
                <label for="name">Nom: </label>
                <input type="text" name="name" id="name" />
                <input type="submit" name="enter" id="enter" value="Soumettre" />
            </form>
          </div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Exemple Chat Texto</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
if (!isset($_SESSION['name'])) {
    loginForm();
} else {
?>
    <div id="wrapper">
        <div id="menu">
            <p class="welcome">Bienvenue, <b><?php echo $_SESSION['name']; ?></b></p>
            <p class="logout"><a id="exit" href="#">Quitter la conversation</a></p>
        </div>

        <div id="chatbox">
            <?php
            if (file_exists("log.html") && filesize("log.html") > 0) {
                $contents = file_get_contents("log.html");
                echo $contents;
            }
            ?>
        </div>

        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" />
            <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer" />
        </form>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#submitmsg").click(function () {
                var clientmsg = $("#usermsg").val();
                $.post("post.php", { text: clientmsg });
                $("#usermsg").val("");
                return false;
            });

            function loadLog() {
                var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20;
                $.ajax({
                    url: "log.html",
                    cache: false,
                    success: function (html) {
                        $("#chatbox").html(html);
                        var newscrollHeight = $("#chatbox")[0].scrollHeight - 20;
                        if (newscrollHeight > oldscrollHeight) {
                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
                        }
                    }
                });
            }

            setInterval(loadLog, 2500);

            $("#exit").click(function () {
                var exit = confirm("Voulez-vous vraiment mettre fin à la session ?");
                if (exit == true) {
                    window.location = "chat.php?logout=true";
                }
            });
        });
    </script>
<?php
}
?>
</body>
</html>
