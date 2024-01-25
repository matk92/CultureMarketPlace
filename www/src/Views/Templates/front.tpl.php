<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>CuluturalMarketPlace</title>
    <link rel="stylesheet" href="/dist/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
</head>

<body class="home-body">

    <header>
        <div class="bg-img-home">
            <div class="content-header-home">
                <div class="title-home">Culutural MarketPlace</div><br>
                <div class="subtitle-home">La boutique en ligne des produits culturels</div>
                <?php if ($_SERVER['REQUEST_URI'] == "/") : ?>
                    <div class="center-home">
                        <a href="/products" class="button button-outline">Découvrir les produits</a>
                    </div>
                <?php else : ?>
                    <div class="spacer"></div>
                <?php endif; ?>
                <?php if ($_SERVER['REQUEST_URI'] == "/") : ?>
                    <div class="chevron-double-home">
                        <a href="#title-homepage">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                            </svg>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="spacer-home"></div>
                <?php endif; ?>
            </div>
            <nav class="container-home">
                <ul>
					<div class="nav-home">
						<li><a href="/">Accueil</a></li>
						<li><a href="/products">Produits</a></li>
						<li><a href="#">|</a></li>
						<li><a href="/orders/"><i class="fa-solid fa-cart-shopping"></i> Mon Panier</a></li>
                        <!--<?php print_r($_SESSION) ?> -->
                        <!-- TODO : Si l'utilisateur est connecté, afficher son nom et prénom dans le header
                        Sinon afficher un bouton "Se connecter".
                        Faire peut-etre un menu (navbar) à part comme ça ce n'est pas tout collé  -->
                        <li><a href="/login"><i class="fa-regular fa-user"></i></a></li>
                        <button id="toggle-dark-mode"><i class="fas fa-sun"></i></button>
					</div>	
                </ul>
            </nav>
    </header>

    <main>
        <?php include $this->view; ?>
    </main>

    <footer class="footer-home">
        <hr>
        <p>Avez-vous des préoccupations ou des questions? Soyez assuré(e) que nous sommes là pour vous aider.<br />
            N'hésitez pas à nous contacter à l'adresse adressemail@blabla.fr, nous sommes déterminés à vous fournir une assistance rapide
            et efficace. Votre satisfaction est notre priorité absolue.</p>
        <div class="social-media-home">
            <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <ul>
            <li><a href="/copyright">© Copyright 2023 Cultural MarketPlace</a></li>
            <li><a href="/legal">Mentions légales</a></li>
            <li><a href="/privacy">Politique de confidentialité</a></li>
            <li><a href="/refund">Politique de remboursement</a></li>
            <li><a href="/terms">Conditions générales de vente</a></li>
        </ul>
    </footer>

    <script>
        const links = document.querySelectorAll('nav a');

        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

        document.querySelector('.chevron-double-home a').addEventListener('click', function(event) {
            event.preventDefault();
            document.querySelector('#title-homepage').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>

</body>
<script src="../assets/js/components/navbar.js"></script>
<script src="../assets/js/components/darkmode.js"></script>

</html>
