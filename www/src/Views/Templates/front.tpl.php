<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Front</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	
    <header>
        <div class="bg-img">
            <nav class="container">
                <ul>
					<div class="nav">
						<li><a href="#">Accueil</a></li>
						<li><a href="#">Produits</a></li>
						<li><a href="#">|</a></li>
						<li><a href="#">Mon Panier</a></li>
					</div>	
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php include $this->view; ?>
    </main>

	<footer>
			<ul>
				<li><a href="# ">© 2023 Cultural MarketPlace</a></li>
				<li><a href="# ">Politique de remboursement</a></li>
				<li><a href="# ">Politique de confidentialité</a></li>
				<li><a href="# ">Conditions d'utilisation</a></li>
				<li><a href="# ">Conditions générales de vente</a></li>
			</ul>
    </footer>

</body>
</html>
