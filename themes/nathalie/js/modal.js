document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('contact-modal');
    const openModalButtons = document.querySelectorAll('.idopenModal , .idopenModal2'); // Boutons pour ouvrir le modal
    const closeModal = document.querySelector('.close-modal');
    const contactForm = modal.querySelector('form.wpcf7-form'); // Sélecteur du formulaire CF7

    // Ouvrir le modal et ajouter la référence
    openModalButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            modal.style.display = 'block';

            // Récupérer la référence de la photo depuis l'attribut `data-reference`
            const photoReference = button.dataset.reference;
            const hiddenField = contactForm.querySelector('input[name="photo_reference"]');
            if (typeof photoReference !== "undefined") { 
                hiddenField.value = photoReference; // Ajouter la référence au champ caché
            } else {
                hiddenField.value = ''; // Si undefined, laisser le champ vide
            }
        });
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
