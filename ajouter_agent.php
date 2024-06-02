<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>form</title>
  <link rel="stylesheet" href="./styles/ajouter_agent.css">
</head>
<body>
  <div class="wrapper">
    <form action="traitementAjouterAgent.php" method="post">
      <h2>Ajouter un agent</h2>

      <div class="input-field">
        <input type="text" required name="nom">
        <label>Nom</label>
      </div>

      <div class="input-field">
        <input type="text" required name="email">
        <label>Email</label>
      </div>

      <div class="input-field">
        <input type="text" required name="tel">
        <label>Téléphone</label>
      </div>


    
      <div class="input-field">
        <select class="role" name="type" required>
          <option value="" disabled selected></option>
          <option value="com">Immobilier commercial</option>
          <option value="res">Immobilier résidentiel</option>
          <option value="ter">Terrain</option>
          <option value="lou">Appartement à louer</option>
        </select>
        <label>Choisissez une spécialité</label>
      </div>
      
      <button type="submit" name="Ajouter">Ajouter/button>
      
    </form>
  </div>
  

</body>
</html>