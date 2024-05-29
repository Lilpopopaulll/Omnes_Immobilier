document.addEventListener('DOMContentLoaded', function () {
    const btnToggleConnexion = document.querySelector('.btn_toggle_connexion');
    const overlayConnexion = document.getElementById('overlay_connexion');

    btnToggleConnexion.addEventListener('click', function () {
        if (overlayConnexion.style.display === 'none' || overlayConnexion.style.display === '') {
            overlayConnexion.style.display = 'block';
        } else {
            overlayConnexion.style.display = 'none';
        }
    });
});
