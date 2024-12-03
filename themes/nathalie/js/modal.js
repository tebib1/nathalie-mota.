document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('contact-modal');
    const idopenModal = document.querySelector('.idopenModal');
    const closeModal = document.querySelector('.close-modal');

    // Ouvrir le modal au clic sur le lien "Contact"
    idopenModal.addEventListener('click', function (event) {
        event.preventDefault();
        modal.style.display = 'block';
    });

    // Fermer le modal au clic sur le bouton de fermeture
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Fermer le modal si on clique en dehors du contenu
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
