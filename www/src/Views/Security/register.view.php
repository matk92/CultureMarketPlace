<div id="section_connectez_vous" class="wrapper-security">
    <h2 class="title-security">Créer votre compte</h2>
    <?php $this->modal("form", $form) ?>
    <br />
    <hr />
    <div class="register-link-security">
        <p>Vous avez déjà un compte ?<a href="login" class="btnconfig"> Connectez-vous</a></p>
    </div>
</div>
<script>
    document.getElementById('form-register').addEventListener('submit', function(event) {
        console.log('test');
        var password = document.getElementById('form-register-pwd').value;
        var confirmPassword = document.getElementById('form-register-passwordconfirm').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            event.preventDefault();
        }
    });
</script>