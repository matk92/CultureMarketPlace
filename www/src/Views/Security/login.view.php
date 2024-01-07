<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styleLogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>Bienvenue chez<br><em>Cultural MarketPlace</em></h1>
    <main id="section_connectez_vous" class="wrapper-security">
        <?php $this->modal("form", $form) ?>
        <br />
        <hr />
        <p>Mot de passe oublié ? <a href="#" class="btnconfig">Cliquez ici</a> | Nouveau client ? <a href="register" class="btnconfig">Créer mon compte</a></p>
    </main>
</body>

</html>

<!-- <div class="wrapper-security">
    <form action="">
        <h1 class="title-security">Connexion</h1>
        <div class="input-box-security">
            <input type="text" placeholder="Email" required>
        </div>
        <div class="input-box-security">
            <input type="password" placeholder="Password" required>
        </div>
        <div class="rememberme-security">
            <label><input type="checkbox">Rester connecté</label>
            <a href="#">Mot de passe oublié ?</a>
        </div>
        <button type="submit" class="btn-security">Connexion</button>
        <div class="register-link-security">
            <p>Nouveau client ? <a href="/register">S'inscrire ici</a></p>
        </div>
    </form>
</div> -->
