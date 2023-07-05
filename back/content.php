<?php require_once '../config/function.php';

$pages=execute("SELECT * FROM page")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_POST)) {

    if (empty($_POST['title_content'])) {
        $error_title = 'Ce champ est obligatoire';
    }

    if (empty($_POST['description_content'])) {
        $error_description = 'Ce champ est obligatoire';
    }

    if (!isset($error_title) && !isset($error_description)) {

        if (empty($_POST['id_content'])) {
            execute("INSERT INTO content (title_content, description_content, id_page) VALUES (:title_content, :description_content, :id_page)", array(
                ':title_content' => $_POST['title_content'],
                ':description_content' => $_POST['description_content'],
                ':id_page' => $_POST['id_page']
            ));

            $_SESSION['messages']['success'][] = 'Contenu ajouté';
            header('location: ./content.php');
            exit();
        }
        else {
            execute("UPDATE content SET id_page = :id_page, title_content = :title_content, description_content = :description_content WHERE id_content = :id", array(
                ':id' => $_POST['id_content'],
                ':title_content' => $_POST['title_content'],
                ':description_content' => $_POST['description_content'],
                ':id_page' => $_POST['id_page']
            ));

            $_SESSION['messages']['success'][] = 'Contenu modifié';
            header('location: ./content.php');
            exit();
        }
    }
}
$contents = execute("SELECT * FROM content c INNER JOIN page p ON c.id_page = p.id_page")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $content = execute("SELECT * FROM content WHERE id_content = :id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM content WHERE id_content = :id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Contenu supprimé';
        header('location: ./content.php');
        exit;
    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location: ./content.php');
        exit;
    }
}

require_once '../inc/backheader.inc.php';
?>

<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="title_content" class="form-label">Titre du contenu</label>
        <input name="title_content" id="title_content" placeholder="Titre du contenu" type="text" value="<?= $content['title_content'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error_title ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="description_content" class="form-label">Description du contenu</label>
        <textarea name="description_content" id="description_content" placeholder="Description du contenu" class="form-control"><?= $content['description_content'] ?? ''; ?></textarea>
        <small class="text-danger"><?= $error_description ?? ''; ?></small>
    </div>
    <select name="id_page" id="page-select">
    <option value="" disabled selected>--Sélectionnez la page souhaitée--</option>
    <?php foreach ($pages as $page): ?>
        <option value="<?= $page['id_page']; ?>"><?= $page['title_page']; ?></option>
    <?php endforeach; ?>
    <input type="hidden" name="id_content" value="<?= $content['id_content'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Titre du contenu</th>
            <th>Description du contenu</th>
            <th>Page</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contents as $content): ?>
            <tr>
            
                <td><?= $content['title_content']; ?></td>
                <td><?= $content['description_content']; ?></td>
                <td><?= $content['title_page']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $content['id_content']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $content['id_content']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
