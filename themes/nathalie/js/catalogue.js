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

    images = Array.from(document.querySelectorAll('#photo-list img')).map(img => img.src); // Récupère toutes les URLs des images affichées
    currentImageIndex = images.indexOf(imageUrl); // Trouve l'index de l'image cliquée

    const lightbox = document.createElement('div');
    lightbox.classList.add('lightbox');
    lightbox.innerHTML = `
        <div class="lightbox-content">
            <img id="img_lightbox" src="${imageUrl}" alt="Lightbox Image">
            <span class="lightbox-close" onclick="closeLightbox()"></span>
            <button class="lightbox_next"onclick="nextImage()" ></button>
            <button class="lightbox_prev" onclick="prevImage()"></button>
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
    const imgLightbox = document.getElementById('img_lightbox');
    imgLightbox.src = images[currentImageIndex]; // Met à jour l'image dans la lightbox
}

function prevImage() {
    // Passer à l'image précédente dans le tableau, revenir à la dernière si nécessaire
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    const imgLightbox = document.getElementById('img_lightbox');
    imgLightbox.src = images[currentImageIndex]; // Met à jour l'image dans la lightbox
}