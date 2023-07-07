<?php
require_once '../config/function.php';

$medias = execute("SELECT * FROM media")->fetchAll(PDO::FETCH_ASSOC);
$comments = execute("SELECT * FROM comment")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    if (empty($_POST['rating_comment'])) {
        $error_rating = 'Ce champ est obligatoire';
    }

    if (empty($_POST['comment_text'])) {
        $error_comment = 'Ce champ est obligatoire';
    }

    if (empty($_POST['publish_date_comment'])) {
        $error_publish_date = 'Ce champ est obligatoire';
    }

    if (empty($_POST['nickname_comment'])) {
        $error_nickname = 'Ce champ est obligatoire';
    }

    if (!isset($error_rating) && !isset($error_comment) && !isset($error_publish_date) && !isset($error_nickname)) {
       // debug($_POST);die;
        if (empty($_POST['id_comment'])) {
            execute("INSERT INTO comment (rating_comment, comment_text, publish_date_comment, nickname_comment, id_media) VALUES (:rating_comment, :comment_text, :publish_date_comment, :nickname_comment, :id_media)", array(
                ':rating_comment' => $_POST['rating_comment'],
                ':comment_text' => $_POST['comment_text'],
                ':publish_date_comment' => $_POST['publish_date_comment'],
                ':nickname_comment' => $_POST['nickname_comment'],
                ':id_media' => $_POST['title_media']
            ));

            $_SESSION['messages']['success'][] = 'Commentaire ajouté';
            header('location: ./comment.php');
            exit();
        } else {
            execute("UPDATE comment SET rating_comment = :rating_comment, comment_text = :comment_text, publish_date_comment = :publish_date_comment, nickname_comment = :nickname_comment, id_media = :id_media WHERE id_comment = :id", array(
                ':id' => $_POST['id_comment'],
                ':rating_comment' => $_POST['rating_comment'],
                ':comment_text' => $_POST['comment_text'],
                ':publish_date_comment' => $_POST['publish_date_comment'],
                ':nickname_comment' => $_POST['nickname_comment'],
                ':id_media' => $_POST['title_media']
            ));

            $_SESSION['messages']['success'][] = 'Commentaire modifié';
            header('location: ./comment.php');
            exit();
        }
    }
}

$comments = execute("SELECT * FROM comment")->fetchAll(PDO::FETCH_ASSOC);
$medias = execute("SELECT * FROM media m INNER JOIN comment c ON m.id_media = c.id_media")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {
    $comments = execute("SELECT * FROM comment WHERE id_comment = :id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM comment WHERE id_comment = :id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Commentaire supprimé';
        header('location: ./comment.php');
        exit;
    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location: ./comment.php');
        exit;
    }
}

require_once '../inc/backheader.inc.php';
?>

<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="rating_comment" class="form-label">Note du commentaire</label>
        <input name="rating_comment" id="rating_comment" placeholder="Note du commentaire" type="number" min="1" max="5" value="<?= $comment['rating_comment'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error_rating ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="comment_text" class="form-label">Texte du commentaire</label>
        <textarea name="comment_text" id="comment_text" placeholder="Texte du commentaire" class="form-control"><?= $comment['comment_text'] ?? ''; ?></textarea>
        <small class="text-danger"><?= $error_comment ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="publish_date_comment" class="form-label">Date de publication du commentaire</label>
        <input name="publish_date_comment" id="publish_date_comment" placeholder="Date de publication du commentaire" type="date" value="<?= $comment['publish_date_comment'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error_publish_date ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="nickname_comment" class="form-label">Pseudo</label>
        <input name="nickname_comment" id="nickname_comment" placeholder="Pseudo" type="text" value="<?= $comment['nickname_comment'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error_nickname ?? ''; ?></small>
    </div>
    <select name="id_media" id="page-select">
    <option value="">--Sélectionnez le média--</option>
    <?php foreach ($medias as $media): ?>
        <option value="<?= $media['id_media']; ?>"><?= $media['title_media']; ?></option>
    <?php endforeach; ?>
    <input type="hidden" name="id_comment" value="<?= $comment['id_comment'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Note du commentaire</th>
            <th>Texte du commentaire</th>
            <th>Date de publication</th>
            <th>Pseudo</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment['rating_comment']; ?></td>
                <td><?= $comment['comment_text']; ?></td>
                <td><?= $comment['publish_date_comment']; ?></td>
                <td><?= $comment['nickname_comment']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $comment['id_comment']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $comment['id_comment']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
