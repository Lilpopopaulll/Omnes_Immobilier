document.addEventListener('DOMContentLoaded', function () {
    const btnToggleConnexion = document.querySelector('.btn_toggle_connexion');
    const btnToggleCompte = document.querySelector('.btn_toggle_compte');
    const overlayConnexion = document.getElementById('overlay_connexion');
    const overlayCompte = document.getElementById('overlay_compte');

    if (btnToggleConnexion) {
        btnToggleConnexion.addEventListener('click', function () {
            if (overlayConnexion.style.display === 'none' || overlayConnexion.style.display === '') {
                overlayConnexion.style.display = 'block';
            } else {
                overlayConnexion.style.display = 'none';
            }
        });
    }

    if (btnToggleCompte) {
        btnToggleCompte.addEventListener('click', function () {
            if (overlayCompte.style.display === 'none' || overlayCompte.style.display === '') {
                overlayCompte.style.display = 'block';
            } else {
                overlayCompte.style.display = 'none';
            }
        });
    }
});
