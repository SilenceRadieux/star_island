let actualPage = document.URL;


let screenWidth = window.innerWidth;

if (actualPage === "http://localhost/star_island_final/") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-body-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundRepeat = "no-repeat";
}
if (actualPage === "http://localhost/star_island_final/galerie.php") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-body-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundRepeat = "no-repeat";
}
if (actualPage === "http://localhost/star_island_final/vip.php") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-vip-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundRepeat = "no-repeat";
    if (screenWidth < 800) {
       document.body.style.overflow="scroll";
    } 
}
if (actualPage === "http://localhost/star_island_final/serveur.php") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-serveur-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundRepeat = "no-repeat";
}

// Récupère tous les éléments conteneurs d'images
const imageContainers = document.querySelectorAll('.image-container');

// Récupère la lightbox et l'image en grand format
const lightbox = document.getElementById('lightbox');
const lightboxImage = document.getElementById('lightbox-image');

// Attache un gestionnaire d'événements de clic à chaque élément conteneur d'image
imageContainers.forEach(function(container) {
  container.addEventListener('click', function() {
    // Affiche la lightbox et met à jour l'URL de l'image en grand format
    lightbox.style.display = 'block';
    lightboxImage.src = container.src;
  });
});

