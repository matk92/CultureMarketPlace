<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styleLogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>Bienvenue chez<br><em>Cultural MarketPlace</em></h1>
    <main id="section_connectez_vous">
        <?php $this->modal("form", $form) ?>
        <br />
        <hr />
        <p>Mot de passe oublié ? <a href="#" class="btnconfig">Cliquez ici</a> | Nouveau client ? <a href="register" class="btnconfig">Créer mon compte</a></p>
    </main>
</body>

</html>