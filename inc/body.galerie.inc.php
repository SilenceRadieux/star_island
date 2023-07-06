<main>
<?php $medias = execute("SELECT * FROM media m INNER JOIN media_type mt ON m.id_media_type = mt.id_media_type WHERE title_media_type = 'image'" )->fetchAll(PDO::FETCH_ASSOC); ?> 

<div class="glitch-wrapper">
   <div class="glitch" data-text="Star'Island">Star'Island</div>
</div>

<div class="scroll-container">
<div class="grid image-grid">
<?php foreach ($medias as $media) :  ?>
  <div class="grid-block">
    <div class="tile">
      <a class="tile-link" href="#">
        
          <img class="tile-img tile-img1 image-container"  src="./assets/upload/<?= $media['title_media'] ?>">
        
      </a>
    </div>
  </div> <?php endforeach; ?>
</div>
</div>
<div class="lightbox" id="lightbox">
   
    <img src="" alt="Image en grand format" id="lightbox-image">
  </div>
  <div class="background"></div>
</main>
