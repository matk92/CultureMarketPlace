<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styleConnection.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1>Bienvenue chez<br><em>Cultural MarketPlace</em> </h1>
    <main id="section_connectez_vous">
        <h2>Créer votre compte</h2>
        <?php $this->modal("form", $form) ?>
        <br />
        <hr />
        <p>Vous avez déjà un compte ?<a href="login" class="btnconfig"> Connectez-vous</a></p>
    </main>
</body>

</html>