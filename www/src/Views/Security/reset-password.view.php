<div id="section_connectez_vous" class="wrapper-security">
    <?php if (isset($form)) : ?>
        <h2 class="title-security">Recupération de mot de passe</h2>
        <p>Veuillez saisir votre adresse email pour recevoir un code de vérification</p>
        <?php $this->modal("form", $form) ?>
        <br />
        <hr />
        <div class="register-link-security">
            <p>Nouveau client ? <a href="register" class="btnconfig">Créer mon compte</a></p>
        </div>
    <?php else : ?>
        <!-- TODO : style de formulaire aprés l'envoi du mail -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="36px" height="36px">
            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
        </svg>
        <h2 class="title-security">On vous a envoyé un email</h2>
        <p>Vous pouvez vous connecter avec votre nouveau mot de passe</p>
        <a href="/login" class="btnconfig">Se connecter</a>
    <?php endif; ?>
</div>