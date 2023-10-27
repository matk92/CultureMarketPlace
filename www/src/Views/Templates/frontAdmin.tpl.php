<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Front</title>
    <link rel="stylesheet" href="assets/css/styleAdmin.css">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
        <nav>
        <div class="adminMenu-msg">Cultural MarketPlace</div>
            <ul>
					<li><a href="#"><i class="fa-solid fa-store"></i> Tableau de bord</a></li>
					<li><a href="#"><i class="fa-regular fa-file-lines"></i> Pages</a></li>
					<li><a href="#"><i class="fa-solid fa-bag-shopping"></i> Produits</a></li>
                    <hr>
					<li><a href="#"><i class="fa-solid fa-gear"></i> Paramètres</a></li>
            </ul>
        </nav>

        <div class="navAdmin">
            <ul>
			    <li><a href="#"><i class="fas fa-bell"></i></a></li>
			    <li><a>Calvelo Nicolas</a></li>
			    <li><a href="#"><i class="fa-regular fa-user"></i></a></li>
            </ul>
            <hr>
		</div>


    </header>
    <main>
        <?php include $this->view; ?>
    </main>


</body>
</html>