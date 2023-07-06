let actualPage = document.URL;

let screenWidth = window.innerWidth;

if (actualPage === "http://localhost/star_island_final/") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-body-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundRepeat = "no-repeat";
}
if (actualPage.includes("galerie.php")) {
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
    if (screenWidth < 800) {
      document.body.style.backgroundSize = "auto";
    }
}
if (actualPage === "http://localhost/star_island_final/avis.php") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-avis-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundPosition = "center"
    document.body.style.backgroundRepeat = "no-repeat";
    if (screenWidth < 800) {
      document.body.style.backgroundSize = "310%";
    }
}
if (actualPage === "http://localhost/star_island_final/event.php") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-event-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundPosition = "center"
    document.body.style.backgroundRepeat = "no-repeat";
    if (screenWidth < 800) {
      document.body.style.backgroundSize = "auto";
    }
}



const staff= document.querySelectorAll('.tous');
const options = document.querySelectorAll('input');
options.forEach(option => {  
  option.addEventListener('input', function() {
  staff.forEach(staff => {
    staff.style.display = 'flex';
    if (!staff.classList.contains(this.value)) {
    staff.style.display = 'none';
    }
  });
  });

});




const imageContainers = document.querySelectorAll('.image-container');


document.addEventListener('DOMContentLoaded', function() {
  

const lightbox = document.getElementById('lightbox');
const lightboxImage = document.getElementById('lightbox-image');


imageContainers.forEach(function(container) {
  container.addEventListener('click', function() {

    lightbox.style.display = 'block';
    lightboxImage.src = container.src;
  });
});

lightbox.addEventListener('click', function() {

  lightbox.style.display = 'none';
});

});




function padNumber(number) {
  return number.toString().padStart(2, "0");
}

