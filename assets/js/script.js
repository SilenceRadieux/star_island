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



//   function addComment() {

//   var commentInput = document.getElementById('comment');
//   const ratingInputs = document.querySelectorAll('.star-rating input');
//   console.log(ratingInputs);
//   ratingInputs.forEach(input => {
//     input.addEventListener('click', function() {
//       // Mettre à jour la valeur sélectionnée
//       const selectedValue = this.value;
//       console.log('Valeur sélectionnée :', selectedValue);
//     });
//   });

//   // Récupérer le commentaire
//   var commentValue = commentInput.value;

//   // Créer un élément de commentaire
//   var commentElement = document.createElement('div');
//   commentElement.className = 'comment';
//   commentElement.innerHTML = '<p>Note : ' + ratingValue + '/5</p>' +
//                              '<p>Commentaire : ' + commentValue + '</p>';

//   // Ajouter le commentaire à la liste des commentaires
//   var commentsContainer = document.getElementById('comments');
//   commentsContainer.appendChild(commentElement);

//   // Réinitialiser les valeurs du formulaire
//   commentInput.value = '';
//   for (var i = 0; i < ratingInputs.length; i++) {
//     ratingInputs[i].checked = false;
//   }
// }



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



const countdownDate = new Date("June 30, 2023 23:59:59").getTime();
const countdownTimer = setInterval(function() {
  const now = new Date().getTime();
  const distance = countdownDate - now;

  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("days").textContent = padNumber(days);
  document.getElementById("hours").textContent = padNumber(hours);
  document.getElementById("minutes").textContent = padNumber(minutes);
  document.getElementById("seconds").textContent = padNumber(seconds);

  if (distance < 0) {
    clearInterval(countdownTimer);
    document.getElementById("countdown").innerHTML = "<h1>Countdown Finished!</h1>";
  }
}, 1000);

function padNumber(number) {
  return number.toString().padStart(2, "0");
}
