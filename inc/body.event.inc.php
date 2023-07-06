<main>



<?php $page = execute("SELECT * FROM `page` WHERE title_page = 'Event'")->fetch(PDO::FETCH_ASSOC); 
?>
<?php $contents = execute("SELECT * FROM content ")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php $events = execute("SELECT * FROM `event`")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php
$contentsArray;
foreach ($contents as $content) { 
    if ($content['id_page'] == $page['id_page']) {
        $contentsArray[$content['title_content']] = $content; 
    }
} ?>



<div id="img-event">

<img src="./assets/pack_graphique/star_islannd/helicopter.png" alt="image de l'event en cours" style="width: 50%; height: 50%;">

</div>

<div id="countdown">
<div class="glitch-wrapper">
   <div class="glitch" data-text="Temps restant">Temps restant</div>
</div>
    <div id="timer">
      <span id="days"></span>
      <span id="hours"></span>
      <span id="minutes"></span>
      <span id="seconds"></span>
    </div>
  </div>

  <div id="presentation_event">
  <div class="glitch-wrapper">
   <div class="glitch" data-text="Event">Event</div>
</div>
    <p id="presentation-event-paragraphe">
      <?= $contentsArray["Présentation event"]["description_content"] ?>
    </p>
  </div>

<script defer>
  const countdownDate = new Date("<?php echo $events[0]['end_date_event']; ?>").getTime();
  
const countdownTimer = setInterval(function() {
  const now = new Date().getTime();
  const distance = countdownDate - now;

  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("days").textContent = padNumber(days) + "j";
  document.getElementById("hours").textContent = padNumber(hours) + "h";
  document.getElementById("minutes").textContent = padNumber(minutes) + "m";
  document.getElementById("seconds").textContent = padNumber(seconds) + "s";

  if (distance < 0) {
    clearInterval(countdownTimer);
    document.getElementById("countdown").innerHTML = "<h1>L'évènement est terminé !</h1>";
  }
}, 1000);

</script>

</main>