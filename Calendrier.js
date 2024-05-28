// scripts.js
document.addEventListener("DOMContentLoaded", function () {
    const availableSlots = document.querySelectorAll('.available');
    const confirmationMessage = document.getElementById('confirmationMessage');

    availableSlots.forEach(slot => {
        slot.addEventListener('click', function () {
            confirmationMessage.textContent = Vous avez sélectionné le créneau: ${this.cellIndex % 2 === 1 ? 'AM' : 'PM'} à ${this.textContent};
            availableSlots.forEach(s => s.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    document.getElementById('book-appointment').addEventListener('click', function () {
        const selectedSlot = document.querySelector('.available.selected');
        if (selectedSlot) {
            confirmationMessage.textContent = Rendez-vous confirmé pour le créneau: ${selectedSlot.cellIndex % 2 === 1 ? 'AM' : 'PM'} à ${selectedSlot.textContent};
            selectedSlot.classList.remove('available');
            selectedSlot.classList.add('unavailable');
            selectedSlot.classList.remove('selected');
        } else {
            confirmationMessage.textContent = 'Veuillez sélectionner un créneau disponible.';
        }
    });
});