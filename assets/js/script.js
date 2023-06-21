let actualPage = document.URL;
console.log(actualPage);

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



// const imageContainers = document.querySelectorAll('.image-container');


// const lightbox = document.getElementById('lightbox');
// const lightboxImage = document.getElementById('lightbox-image');


// imageContainers.forEach(function(container) {
//   container.addEventListener('click', function() {

//     lightbox.style.display = 'block';
//     lightboxImage.src = container.src;
//   });
// });

// lightbox.addEventListener('click', function() {

//   lightbox.style.display = 'none';
// });




