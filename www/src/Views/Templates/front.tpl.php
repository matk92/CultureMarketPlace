<?php $json = file_get_contents(__DIR__ . '/../Main/home.json');
$data = json_decode($json, true); ?>
<!DOCTYPE html>
<html lang="fr">
<style>
    body {
        background-color: <?php echo $data['background-color']; ?>;
    }
    .homepage-content {
        color: <?php echo $data['body-font-color']; ?>;
    }
    .nav-home {
        background-color: <?php echo $data['nav-color']; ?>;
    }
    .nav-home a {
        color: <?php echo $data['font-nav-color']; ?>;
    }
    .dropdown-content.show {
        background-color: <?php echo $data['nav-color']; ?>;
    }

    .footer-home {
        background-color: <?php echo $data['footer-color']; ?>;
    }
    .discover-products-text {
        h2{
            color: <?php echo $data['home-discover-color']; ?>;
        }
        p { 
            color: <?php echo $data['home-discover-color']; ?>;
        }
    }
    .footer-home {
        color: <?php echo $data['footer-font-color']; ?>;
    }

    .title-home {
        color: <?php echo $data['title-site-color']; ?>;
    }

    .subtitle-home {
        color: <?php echo $data['subtitle-site-color']; ?>;
    }

</style>

<head>
    <meta charset="UTF-8">
    <title><?php echo ($data['site-name']) ?></title>
    <link rel="stylesheet" href="/dist/css/style.css">
    <link rel="icon" href="/assets/images/<?php echo $data['site-favicon']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ba814b6b43.js" crossorigin="anonymous"></script>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body class="home-body">
    <header>
        <div class="bg-img-home">
            <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'success') : ?>
                <div id="success-alert" class="alert alert-success" style="position: fixed; top: 0;">
                    <p>Connexion réussie. Bienvenue !</p>
                </div>
                <?php
                unset($_SESSION['alert']);
                ?>
            <?php endif; ?>
            <img src="/assets/images/<?php echo ($data['site-background-image']) ?>" alt="Image">
            <nav class="nav-home">
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/products">Produits</a></li>
                    <li><a href="#">|</a></li>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="dropdown">
                            <a href="#" class="dropbtn">
                                <i class="fa-regular fa-user"></i>
                                <?= $_SESSION['user']['firstname'] ?> <?= $_SESSION['user']['lastname'] ?>
                            </a>
                            <div class="dropdown-content" id="userDropdown">
                                <a href="/profile">Profil</a>
                                <a href="/logout">Déconnexion<i class="fa-solid fa-right-from-bracket"></i></a>
                            </div>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="/login">
                                <i class="fa-regular fa-user"></i>
                                Connexion
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']["role"] >= 5) : ?>
                        <li>
                            <a href="/admin/dashboard">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <button id="toggle-dark-mode"><i class="fas fa-sun"></i></button>
                    </li>
                </ul>
            </nav>
            <div class="content-header-home">
                <?php if ($_SERVER['REQUEST_URI'] == "/") : ?>
                    <div class="title-home"><?php echo ($data['site-name']) ?></div>
                    <br />
                    <div class="subtitle-home"><?php echo ($data['site-subtitle']) ?></div>
                    <div class="center-home">
                        <a href="/products" class="button button-outline">Découvrir les produits</a>
                    </div>
                    <div class="chevron-double-home">
                        <a href="#title-homepage">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="36" height="36">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main>
        <?php include $this->view; ?>
    </main>
    <?php if (isset($_SESSION["order_id"]) && !str_contains($_SERVER['REQUEST_URI'], "orders")) : ?>
        <a href="/orders" class="floating-action-btn floating-action-btn-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="36" height="36">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </a>
    <?php endif; ?>

    <footer class="footer-home">
        <hr />
        <p><?php echo ($data['footer-text']) ?></p>
        <div class="social-media-home">
            <a href="<?php echo ($data['footer-facebook']) ?>"><i class="fa-brands fa-square-facebook"></i></a>
            <a href="<?php echo ($data['footer-twitter']) ?>"><i class="fa-brands fa-twitter"></i></a>
            <a href="<?php echo ($data['footer-instagram']) ?>"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <ul>
            <li><a href="/copyright">© Copyright 2023 Cultural MarketPlace</a></li>
            <li><a href="/legal">Mentions légales</a></li>
            <li><a href="/privacy">Politique de confidentialité</a></li>
            <li><a href="/refund">Politique de remboursement</a></li>
            <li><a href="/terms">Conditions générales de vente</a></li>
        </ul>
    </footer>
</body>
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
<script>
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) alert.style.display = 'none';
    }, 5000);

    document.querySelector('.dropbtn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('userDropdown').classList.toggle('show');
    });
</script>
<script src="../assets/js/components/navbar.js"></script>
<script src="../assets/js/components/darkmode.js"></script>

</html>