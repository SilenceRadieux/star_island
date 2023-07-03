<?php
require_once '../config/function.php';

$medias = execute("SELECT * FROM media")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {
    if (empty($_POST['role_team'])) {
        $error = 'Ce champ est obligatoire';
    }

    if (!isset($error)) {
        if (empty($_POST['id_team'])) {
            execute("INSERT INTO team (role_team, nickname_team) VALUES (:role_team, :nickname_team)", array(
                ':role_team' => $_POST['role_team'],
                ':nickname_team' => $_POST['nickname_team'],
                ':id_media' => 14
            ));

            $_SESSION['messages']['success'][] = 'Équipe ajoutée';
            header('location: ./team.php');
            exit();
        } else {
            execute("UPDATE team SET role_team=:role_team, nickname_team=:nickname_team WHERE id_team=:id", array(
                ':id' => $_POST['id_team'],
                ':role_team' => $_POST['role_team'],
                ':nickname_team' => $_POST['nickname_team'],
                ':id_media' => 14
            ));

            $_SESSION['messages']['success'][] = 'Équipe modifiée';
            header('location: ./team.php');
            exit();
        }
    }
}

$teams = execute("SELECT t.*, m.* FROM media m INNER JOIN team_media tm ON tm.id_media = m.id_media INNER JOIN team t ON tm.id_team = t.id_team")
    ->fetchAll(PDO::FETCH_ASSOC);

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

<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="role_team" class="form-label">Rôle du membre de l'équipe</label>
        <input name="role_team" id="role_team" placeholder="Rôle du membre de l'équipe" type="text"
               value="<?= $team['role_team'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="nickname_team" class="form-label">Pseudo du membre de l'équipe</label>
        <input name="nickname_team" id="nickname_team" placeholder="Pseudo du membre de l'équipe" type="text"
               value="<?= $team['nickname_team'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    <div class="form-group">
    <small class="text-danger">*</small>
    <label for="avatar" class="form-label">Avatar du membre de l'équipe</label>
    <input name="avatar" id="avatar" type="file" class="form-control" value="<?= $team['id_team_media'] ?? ''; ?>" > 
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
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($teams as $team): ?>
        <tr>
            <td><?= $team['role_team']; ?></td>
            <td><?= $team['nickname_team']; ?></td>
            <td><?= $team['id_team_media']; ?></td>
            <td class="text-center">
                <a href="?id=<?= $team['id_team']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                <a href="?id=<?= $team['id_team']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')"
                   class="btn btn-outline-danger">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
