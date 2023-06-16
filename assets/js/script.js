let actualPage = document.URL;
console.log(actualPage);


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
}
if (actualPage === "http://localhost/star_island_final/serveur.php") {
    document.body.style.backgroundImage = "url('assets/pack_graphique/img-serveur-background.png')";
    document.body.style.backgroundSize = "cover";
    document.body.style.backgroundRepeat = "no-repeat";
}