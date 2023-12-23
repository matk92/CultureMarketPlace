<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Cultural Marketplace</title>
    <link rel="stylesheet" href="../assets/css/styleAdmin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
        <nav>
            <ul>
                <div class="adminMenu-msg"><a href="/">Cultural MarketPlace</a></div>
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
            </ul>
            <hr>
		</div>


    </header>
    <main>
        <?php include $this->view; ?>
    </main>

<script>

const links = document.querySelectorAll('nav a');

links.forEach(link => {
  if (link.href === window.location.href) {
    link.classList.add('active');
  }
});

</script>
</body>
</html>