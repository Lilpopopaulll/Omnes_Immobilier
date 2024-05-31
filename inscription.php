<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glassmorphism Login Form | CodingNepal</title>
  <link rel="stylesheet" href="./styles/inscription.css">
</head>
<body>
  <div class="wrapper">
    <form action="traitementInscription.php" method="post">
      <h2>S'inscrire</h2>

      <div class="input-field">
        <input type="text" required name="prenom">
        <label>Entrer votre Prenom</label>
      </div>

      <div class="input-field">
        <input type="text" required name="nom">
        <label>Entrer votre Nom</label>
      </div>

      <div class="input-field">
        <input type="text" required name="adresse">
        <label>Entrer votre adresse</label>
      </div>

      <div class="input-field">
        <input type="text" required name="id">
        <label>Entrer votre adresse email</label>
      </div>

      <div class="input-field">
        <input type="password" required name="mdp">
        <label>Enter votre mot de passe</label>
      </div>
      <button type="submit" name="inscrire">S'inscrire</button>
      <div class="register">
        <p>Déjà un compte ? <a href="accueil.php">Se connecter</a></p>
      </div>
    </form>
  </div>
  

</body>
</html>