document.addEventListener("DOMContentLoaded", function() {
    var images = document.querySelectorAll(".annonce img");

    images.forEach(function(image) {
        image.addEventListener("click", function() {
            // Récupérer les informations à partir des attributs de données
            var propertyName = this.alt;
            var propertyPrice = this.dataset.prix;
            var propertyStatus = this.dataset.statut;
            var propertyAddress = this.dataset.adresse;
            var propertyCity = this.dataset.ville;
            var propertyID = this.dataset.idPropriete;
            var propertyDetail = this.dataset.detail;
            var propertyA1= this.dataset.a1;
            var propertyA2= this.dataset.a2;
            var propertyA3= this.dataset.a3;
            var propertyA4= this.dataset.a4;
            var propertyA5= this.dataset.a5;

            // Construire une chaîne de texte avec les informations supplémentaires
            var additionalInfo = "<h3>" + propertyName + "</h3>" +
                                 "<p>Prix: " + propertyPrice + " €</p>" +
                                 "<p>Statut: " + propertyStatus + "</p>" +
                                 "<p>Adresse: " + propertyAddress + "</p>" +
                                 "<p>Ville: " + propertyCity + "</p>" +
                                 "<p>ID Propriété: " + propertyID + "</p>" +
                                 "<p>Description: " + propertyDetail + "</p>" +
                                 "<h3>Nos agents agréés</h3>" +
                                 "<p><Vous pouvez prendre rendez-vous avec eux dès maintenant en cliquant sur leur nom></p>" +
                                 "<a href='infoAgent.php?property=" + encodeURIComponent(propertyA1) + "'>" + propertyA1 + " </a><br>"+
                                 "<a href='infoAgent.php?property=" + encodeURIComponent(propertyA2) + "'>" + propertyA2 + " </a><br>"+
                                 "<a href='infoAgent.php?property=" + encodeURIComponent(propertyA3) + "'>" + propertyA3 + " </a><br>"+
                                 "<a href='infoAgent.php?property=" + encodeURIComponent(propertyA4) + "'>" + propertyA4 + " </a><br>"+
                                 "<a href='infoAgent.php?property=" + encodeURIComponent(propertyA5) + "'>" + propertyA5 + " </a><br>"+
                                 "<br>"+
                                 "<a class='acheter' href='paiement.php?id_propriete=" + encodeURIComponent(propertyID) + "'>" +  " Acheter </a><br>";





            // Afficher les informations supplémentaires dans l'overlay
            document.getElementById("property_details").innerHTML = "<img src='" + this.src + "' alt='Property Image'>" + additionalInfo;
            document.getElementById("overlay_detail").style.display = "flex";
        });
    });

    document.getElementById("overlay_detail").addEventListener("click", function(event) {
        if (event.target === this) {
            this.style.display = "none";
        }
    });
});
