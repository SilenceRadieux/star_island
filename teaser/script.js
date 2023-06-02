// Date d'ouverture du site (format : année, mois (0-11), jour, heure, minute, seconde)
var siteOpeningDate = new Date(2023, 5, 30, 0, 0, 0); // Le mois est décalé de 1, donc 5 correspond à juin

function updateCountdown() {
    var currentDate = new Date();
    var timeDifference = siteOpeningDate - currentDate;

    if (timeDifference > 0) {
        var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        var countdownElement = document.getElementById('countdown');
        countdownElement.innerHTML = days + 'j :' + hours + 'h :' + minutes + 'm :' + seconds + 's';

        setTimeout(updateCountdown, 1000); // Met à jour le décompte toutes les secondes
    } else {
        var countdownElement = document.getElementById('countdown');
        countdownElement.innerHTML = "Le site est ouvert !"; // Message lorsque le site est ouvert
    }
}

updateCountdown();

