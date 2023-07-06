<main id="main-event">

  <?php $teams = execute("SELECT * FROM team t INNER JOIN team_media tm ON t.id_team = tm.id_team INNER JOIN media m ON tm.id_media = m.id_media INNER JOIN media_type mt ON m.id_media_type = mt.id_media_type")->fetchAll(PDO::FETCH_ASSOC); ?>


  <div class="page-section" id="About">
    <div class="about-pos">
      <div class="section-title">
        <div class="glitch-wrapper">
          <div class="glitch" data-text="L'équipe">L'équipe</div>
        </div>
      </div>
      <div class="ios-segmented-control" id="responsive-ios-segmented-control">
        <span class="selection"></span>
        <div class="option">
          <input type="radio" id="tous" name="sample" value="tous" checked>
          <label for="tous"><span>Tous</span></label>
        </div>
        <div class="option">
          <input type="radio" id="admin" name="sample" value="Admin">
          <label for="admin"><span>Admin</span></label>
        </div>
        <div class="option">
          <input type="radio" id="modo" name="sample" value="Staff/Modérateur">
          <label for="modo"><span>Staff/Modérateur</span></label>
        </div>
        <div class="option">
          <input type="radio" id="dev" name="sample" value="Développeur">
          <label for="dev"><span>Développeur</span></label>
        </div>
        <div class="option">
          <input type="radio" id="mapper" name="sample" value="Mapper">
          <label for="mapper"><span>Mapper</span></label>
        </div>
        <div class="option">
          <input type="radio" id="helper" name="sample" value="Helper">
          <label for="helper"><span>Helper</span></label>
        </div>
      </div>

    </div>
  </div>

  <div class="wrapper" id="responsive-wrapper">
    <div class="gallery">
      <ul>
        <?php foreach ($teams as $team) {; ?>
          <li class="tous <?= $team['role_team'] ?>">
            <p> <?php echo $team['nickname_team']; ?> </p>
            <p> <?php echo $team['role_team']; ?> </p>       
            <?php if ($team['title_media_type'] == 'lien' && !empty($team['title_media'])): ?>
              <a href="<?= $team['title_media']; ?>" target="_blank"><?= $team['name_media']; ?></a>
            <?php elseif ($team['title_media_type'] == 'image'): ?>
              <img src="./assets/upload/<?= $team['title_media'] ?>"> 
            <?php endif; ?>
          </li>
        <?php } ?>
      </ul>
    </div>

    <style>
      /* Reset default styles */
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      /* Global styles */
      body {
        font-family: 'Iceland';
        line-height: 1.5;
      }

      /* Page section */
      .page-section {
        padding: 40px;
      }

      /* Section title */
      .section-title {
        text-align: center;
        margin-bottom: 20px;
      }

      .section-title h2 {
        font-size: 60px;
        margin-top: 0;
        margin-bottom: 40px;
        font-weight: bold;
        color: #333;
      }

      .line {
        width: 60px;
        height: 2px;
        margin: 10px auto;
        background-color: #333;
      }

      /* Radio button styles */
      .ios-segmented-control {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
      }

      .option {
        margin: 0 10px;
      }

      .option input[type="radio"] {
        display: none;
      }

      .option label {
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 4px;
        background-color: white;
      }

      .option label:hover {
        background-color: #ddd;
      }

      .option input[type="radio"]:checked+label {
        background-color: #333;
        color: #fff;
      }
    </style>
</main>