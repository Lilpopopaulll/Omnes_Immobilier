<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>form</title>
  <link rel="stylesheet" href="./styles/ajouter_propriete.css">
</head>
<body>
  <div class="wrapper">
    <form action="traitementAjouterProp.php" method="post">
      <h2>Ajouter une propriete</h2>

      <div class="input-field">
        <input type="text" required name="nom">
        <label>Nom de la propriete</label>
      </div>

      <div class="input-field">
        <input type="text" required name="ville">
        <label>Ville</label>
      </div>

      <div class="input-field">
        <input type="text" required name="adresse">
        <label>Adresse</label>
      </div>

      <div class="input-field">
        <input type="text" required name="prix">
        <label>Prix</label>
      </div>

      <div class="input-field">
        <input type="text" name="url_image">
        <label>url_image</label>
      </div>

      <div class="input-field">
        <select class="role" name="type" required>
          <option value="" disabled selected></option>
          <option value="com">Immobilier commercial</option>
          <option value="res">Immobilier résidentiel</option>
          <option value="ter">Terrain</option>
          <option value="lou">Appartement à louer</option>
        </select>
        <label>Choisissez un un type</label>
      </div>
      
      <button type="submit" name="Ajouter">Ajouter/button>
      
    </form>
  </div>
  

</body>
</html>