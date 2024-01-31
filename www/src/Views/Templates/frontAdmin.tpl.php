<?php $json = file_get_contents(__DIR__ . '/../Main/home.json');
$data = json_decode($json, true); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($data['site-name'])?> - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/css/style.css">
    <link rel="icon" href="/assets/images/<?php echo htmlspecialchars($data['site-favicon'])?>">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bodyAdmin">

    <header>
        <nav class="nav_admin">
            <ul>
                <div class="adminMenu-msg"><a href="/"><?php echo htmlspecialchars($data['site-name'])?></a></div>
                <li><a href="dashboard"><i class="fa-solid fa-store"></i> Tableau de bord</a></li>
                <li><a href="pages"><i class="fa-regular fa-file-lines"></i> Pages</a></li>
                <li><a href="products"><i class="fa-solid fa-bag-shopping"></i> Produits</a></li>
                <hr>
                <li><a href="settings"><i class="fa-solid fa-gear"></i> Paramètres</a></li>
            </ul>
        </nav>

        <div class="navAdmin">
            <ul>
                <li><a href="notifications"><i class="fas fa-bell"></i></a></li>
                <li><a>Calvelo Nicolas</a></li>
                <li><a href="profile"><i class="fa-regular fa-user"></i></a></li>
                <button id="toggle-dark-mode"><i class="fas fa-sun"></i></button>
            </ul>
            <hr>
        </div>


    </header>
    <main class="mainAdmin">
        <?php include $this->view; ?>
    </main>

</body>
<script src="../assets/js/components/navbar.js"></script>
<script src="../assets/js/components/darkmode.js"></script>
</html>