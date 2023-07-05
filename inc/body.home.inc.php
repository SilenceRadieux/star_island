<main id="main_home " data-bs-dismiss="offcanvas">

<?php $contents = execute("SELECT * FROM content")->fetchAll(PDO::FETCH_ASSOC); ?>

<div class="glitch-wrapper">
   <div class="glitch" data-text="Star'Island">Star'Island</div>
</div>
    <div class="button-container">
                <button onclick="window.location.href='avis.php';" id="btn-second-page" class="button">Donnez-nous votre avis !</button>
            </div>
    <div id="full-carousel">
  <input id="acc_gal_btn" class="radio-btn" type="radio" name="position" checked />
  <input id="acc_gal_btn" class="radio-btn" type="radio" name="position" />
  <input id="acc_gal_btn" class="radio-btn" type="radio" name="position" />
  <main id="carousel">
    <div id="presentation_paragraph" class="item" >
    <?php foreach ($contents as $content) { ?>  
      <p><?= $content['description_content'] ?></p>
    <?php } ?>
    </div>
    <div class="item">
    <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
    <div class="container">
  <div class="carousel">
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
    <div class="carousel__face"><span></span></div>
  </div>
</div>



</main>