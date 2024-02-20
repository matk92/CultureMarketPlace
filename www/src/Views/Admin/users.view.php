<?php
$roles = [
    0 => 'Inconnu',
    1 => 'Utilisateur',
    5 => 'Modérateur',
    10 => 'Admin'
];
?>

<div id="success_reset_password" class="alert alert-success hidden" style="position: fixed; top: 0;">
    <p>Le mot de passe a été regénéré et envoyé par email !</p>
</div>

<h1>Liste des utilisateurs inscrits sur le site</h1>

<table class="table-users-list">
    <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Date d'inscription</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr id="user_<?= $user->getId() ?>">
                <td><?= $user->getId() ?></td>
                <td>
                    <?php if ($user->getRole() == 10) : ?>
                        <i class="fa-solid fa-crown" style="color: #d4af37;"></i>
                    <?php elseif ($user->getRole() == 5) : ?>
                        <i class="fa-solid fa-shield-halved" style="color: #258ffa;"></i>
                    <?php elseif ($user->getRole() == 1) : ?>
                        <i class="fa-solid fa-user" style="color: #5d5d5d;"></i>
                    <?php elseif ($user->getRole() == 0) : ?>
                        <i class="fa-solid fa-clock" style="color: #e76730;"></i>
                    <?php endif; ?>
                    <?= $user->getFirstname() ?>
                </td>
                <td><?= $user->getLastname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getStatusName() ?></td>
                <td><?= $roles[$user->getRole()] ?></td>
                <td><?= $user->getInserted() ?></td>
                <td>
                    <?php if ($user->getId() != $_SESSION['user']['id'] && $user->getStatus() > 0) : ?>
                        <form action="/user/changerole" method="post">
                            <input type="hidden" name="id" value="<?= $user->getId() ?>">
                            <select name="role">
                                <option value="1" <?= $user->getRole() == 1 ? 'selected' : '' ?>>Utilisateur</option>
                                <option value="5" <?= $user->getRole() == 5 ? 'selected' : '' ?>>Modérateur</option>
                                <option value="10" <?= $user->getRole() == 10 ? 'selected' : '' ?>>Administrateur</option>
                            </select>
                            <input class="button button-primary" style="width: 100%; margin-top: 10px;" id="changerole" type="submit" value="Changer le rôle">
                        </form>
                        <button class="button button-danger" style="width: 100%; margin-top: 10px;" onclick="deletUser(<?= $user->getId() ?>)">
                            Supprimer le compte
                        </button>
                        <button class="button button-secondary" style="width: 100%; margin-top: 10px;" onclick="resetUserPassword(<?= $user->getId() ?>)">
                            Regénérer le mot de passe
                        </button>
                    <?php else : ?>
                        <?= $user->getRole() == 10 ? 'Administrateur' : ($user->getRole() == 5 ? 'Modérateur' : 'Utilisateur') ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function deletUser(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.")) {
            fetch("/user/delete?id=" + id + "&hardDelete=true", {
                method: "DELETE",
            }).then(response => {
                if (response.ok) {
                    document.getElementById("user_" + id).remove();
                }
            });
        }
    }

    function resetUserPassword(id) {
        if (confirm("Êtes-vous sûr de vouloir regénérer le mot de passe de cet utilisateur ?")) {
            fetch("/admin/reset-password?id=" + id, {
                method: "GET",
            }).then(response => {
                if (response.ok) {
                    document.getElementById("success_reset_password").classList.remove("hidden");
                } else {
                    alert("Une erreur est survenue lors de la regénération du mot de passe");
                }
            });
        }
    }
</script>