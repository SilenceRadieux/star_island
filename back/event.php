<?php
require_once '../config/function.php';

if (!empty($_POST)) {
    if (empty($_POST['start_date_event']) || empty($_POST['end_date_event'])) {
        $error = 'Les champs de date sont obligatoires';
    }

    if (!isset($error)) {
        if (empty($_POST['id_event'])) {
            execute("INSERT INTO event (start_date_event, end_date_event) VALUES (:start_date, :end_date)", array(
                ':start_date' => $_POST['start_date_event'],
                ':end_date' => $_POST['end_date_event']
            ));

            $_SESSION['messages']['success'][] = 'Événement ajouté';
            header('location:./event.php');
            exit();
        } else {
            execute("UPDATE event SET start_date_event=:start_date, end_date_event=:end_date WHERE id_event=:id", array(
                ':start_date' => $_POST['start_date_event'],
                ':end_date' => $_POST['end_date_event'],
                ':id' => $_POST['id_event']
            ));

            $_SESSION['messages']['success'][] = 'Événement modifié';
            header('location:./event.php');
            exit();
        }
    }
}

$events = execute("SELECT * FROM `event`")->fetchAll(PDO::FETCH_ASSOC);

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'edit') {
    $events = execute("SELECT * FROM event WHERE id_event=:id", array(
        ':id' => $_GET['id']
    ))->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
    $success = execute("DELETE FROM event WHERE id_event=:id", array(
        ':id' => $_GET['id']
    ));

    if ($success) {
        $_SESSION['messages']['success'][] = 'Événement supprimé';
        header('location:./event.php');
        exit;
    } else {
        $_SESSION['messages']['danger'][] = 'Problème de traitement, veuillez réitérer';
        header('location:./event.php');
        exit;
    }
}

require_once '../inc/backheader.inc.php';
?>

<form action="" method="post" class="w-75 mx-auto mt-5 mb-5">
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="start_date_event" class="form-label">Date de début de l'événement</label>
        <input name="start_date_event" id="start_date_event" type="date" value="<?= $event['start_date_event'] ?? ''; ?>" class="form-control">
    </div>
    <div class="form-group">
        <small class="text-danger">*</small>
        <label for="end_date_event" class="form-label">Date de fin de l'événement</label>
        <input name="end_date_event" id="end_date_event" type="date" value="<?= $event['end_date_event'] ?? ''; ?>" class="form-control">
    </div>
    <input type="hidden" name="id_event" value="<?= $event['id_event'] ?? ''; ?>">
    <button type="submit" class="btn btn-primary mt-2">Valider</button>
</form>

<table class="table table-dark table-striped w-75 mx-auto">
    <thead>
        <tr>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?= $event['start_date_event']; ?></td>
                <td><?= $event['end_date_event']; ?></td>
                <td class="text-center">
                    <a href="?id=<?= $event['id_event']; ?>&a=edit" class="btn btn-outline-info">Modifier</a>
                    <a href="?id=<?= $event['id_event']; ?>&a=del" onclick="return confirm('Êtes-vous sûr?')" class="btn btn-outline-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../inc/backfooter.inc.php'; ?>
