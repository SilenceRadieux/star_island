
<?php require_once '../config/function.php';

if (!empty($_POST)) {

    if (empty($_POST['title_page'])) {
        $error = 'Ce champ est obligatoire';
    }

    if (empty($_POST['url_page'])) {
        $error = 'Ce champ est obligatoire';
    }

    if (!isset($error)) {

        if (empty($_POST['id_page'])) {
            execute("INSERT INTO page (title_page, url_page) VALUES (:title_page, :url_page)", array(
                ':title_page' => $_POST['title_page'],
                ':url_page' => $_POST['url_page']
            ));

            $_SESSION['messages']['success'][] = 'Page ajoutée';
            header('location: ./page.php');
            exit();
        }
        else {
            execute("UPDATE page SET title_page = :title_page, url_page = :url_page WHERE id_page = :id", array(
                ':id' => $_POST['id_page'],
                ':title_page' => $_POST['title_page'],
                ':url_page' => $_POST['url_page']
            ));

            $_SESSION['messages']['success'][] = 'Page modifiée';
            header('location: ./page.php');
            exit();
        }
    }
}
$pages = execute("SELECT * FROM page")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {

    $page = execute("SELECT * FROM page WHERE id_page = :id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM page WHERE id_page = :id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Page supprimée';
        header('location: ./page.php');
        exit;
    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location: ./page.php');
        exit;
    }
}

require_once '../inc/backheader.inc.php';
?>

<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="title_page" class="form-label">Titre de la page</label>
        <input name="title_page" id="title_page" placeholder="Titre de la page" type="text" value="<?= $page['title_page'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="url_page" class="form-label">URL de la page</label>
        <input name="url_page" id="url_page" placeholder="URL de la page" type="text" value="<?= $page['url_page'] ?? ''; ?>" class="form-control">
        <small class="text-danger"><?= $error ?? ''; ?></small>
    </div>
    



    </select>
    <input type="hidden" name="id_page" value="<?= $page['id_page'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Titre de la page</th>
            <th>URL de la page</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td><?= $page['title_page']; ?></td>
                <td><?= $page['url_page']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $page['id_page']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $page['id_page']; ?>&a=del" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
