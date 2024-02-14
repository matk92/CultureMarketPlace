<?php
$roles = [
    0 => 'Inconnu',
    1 => 'Utilisateur',
    5 => 'Modérateur',
    10 => 'Admin'
];
?>

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
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td>
                    <?php if ($user->getRole() == 10): ?>
                        <i class="fa-solid fa-crown" style="color: #d4af37;"></i>
                    <?php elseif ($user->getRole() == 5): ?>
                        <i class="fa-solid fa-shield-halved" style="color: #258ffa;"></i>
                    <?php elseif ($user->getRole() == 1): ?>
                        <i class="fa-solid fa-user" style="color: #5d5d5d;"></i>
                    <?php elseif ($user->getRole() == 0): ?>
                        <i class="fa-solid fa-clock" style="color: #e76730;"></i>
                    <?php endif; ?>
                    <?= $user->getFirstname() ?>
                </td>
                <td><?= $user->getLastname() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getStatus() ?></td>
                <td><?= $roles[$user->getRole()] ?></td>
                <td><?= $user->getInserted() ?></td>
                <td>
                    <?php if ($user->getRole() != 10): ?>
                        <form action="/admin/changerole" method="post">
                            <input type="hidden" name="id" value="<?= $user->getId() ?>">
                            <select name="role">
                                <option value="1" <?= $user->getRole() == 1 ? 'selected' : '' ?>>Utilisateur</option>
                                <option value="5" <?= $user->getRole() == 5 ? 'selected' : '' ?>>Modérateur</option>
                            </select>
                            <input class="button button-primary" style="width: 100%; margin-top: 10px;" id="changerole" type="submit" value="Changer le rôle">
                        </form>
                    <?php else: ?>
                        Admin
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>