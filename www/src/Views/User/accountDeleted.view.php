<?php if (isset($form)) : ?>
    <hr />
    <h1>Voulez-vous recuperer votre compte ?</h1>
    <p>Votre compte a été désactivé. Vous pouvez le récupérer en appuyant sur le bouton ci-dessous.</p>
    <?php $this->modal("form", $form) ?>
<?php else : ?>
    <h1>Votre compte a été supprimé !</h1>
    <p>Votre compte a été supprimé avec succès. Nous espérons vous revoir bientôt.</p>
    <a href="/" class="button">Retour à l'accueil</a>
<?php endif; ?>