<?php
$_SESSION['alert'] = 'success';
?>
<div id="section_connectez_vous" class="wrapper-security">
    <h2 class="title-security">Connexion</h2>
    <?php $this->modal("form", $form) ?>
    <br />
    <hr />
    <div class="register-link-security">
        <p>Mot de passe oublié ? <a href="/reset-password" class="btnconfig">Cliquez ici</a></p>
    </div>
    <div class="register-link-security">
        <p>Nouveau client ? <a href="register" class="btnconfig">Créer mon compte</a></p>
    </div>
</div>