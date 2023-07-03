<main>

<?php $comments = execute("SELECT * FROM comment ORDER BY publish_date_comment DESC")->fetchAll(PDO::FETCH_ASSOC);?>

<head>
  <title>Rating Form</title>
  <style>

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

    }

h2 {
    font-family: 'Iceland';
    font-size: 40px;
}

    .rating-container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stars {
      font-size: 24px;
      color: #ccc;
      cursor: pointer;
      transition: color 0.2s;
    }

    .stars:hover,
    .stars.selected {
      color: #ffcc00;
    }

    textarea {
      display: flex;
      margin-left: 30px;
    }

    input {
      display: flex;
      margin-left: 80px;
    }

    #comments {
        display: flex;
        flex-direction: column;
      width: 50vw;
      margin-left: 100px;
    }


    #rating_avatar {
  display: flex;
  justify-content: start  ;
  align-items: flex-start;
}

#rating_avatar p {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  justify-content: start;
  align-items: flex-start;
  margin-right: 10px;
}

    .star {
    display: inline-block;
    width: 16px;
    height: 16px;
    margin-right: 2px;
    clip-path: polygon(
      50% 0%,
      61% 35%,
      98% 35%,
      68% 57%,
      79% 91%,
      50% 70%,
      21% 91%,
      32% 57%,
      2% 35%,
      39% 35%
    );
  }

  /* Yellow stars */
  .yellow-star {
    background-color: yellow;
  }

  #rating_pseudo {
    font-weight: bold;
  }

  #rating_date {
    font-size: 12px;
    font-style: italic;
  }
  </style>
</head>
<body>
<div id="responsive-comments">
<div id="comments" class="scroll-container">
    <h2>Les derniers avis laissés par la communauté !</h2>
    <?php
      $direction = true;
      foreach ($comments as $comment) { ?>
      <?php 
      if ($direction) {
        $direction = false;
        $choix ='droite';
      } else {
        $direction = true;
        $choix ='gauche';
      }
      ?>
      <div id="rating_avatar">
        <p><?= $comment['id_media'] ?></p>
      </div>
      <div class="latestComments <?= $choix ?>">
      <div id="rating_stars">
      <?php
    $rating = $comment['rating_comment']; 
    for ($i = 0; $i < $rating; $i++) {
      echo '<span class="star yellow-star"></span>';
    }
  ?>
      </div>
      <div id="rating_pseudo">
       <p><?= $comment['nickname_comment'] ?></p>
      </div>
      <div id="rating_text">
       <p><?= $comment['comment_text'] ?></p>
      </div>
      <div id="rating_date">
       <p><?= $comment['publish_date_comment'] ?></p>
      </div>
    </div>
     <?php } ?>
  </div>
</div>


  <h2 id="responsive-title-avis">Donnez-nous votre avis !</h2>
  <div id="reponsive-form">
  <div class="rating-container">
    <span class="stars" onclick="rate(1)">★</span>
    <span class="stars" onclick="rate(2)">★</span>
    <span class="stars" onclick="rate(3)">★</span>
    <span class="stars" onclick="rate(4)">★</span>
    <span class="stars" onclick="rate(5)">★</span>
  </div>

  <form action="process.php" method="POST" class="comment-section" id="responsive-comment">
    <textarea name="comment" rows="4" cols="40" id="responsive-textarea" required placeholder="Vous appréciez notre serveur ? Faites le nous savoir !"></textarea>
    <br>
    <input id="responsive-input" type="submit" value="Ajouter ma pierre à l'édifice">
  </form>
</div>



  <script>
    function rate(stars) {
      const ratingContainer = document.querySelector(".rating-container");
      const starsList = ratingContainer.querySelectorAll(".star");

      for (let i = 0; i < starsList.length; i++) {
        if (i < stars) {
          starsList[i].classList.add("selected");
        } else {
          starsList[i].classList.remove("selected");
        }
      }
    }
  </script>
</body>

</main>