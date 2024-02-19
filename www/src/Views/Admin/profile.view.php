<section class="profile">
    <h1 class="profileTitleAdmin">Informations du compte</h1>
    <hr />
    <?php $this->modal("form", $form) ?>
    <br/>
    <h1 class="profileTitleAdmin">Zone de Danger</h1>
    <hr />
    <div class="sectionProfile">
        <h3>Désactivation du compte</h3>
        <p>Votre compte sera désactivé et il ne s'affichera plus sur le site. Vous pouvez toujour récupérer votre compte en vous connectant avec vos identifiants.</p>
        <button class="button-outlined button-outlined-danger" onclick="softDelete()"><i class="fa-solid fa-user-slash"></i> Désactiver mon compte</button>
    </div>
    <div class="sectionProfile">
        <h3>Suppression du compte</h3>
        <p>Attention, cette action est irréversible. Toutes vos données seront supprimées et il ne sera pas possible de les récupérer.</p>
        <button class="button button-danger" onclick="hardDelete()"><i class="fa-solid fa-trash"></i> Supprimer mon compte et ses données</button>
    </div>
</section>

<script>
    function softDelete() {
        if (confirm("Êtes-vous sûr de vouloir désactiver votre compte ?")) {
            fetch("/user/delete?id=<?= $user->getId() ?>&hardDelete=false", {
                method: "DELETE",
            }).then(response => {
                if (response.ok) {
                    window.location.href = "/user/delete";
                }
            });
        }
    }

    function hardDelete() {
        if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.")) {
            fetch("/user/delete?id=<?= $user->getId() ?>&hardDelete=true", {
                method: "DELETE",
            }).then(response => {
                if (response.ok) {
                    window.location.href = "/user/delete";
                }
            });
        }
    }
</script>