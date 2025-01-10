document.addEventListener('DOMContentLoaded', function () {
    const hoverThumbnail = document.getElementById('hover-thumbnail'); // Placeholder pour la miniature
    const navArrows = document.querySelectorAll('.nav-arrow'); // Toutes les flèches

    navArrows.forEach(arrow => {
        arrow.addEventListener('mouseenter', function () {
            // Récupérer l'URL de la miniature depuis l'attribut data-thumbnail
            const thumbnailUrl = this.getAttribute('data-thumbnail');
            if (thumbnailUrl) {
                hoverThumbnail.src = thumbnailUrl;
                hoverThumbnail.style.display = '';
            }
        });
 
        
    });
});
