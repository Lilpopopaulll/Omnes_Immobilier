document.addEventListener('DOMContentLoaded', function () {
    const btnToggleConnexion = document.querySelector('.btn_toggle_connexion');
    const btnToggleCompte = document.querySelector('.btn_toggle_compte');
    const overlayConnexion = document.getElementById('overlay_connexion');
    const overlayCompte = document.getElementById('overlay_compte');

    function toggleOverlay(overlay) {
        if (overlay.classList.contains('show')) {
            overlay.classList.remove('visible');
            setTimeout(() => {
                overlay.classList.remove('show');
                overlay.classList.add('hidden');
            }, 700); // Correspond à la durée de l'animation
        } else {
            overlay.classList.remove('hidden');
            overlay.classList.add('show');
            setTimeout(() => {
                overlay.classList.add('visible');
            }, 1); // Petit délai pour s'assurer que la transition s'applique
        }
    }

    if (btnToggleConnexion) {
        btnToggleConnexion.addEventListener('click', function () {
            toggleOverlay(overlayConnexion);
        });
    }

    if (btnToggleCompte) {
        btnToggleCompte.addEventListener('click', function () {
            toggleOverlay(overlayCompte);
        });
    }
});
