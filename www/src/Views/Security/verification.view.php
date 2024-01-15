<div id="section_connectez_vous" class="wrapper-security">
    <h2 class="title-security">Veulliez verifier votre compte</h2>
    <p>Votre code de vérification vous a été envoyé par mail</p>
    <?php $this->modal("form", $form) ?>
    <br />
    <hr />
    <div class="register-link-security">
        <p>Vous n'avez pas reçu votre code ? <a id="resendCode" class="btnconfig">Renvoyer le code</a></p>
    </div>
    <div class="register-link-security">
        <p>Nouveau client ? <a href="register" class="btnconfig">Créer mon compte</a></p>
    </div>
</div>
<script>
    document.getElementById('form-verification').addEventListener('submit', function(event) {
        var code = document.getElementById('form-verification-code').value;
        if (code.length !== 6) {
            alert('Code de vérification invalide');
            event.preventDefault();
        }
    });

    // On click resend code call path '/verification/sendVerificationCode' if true as response display message
    document.getElementById('resendCode').addEventListener('click', function(event) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/verification/sendVerificationCode', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Code de vérification renvoyé');
            } else {
                alert('Erreur lors de l\'envoi du code de vérification');
            }
        };
        xhr.send();
    });
</script>