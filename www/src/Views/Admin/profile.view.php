<?php
    $role = $_SESSION['user']['role'];

    $roles = [
        0 => 'Inconnu',
        1 => 'Utilisateur',
        5 => 'Modérateur',
        10 => 'Admin'
    ];

    $roleName = isset($roles[$role]) ? $roles[$role] : '';
?>
<section class="profile">
    <h1 class="profileTitleAdmin">Informations du compte</h1>
    <h3>Rôle - <?= $roleName ?></h3>
    <div class="profileContentAdmin">
        <img src="../assets/images/bryan.jpg" class="imageProfileAdmin" id="profileImage" />
        <div class="profileForm">
            <form class="profileFormAdmin" id="profileForm" enctype="multipart/form-data">
                <div class="columnAdmin">
                    <label for="profileImage">Image de profil</label><br />
                    <input type="file" id="profileImage" name="profileImage" accept=".png, .jpg, .jpeg" style="height: 50px;"><br />
                    <label for="name">Nom</label><br />
                    <input type="text" id="name" name="name" value="<?= $_SESSION['user']['firstname'] ?>"><br />
                    <label for="prenom">Prénom</label><br />
                    <input type="text" id="name" name="name" value="<?= $_SESSION['user']['lastname'] ?>"><br />
                    <label for="email">Email</label><br />
                    <input type="email" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>"><br />
                </div>    
                <div class="columnAdmin">
                    <label for="password">Mot de passe</label><br />
                    <input type="password" id="password" name="password" value="******************"><br />
                    <label for="confirmPassword">Confirmer le mot de passe</label><br />
                    <input type="password" id="confirmPassword" name="confirmPassword" value="******************"><br />
                </div>    
            </form>
        </div>
    </div>
    <div class="btnProfileAdmin">
            <button class="button button-primary"><i class="fa-solid fa-check"></i> Sauvegarder les changements</button>
            <button class="button button-secondary" id="cancelButton"><i class="fa-solid fa-rotate-left"></i> Annuler les changements</button>
    </div>
    <h2>Supprimer le compte</h2>
    <div class="btnProfileAdmin">
        <button class="button button-danger" onclick="confirmDelete()"><i class="fa-solid fa-trash"></i> Supprimer mon compte</button>
        <button class="button button-danger" onclick="confirmDelete()"><i class="fa-solid fa-trash"></i> Supprimer mon compte et ses données</button>
    </div>
</section>

<script>
    document.getElementById('cancelButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('profileForm').reset();
    });
</script>
<script>
    function confirmDelete() {
        if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.")) {
            // Ajoutez ici le code pour supprimer le compte
        }
    }

    document.getElementById('cancelButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('profileForm').reset();
    });
</script>