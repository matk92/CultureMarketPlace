<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Front</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
</head>
<body>
	
    <header>
        <div class="bg-img">
            <div class="home-msg">Mon Panier</div>
            <nav class="container">
                <ul>
					<div class="nav">
						<li><a href="/">Accueil</a></li>
						<li><a href="products">Produits</a></li>
						<li><a href="#">|</a></li>
						<li><a href="cart"><i class="fa-solid fa-cart-shopping"></i> Mon Panier</a></li>
					</div>	
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php include $this->view; ?>
    </main>

    <footer>
    <p>Avez-vous des préoccupations ou des questions? Soyez assuré(e) que nous sommes là pour vous aider.<br />
       N'hésitez pas à nous contacter à l'adresse adressemail@blabla.fr, nous sommes déterminés à vous fournir une assistance rapide
       et efficace. Votre satisfaction est notre priorité absolue.</p>  
    <div class="social-media">
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
