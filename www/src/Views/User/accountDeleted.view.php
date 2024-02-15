<?php if (isset($form)) : ?>
    <hr />
    <h1>Voulez-vous recuperer votre compte ?</h1>
    <?php $this->modal("form", $form) ?>
<?php else : ?>
    <h1>Votre compte a été supprimé !</h1>
    <p>Votre compte a été supprimé avec succès. Nous espérons vous revoir bientôt.</p>
    <a href="/" class="button">Retour à l'accueil</a>
<?php endif; ?>