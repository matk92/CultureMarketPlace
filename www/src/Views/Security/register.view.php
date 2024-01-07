<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styleConnection.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>Bienvenue chez<br><em>Cultural MarketPlace</em> </h1>
    <main id="section_connectez_vous" class="wrapper-security">
        <h2>Créer votre compte</h2>
        <?php $this->modal("form", $form) ?>
        <br />
        <hr />
        <p>Vous avez déjà un compte ?<a href="login" class="btnconfig"> Connectez-vous</a></p>
    </main>
</body>

</html>

<!-- <div class="wrapper-security">
    <form action="">
        <h1 class="title-security">Inscription</h1>
        <div class="input-box-security">
            <input type="text" placeholder="Email" required>
        </div>
        <div class="input-box-security">
            <input type="password" placeholder="Mot de passe" required>
        </div>
        <div class="input-box-security">
            <input type="password" placeholder="Confirmer le mot de passe" required>
        </div>
        <button type="submit" class="btn-security">S'inscrire</button>
        <div class="register-link-security">
            <p>Vous avez déjà un compte ? <a href="/login">Se connecter ici</a></p>
        </div>
    </form>
</div> -->
