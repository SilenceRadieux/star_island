
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap/scss/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="assets/js/script.js" defer></script>
</head>
<body>

<header>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=  BASE_PATH; ?>"><img id="logo_starisland" src="./assets/pack_graphique/starisland.png" alt="Logo Star_Island" height=100vh></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul id="navbar_items" class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href=" <?= GALERIE_PATH; ?> ">Galerie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" <?= VIP_PATH; ?> ">Devenir VIP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=" <?= SERVEUR_PATH; ?> ">Serveur</a>
                </li>
                <!-- <?php     if (admin()):           ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ADMIN</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=  BASE_PATH.'back/userList.php'; ?>">Gestion utilisateur</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?=  BASE_PATH.'back/'; ?>">Accès Back-office</a>
                    </div>
                </li>
                <?php     endif;           ?> -->

            </ul>
            <!-- <?php     if (connect()):           ?>
            <a href="<?=  BASE_PATH.'?a=dis'; ?>" class="btn btn-primary">Déconnexion</a>
            <?php     else:           ?>
            <a href="<?=  BASE_PATH.'security/login.php'; ?>" class="btn btn-primary">Connexion</a>
            <a href="<?=  BASE_PATH.'security/register.php'; ?>" class="btn btn-success">Inscription</a>
            <?php        endif;        ?>  -->
                <div id="nav-lateral-item">
                    <li>
                        <img src="./assets/pack_graphique/img-btn-tutoriels.png" alt="bouton tutoriels" height="25px">
                        <a href="#">Tutoriels</a>
                    </li>
                    <li>
                        <img src="./assets/pack_graphique/img-btn-event.png" alt="bouton event" height="25px">
                        <a href="#">Event</a>
                    </li>
                </div> 
        </div>
    </div>
</nav>


</header>
