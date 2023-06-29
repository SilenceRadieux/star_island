<?php
require_once '../config/function.php';

if (!empty($_POST)) {

    if (empty($_POST['title_media'])) {
        $error_title = 'Ce champ est obligatoire';
    }

    if (empty($_POST['name_media'])) {
        $error_name = 'Ce champ est obligatoire';
    }

    if (!isset($error_title) && !isset($error_name)) {

        if (empty($_POST['id_media'])) {
            execute("INSERT INTO media (title_media, name_media) VALUES (:title_media, :name_media)", array(
                ':title_media' => $_POST['title_media'],
                ':name_media' => $_POST['name_media']
            ));

            $_SESSION['messages']['success'][] = 'Média ajouté';
            header('location: ./media.php');
            exit();
        } else {
            execute("UPDATE media SET title_media = :title_media, name_media = :name_media WHERE id_media = :id", array(
                ':id' => $_POST['id_media'],
                ':title_media' => $_POST['title_media'],
                ':name_media' => $_POST['name_media']
            ));

            $_SESSION['messages']['success'][] = 'Média modifié';
            header('location: ./media.php');
            exit();
        }
    }
}

$media = execute("SELECT * FROM media")->fetchAll(PDO::FETCH_ASSOC);

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
    <input type="hidden" name="id_media" value="<?= $mediaItem['id_media'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Titre du média</th>
            <th>Nom du média</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($media as $mediaItem) : ?>
            <tr>
                <td><?= $mediaItem['title_media']; ?></td>
                <td><?= $mediaItem['name_media']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $mediaItem['id_media']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $mediaItem['id_media']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
