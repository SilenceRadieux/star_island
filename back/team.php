<?php
require_once '../config/function.php';

$team_medias = execute("SELECT * FROM team_media")->fetchAll(PDO::FETCH_ASSOC);
$medias = execute("SELECT * FROM media m INNER JOIN media_type mt ON m.id_media_type = mt.id_media_type")->fetchAll(PDO::FETCH_ASSOC);
$teams = execute("SELECT * FROM team")->fetchAll(PDO::FETCH_ASSOC);
$page = execute("SELECT * FROM `page` WHERE 'title_page'='team'")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
   // var_dump($_POST); die;
    if (empty($_POST['role_team'])) {
        $error = 'Ce champ est obligatoire';
    }

    if (!isset($error)) {

        if (empty($_POST['id_team'])) {

           $lastIdTeam= execute("INSERT INTO team ( role_team, nickname_team) VALUES (:role_team, :nickname_team)", array(
                ':role_team' => $_POST['role_team'],
                ':nickname_team' => $_POST['nickname_team'],
            ), 'toto');

        
            if(!empty($_FILES['avatar']['name'])){
                $picture=date_format(new DateTime(), 'YmdHis').'-'.$_FILES['avatar']['name'];
                copy($_FILES['avatar']['tmp_name'], '../assets/upload/'.$picture);

            }else{


            }
   //   faire requête pour recup id avec type image dans media_type
   //   faire requête pour recup id avec page team dans page
           $lastAvatarId= execute("INSERT INTO media (title_media, name_media, id_media_type, id_page) VALUES (:title_media, :name_media, :id_media_type, :id_page)", array(
                ':title_media'=>$picture,
               ':name_media'=>$_POST['nickname_team'] ,
              ':id_media_type'=> 26, 
              ':id_page'=>12
              
            ), 'toto');

            execute("INSERT INTO team_media (id_media, id_team) VALUES (:id_media, :id_team)", array(
                ':id_media' => $lastAvatarId,
                ':id_team' => $lastIdTeam
            ));


   //   faire requête pour recup id avec type lien dans media_type
            foreach($_POST['social_media'] as $name=>$link){
                if(!empty($link)){
                    $lastLinkId =execute("INSERT INTO media (title_media, name_media, id_media_type, id_page) VALUES (:title_media, :name_media, :id_media_type, :id_page)", array(
                    ':title_media'=>$link,
                    ':name_media'=>$name.'-'.$_POST['nickname_team'] ,
                    ':id_media_type'=> 28, 
                    ':id_page'=>12), 'toto');

                execute("INSERT INTO team_media (id_media, id_team) VALUES (:id_media, :id_team)", array(
                    ':id_media' => $lastLinkId,
                    ':id_team' => $lastIdTeam
                ));


                 } }

    

            $_SESSION['messages']['success'][] = 'Équipe ajoutée';
            header('location: ./team.php');
            exit();

        } else {
            execute("UPDATE team SET role_team=:role_team, nickname_team=:nickname_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':role_team' => $_POST['role_team'],
                ':nickname_team' => $_POST['nickname_team'],
            ));
            execute("UPDATE team_media SET id_media=:id_media, id_team=:id_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':id_media' => $_POST['id_media'],
                ':id_team' => $_POST['id_team'],
            ));

            $_SESSION['messages']['success'][] = 'Équipe modifiée';
            header('location: ./team.php');
            exit();
        }
    }
}

$teams = execute("SELECT * FROM team")->fetchAll(PDO::FETCH_ASSOC);


// $teams = execute("SELECT t.*, m.*, mt.* FROM media_type mt INNER JOIN media m ON mt.id_media_type = m.id_media_type INNER JOIN team_media tm ON tm.id_media = m.id_media INNER JOIN team t ON tm.id_team = t.id_team")
//     ->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {
    $team = execute("SELECT * FROM team WHERE id_team=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM team WHERE id_team=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Équipe supprimée';
        header('location: ./team.php');
        exit;
    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réessayer';
        header('location: ./team.php');
        exit;
    }
}

require_once '../inc/backheader.inc.php';
?>

