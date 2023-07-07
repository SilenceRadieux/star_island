<?php
require_once '../config/function.php';

$medias_type = execute("SELECT * FROM media_type")->fetchAll(PDO::FETCH_ASSOC);
$pages = execute("SELECT * FROM page")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {

    if (empty($_POST['title_media'])) {
        $error_title = 'Ce champ est obligatoire';
    }

    if (empty($_POST['name_media'])) {
        $error_name = 'Ce champ est obligatoire';
    }

    if (!isset($error_title) && !isset($error_name)) {

        if (empty($_POST['id_media'])) {
            execute("INSERT INTO media (title_media, name_media, id_media_type) VALUES (:title_media, :name_media, :id_media_type)", array(
                ':title_media' => $_POST['title_media'],
                ':name_media' => $_POST['name_media'],
                ':id_media_type' => $_POST['id_media_type']
            )
            );
            upload($_FILES);
            $_SESSION['messages']['success'][] = 'Média ajouté';
            header('location: ./media.php');
        } else {
            execute("UPDATE media SET title_media = :title_media, name_media = :name_media, id_media_type = :id_media_type WHERE id_media = :id", array(
                ':id' => $_POST['id_media'],
                ':title_media' => $_POST['title_media'],
                ':name_media' => $_POST['name_media'],
                ':id_media_type' => $_POST['id_media_type']
            )
            );
            upload($_FILES);
            $_SESSION['messages']['success'][] = 'Média modifié';
            header('location: ./media.php');
            exit();
        }
    }
}
function upload($files)
{
    if (!empty($files['file_media']['name'])) {
        $media = $files['file_media']['tmp_name'];
        $media_type = '../assets/upload/' . $files['file_media']['name'];
        if (copy($media, $media_type)) {
            echo '<small class="text-success">Fichier copié</small>';
        } else {
            echo '<small class="text-danger">Fichier non copié</small>';
        }
    }

}



$medias = execute("SELECT * FROM media m INNER JOIN media_type mt ON m.id_media_type = mt.id_media_type")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {
    $mediaItem = execute("select * FROM media WHERE id_media = :id", array(
        ':id' => $_GET['id']
    )
    )->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM media WHERE id_media = :id", array(
        ':id' => $_GET['id']
    )
    );

    if ($success) {
        $_SESSION['messages']['success'][] = 'Média supprimé';
        header('location: ./media.php');
        exit;
    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location: ./media.php');
        exit;
    }
}

require_once '../inc/backheader.inc.php';
?>

<form action="" method="post" enctype="multipart/form-data" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="title_media" class="form-label">Titre du média</label>
        <input name="title_media" id="title_media" placeholder="Titre du média" type="text"
            value="<?= $mediaItem['title_media'] ?? ''; ?>" class="form-control">
        <small class="text-danger">
            <?= $error_title ?? ''; ?>
        </small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="name_media" class="form-label">Nom du média</label>
        <input name="name_media" id="name_media" placeholder="Nom du média" type="text"
            value="<?= $mediaItem['name_media'] ?? ''; ?>" class="form-control">
        <small class="text-danger">
            <?= $error_name ?? ''; ?>
        </small>
    </div>
    <div class="form-group">
        <select name="id_media_type" id="id_media_type">
            <option value="" disabled selected>--Sélectionnez le type de média--</option>
            <?php foreach ($medias_type as $media_type): ?>
                <option value="<?= $media_type['id_media_type']; ?>"><?= $media_type['title_media_type']; ?></option>
            <?php endforeach; ?>
        </select>
        <script>
            document.getElementById('id_media_type').onchange = function () {
                var selectedValue = this.options[this.selectedIndex].text;
                var linkInput = document.getElementById('link_input');
                var fileMedia = document.getElementById('file_media');
                var titleMedia = document.getElementById('id_media_type');
                var title = titleMedia.title;
                if (selectedValue === 'lien') {
                    linkInput.style.display = 'block';
                    fileMedia.style.display = 'none';
                } else {
                    linkInput.style.display = 'none';
                    fileMedia.style.display = 'block';
                }
            };
        </script>
    </div>
    <div class="form-group">
        <label for="file_media" class="form-label"></label>
        <input type="file" name="file_media" id="file_media" class="form-control-file" style=display:none>
        <input type="text" name="link_media" id="link_input" class="form-control" style=display:none>
    </div>
    <input type="hidden" name="id_media" value="<?= $mediaItem['id_media'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>


<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Titre du média</th>
            <th>Nom du média</th>
            <th>Type du média</th>
            <th>Aperçu</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($medias as $media): ?>
            <tr>
                <td>
                    <?= $media['title_media']; ?>
                </td>
                <td>
                    <?= $media['name_media']; ?>
                </td>
                <td>
                    <?= $media['title_media_type']; ?>
                </td>
                <td>
                    <?php if ($media['title_media_type'] == 'image'): ?>
                        <img src="../assets/upload/<?= $media['title_media']; ?>" width="150px">
                    <?php elseif ($media['title_media_type'] == 'lien'): ?>
                        <a href="<?= $media['title_media']; ?>" target="_blank"><?= $media['name_media']; ?></a>
                    <?php endif; ?>
                </td>
                <td class="text-center">
                    <a href="?id=<?= $media['id_media']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $media['id_media']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')"
                        class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>