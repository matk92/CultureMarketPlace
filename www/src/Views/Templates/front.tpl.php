<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CuluturalMarketPlace</title>
    <link rel="stylesheet" href="assets/scss/style.css">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
</head>
<body class="home-body">
	
    <header>
        <div class="bg-img-home">
            <div class="title-home">Culutural MarketPlace</div>
            <nav class="container-home">
                <ul>
					<div class="nav-home">
						<li><a href="/">Accueil</a></li>
						<li><a href="products">Produits</a></li>
						<li><a href="#">|</a></li>
						<li><a href="orders"><i class="fa-solid fa-cart-shopping"></i> Mon Panier</a></li>
					</div>	
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php include $this->view; ?>
    </main>

    <footer class="footer-home">
    <p>Avez-vous des préoccupations ou des questions? Soyez assuré(e) que nous sommes là pour vous aider.<br />
       N'hésitez pas à nous contacter à l'adresse adressemail@blabla.fr, nous sommes déterminés à vous fournir une assistance rapide
       et efficace. Votre satisfaction est notre priorité absolue.</p>  
    <div class="social-media-home">
        <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
    </div>
    <hr>
    <ul>
        <li><a href="#">© Copyright 2023 Cultural MarketPlace</a></li>
        <li><a href="#">Mentions légales</a></li>
        <li><a href="#">Politique de confidentialité</a></li>
        <li><a href="#">Politique de remboursement</a></li>
        <li><a href="#">Conditions générales de vente</a></li>
    </ul>
</footer>

</body>
</html>