<form action="" enctype="multipart/form-data" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="role_team" class="form-label">Rôle du membre de l'équipe</label>
        <select name="role_team" id="role_team"> 
            <option value="Admin">Admin</option>
            <option value="Staff/Modérateur">Staff/Modérateur</option>
            <option value="Développeur">Développeur</option>
            <option value="Mapper">Mapper</option>
            <option value="Helper">Helper</option>
        </select>
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="nickname_team" class="form-label">Pseudo du membre de l'équipe</label>
        <input name="nickname_team" id="nickname_team" placeholder="Pseudo du membre de l'équipe" type="text"
               value="<?= $team['nickname_team'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    <div class="form-group" >
        <small class="text-danger">*</small>
        <label for="avatar" class="form-label">Avatar du membre de l'équipe</label><br>
        <input name="avatar" id="avatar"  type="file"
              >
    
    </div>
    <!-- <div class="form-group">
    
    <select name="id_media" id="id_media">
    <option value="" disabled selected>--Sélectionnez l'avatar--</option>
    <?php foreach ($medias as $media): ?> 
        <?php if ($media['title_media_type'] == 'image'):  ?>
            <option value="<?= $media['id_media']; ?>"><?= $media['title_media']; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
    </div> -->
    <div class="form-group">
        <label for="social_media" class="form-label">Réseaux sociaux</label>
          <!--   <select name="social_media" id="social_media">
                <option value="" disabled selected multiple>--Déjà enregistré ?--</option>
                <?php foreach ($medias as $media): ?>
                     <?php if ($media['title_media_type'] == 'lien'): ?>
                        <option value="<?= $media['id_media']; ?>"><?= $media['name_media']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select> -->
        <div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_facebook"  value="facebook">
                <label class="form-check-label" for="checkbox_facebook">Facebook</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['facebook']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_twitter checked" value="twitter">
                <label class="form-check-label" for="checkbox_twitter">Twitter</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['twitter']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_instagram" value="instagram">
                <label class="form-check-label" for="checkbox_instagram">Instagram</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['instagram']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_twitch" value="twitch">
                <label class="form-check-label" for="checkbox_twitch">Twitch</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['twitch']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_youtube" value="youtube">
                <label class="form-check-label" for="checkbox_youtube">Youtube</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['youtube']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_discord" value="discord">
                <label class="form-check-label" for="checkbox_discord">Discord</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['discord']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_linkedin" value="linkedin">
                <label class="form-check-label" for="checkbox_linkedin">Linkedin</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['linkedin']">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkbox_autres_réseaux" value="autres_réseaux">
                <label class="form-check-label" for="checkbox_autres_réseaux">Autres réseaux</label>
                <input class=" mediaLink" type="text" style="display: none;" placeholder="URL.." name="social_media['autre']">
            </div>
        </div>
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    <input type="hidden" name="id_team" value="<?= $team['id_team'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
    <tr>
        <th>Rôle</th>
        <th>Surnom</th>
        <th>Avatar</th>
        <th>Réseaux sociaux</th>
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($teams as $team):
    $medias = execute("SELECT  m.*, mt.* FROM media_type mt INNER JOIN media m ON mt.id_media_type = m.id_media_type INNER JOIN team_media tm ON tm.id_media = m.id_media INNER JOIN team t ON tm.id_team = t.id_team WHERE t.id_team = :id", array(
        ':id' => $team['id_team']
    ))->fetchAll(PDO::FETCH_ASSOC);
?>
    <tr>
        <td><?= $team['role_team']; ?></td>
        <td><?= $team['nickname_team']; ?></td>
        <td>
            <?php foreach ($medias as $media): ?>
                <?php if ($media['title_media_type'] == 'image'): ?>
                    <img src="../assets/upload/<?= $media['title_media']; ?>" width="100px" height="100px">
                <?php endif; ?>
            <?php endforeach; ?>
        </td>
        <td>
            <?php foreach ($medias as $media): ?>
                <?php if ($media['title_media_type'] == 'lien' && !empty($media['title_media'])): ?>
                    <a href="<?= $media['title_media']; ?>" target="_blank"><?= $media['name_media']; ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </td>
        <td class="text-center">
            <a href="?id=<?= $team['id_team']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
            <a href="?id=<?= $team['id_team']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-outline-danger">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>

        var checkBoxs = document.querySelectorAll(".form-check-input");
        checkBoxs.forEach(checkBox => {
            checkBox.addEventListener("change", () => {
                console.log(checkBox.checked);
                if (checkBox.checked) {
                    checkBox.parentNode.querySelector('.mediaLink').style.display = "block";
                } else {
                    checkBox.parentNode.querySelector('.mediaLink').style.display = "none";
                }
                }
        );});
    
</script>
    
<?php require_once '../inc/backfooter.inc.php'; ?>
