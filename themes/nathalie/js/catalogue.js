document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filter-form');
    const photoList = document.getElementById('photo-list');
    const loadMoreButton = document.getElementById('load-more');

    function fetchPhotos(page = 1) {
        const formData = new FormData(filterForm);
        formData.append('action', 'get_photos');
        formData.append('page', page);

        fetch(ajaxurl, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Vérifiez les données renvoyées par le serveur
                if (page === 1) {
                    photoList.innerHTML = data; // Remplacer les photos actuelles
                } else {
                    photoList.innerHTML += data; // Ajouter de nouvelles photos
                
                }
                loadMoreButton.dataset.page = page + 1;
                            // Vérifiez si la quantité de photos renvoyées est inférieure à posts_per_page
            if (data.trim().length === 0) {
                loadMoreButton.style.display = 'none'; // Cacher le bouton si plus de photos
            } else {
                loadMoreButton.style.display = 'block'; // Afficher le bouton si des photos sont présentes
            }
                
            });
        
    }

    // Appliquer les filtres
    filterForm.addEventListener('change', () => {
        fetchPhotos(1); // Charger les photos avec les filtres
    });

    // Charger plus de photos
    loadMoreButton.addEventListener('click', () => {
        const nextPage = parseInt(loadMoreButton.dataset.page);
        fetchPhotos(nextPage);
    });
    // Charger les photos au chargement initial
    fetchPhotos();
});

document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filter-form');
    const photoList = document.getElementById('photo-list');
    const loadMoreButton = document.getElementById('load-more');

    function fetchPhotos(page = 1) {
        const formData = new FormData(filterForm);
        formData.append('action', 'get_photos');
        formData.append('page', page);

        fetch(ajaxurl, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Vérifiez les données renvoyées par le serveur
                if (page === 1) {
                    photoList.innerHTML = data; // Remplacer les photos actuelles
                } else {
                    photoList.innerHTML += data; // Ajouter de nouvelles photos
                }
                loadMoreButton.dataset.page = page + 1;
            });
    }

    // Appliquer les filtres
    filterForm.addEventListener('change', () => {
        fetchPhotos(1); // Charger les photos avec les filtres
    });

    // Charger plus de photos
    loadMoreButton.addEventListener('click', () => {
        const nextPage = parseInt(loadMoreButton.dataset.page);
        fetchPhotos(nextPage);
    });

    // Charger les photos au chargement initial
    fetchPhotos();
});

let images = []; // Liste des URLs des images
let currentImageIndex = 0; // Index actuel de l'image affichée

function openLightbox(imageUrl) {
    // Récupère toutes les images affichées
    images = Array.from(document.querySelectorAll('#photo-list img')).map(img => img.src);
    currentImageIndex = images.indexOf(imageUrl); // Trouve l'index de l'image cliquée

    const currentImageElement = document.querySelector(`#photo-list img[src="${imageUrl}"]`);
    const imageReference = currentImageElement.dataset.reference || 'Référence non disponible';
    const imageCategory = currentImageElement.dataset.category || 'Catégorie non disponible';

    const lightbox = document.createElement('div');
    lightbox.classList.add('lightbox');
    lightbox.innerHTML = `
        <div class="lightbox-content">
            <img id="img_lightbox" src="${imageUrl}" alt="Lightbox Image">
         
            <span class="lightbox-close" onclick="closeLightbox()"></span>
            <button class="lightbox_next" onclick="nextImage()"></button>
            <button class="lightbox_prev" onclick="prevImage()"></button>
               <div class="lightbox-info">
                <p id="lightbox-reference"> ${imageReference}</p>
                <p id="lightbox-category"> ${imageCategory}</p>
            </div>
        </div>
    `;
    document.body.appendChild(lightbox);
    document.body.style.overflow = 'hidden'; // Désactive le scroll
}


function closeLightbox() {
    const lightbox = document.querySelector('.lightbox');
    if (lightbox) {
        lightbox.remove();
        document.body.style.overflow = ''; // Réactive le scroll
    }
}

function nextImage() {
    // Passer à l'image suivante dans le tableau, revenir au début si nécessaire
    currentImageIndex = (currentImageIndex + 1) % images.length;

    // Mettre à jour l'image dans la lightbox
    const imgLightbox = document.getElementById('img_lightbox');
    imgLightbox.src = images[currentImageIndex];

    // Mettre à jour la catégorie et la référence
    const currentImageElement = document.querySelector(`#photo-list img[src="${images[currentImageIndex]}"]`);
    const imageReference = currentImageElement.dataset.reference || 'Référence non disponible';
    const imageCategory = currentImageElement.dataset.category || 'Catégorie non disponible';

    // Mettre à jour les informations dans la lightbox
    document.querySelector('.lightbox-info p:nth-child(1)').textContent = `${imageReference}`;
    document.querySelector('.lightbox-info p:nth-child(2)').textContent = `${imageCategory}`;
}

function prevImage() {
    // Passer à l'image précédente dans le tableau, revenir à la dernière si nécessaire
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;

    // Mettre à jour l'image dans la lightbox
    const imgLightbox = document.getElementById('img_lightbox');
    imgLightbox.src = images[currentImageIndex];

    // Mettre à jour la catégorie et la référence
    const currentImageElement = document.querySelector(`#photo-list img[src="${images[currentImageIndex]}"]`);
    const imageReference = currentImageElement.dataset.reference || 'Référence non disponible';
    const imageCategory = currentImageElement.dataset.category || 'Catégorie non disponible';

    // Mettre à jour les informations dans la lightbox
    document.querySelector('.lightbox-info p:nth-child(1)').textContent = `Référence : ${imageReference}`;
    document.querySelector('.lightbox-info p:nth-child(2)').textContent = `Catégorie : ${imageCategory}`;
}
