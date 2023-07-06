<main id="main_vip">

<?php $page = execute("SELECT * FROM `page` WHERE title_page = 'Vip'")->fetch(PDO::FETCH_ASSOC); 
?>
<?php $contents = execute("SELECT * FROM content ")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php
$contentsArray;
foreach ($contents as $content) { 
    if ($content['id_page'] == $page['id_page']) {
        $contentsArray[$content['title_content']] = $content; 
    }
} ?>

<section >
<div class="glitch-wrapper">
   <div class="glitch" data-text="Devenir VIP">Devenir VIP</div>
</div>
<div id="vip_text">
    <h2><a href="https://discord.gg/YtHr3hZTc5" target="_blank"><?= $contentsArray["Devenir VIP"]["title_content"] ?></a></h2>
    <?= $contentsArray["Devenir VIP"]["description_content"] ?>
    <h2><a href="https://discord.gg/YtHr3hZTc5" target="_blank"><?= $contentsArray["Devenir VIP +"]["title_content"] ?></a></h2>
    <?= $contentsArray["Devenir VIP +"]["description_content"] ?>
</div>
<div id="vip_left_img"></div>
<div id="vip_right_img"></div>

</section>

</main>