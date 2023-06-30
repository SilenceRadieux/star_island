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
            ));

            $_SESSION['messages']['success'][] = 'Média ajouté';

        } else {
            execute("UPDATE media SET title_media = :title_media, name_media = :name_media WHERE id_media = :id", array(
                ':id' => $_POST['id_media'],
                ':title_media' => $_POST['title_media'],
                ':name_media' => $_POST['name_media'],
                ':id_media_type' => $_POST['id_media_type']
            ));

            $_SESSION['messages']['success'][] = 'Média modifié';
            header('location: ./media.php');
            exit();
        }
    }
}

$medias = execute("SELECT * FROM media m INNER JOIN media_type mt ON m.id_media_type = mt.id_media_type")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $mediaItem = execute("SELECT * FROM media WHERE id_media = :id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM media WHERE id_media = :id", array(
        ':id' => $_GET['id']
    ));

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

<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="title_media" class="form-label">Titre du média</label>
        <input name="title_media" id="title_media" placeholder="Titre du média" type="text" value="<?= $mediaItem['title_media'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error_title ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="name_media" class="form-label">Nom du média</label>
        <input name="name_media" id="name_media" placeholder="Nom du média" type="text" value="<?= $mediaItem['name_media'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error_name ?? ''; ?></small>
    </div>
    <select name="id_media_type" id="page-select">
    <option value="">--Sélectionnez le type de média--</option>
    <?php foreach ($medias_type as $media_type): ?>
        <option value="<?= $media_type['id_media_type']; ?>"><?= $media_type['title_media_type']; ?></option>
    <?php endforeach; ?>
    <input type="hidden" name="id_media" value="<?= $mediaItem['id_media'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Titre du média</th>
            <th>Nom du média</th>
            <th>Type du média</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($medias as $media) : ?>
            <tr>
                <td><?= $media['title_media']; ?></td>
                <td><?= $media['name_media']; ?></td>
                <td><?= $media['title_media_type']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $media['id_media']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $media['id_media']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
