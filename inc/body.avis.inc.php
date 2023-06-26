<main>

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

    .star {
      font-size: 24px;
      color: #ccc;
      cursor: pointer;
      transition: color 0.2s;
    }

    .star:hover,
    .star.selected {
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
        align-items: center;
      width: 80vw;
    }

    #comments p {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<div id="responsive-comments">
<div id="comments">
    <h2>Les derniers avis laissés par la communauté !</h2>
    <?php
      // Replace with your logic to fetch and display the latest comments from a database or file
      $latestComments = array();

      foreach ($latestComments as $comment) {
        echo "<p>" . htmlspecialchars($comment) . "</p>";
      }
    ?>
  </div>
</div>


  <h2 id="responsive-title-avis">Donnez-nous votre avis !</h2>
  <div id="reponsive-form">
  <div class="rating-container">
    <span class="star" onclick="rate(1)">★</span>
    <span class="star" onclick="rate(2)">★</span>
    <span class="star" onclick="rate(3)">★</span>
    <span class="star" onclick="rate(4)">★</span>
    <span class="star" onclick="rate(5)">★</span>
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