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

            // Construire une chaîne de texte avec les informations supplémentaires
            var additionalInfo = "<h3>" + propertyName + "</h3>" +
                                 "<p>Prix: " + propertyPrice + " €</p>" +
                                 "<p>Statut: " + propertyStatus + "</p>" +
                                 "<p>Adresse: " + propertyAddress + "</p>" +
                                 "<p>Ville: " + propertyCity + "</p>" +
                                 "<p>ID Propriété: " + propertyID + "</p>" +
                                 "<p>Description: " + propertyDetail + "</p>";

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
