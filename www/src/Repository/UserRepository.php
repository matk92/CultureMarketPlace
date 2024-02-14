<?php

namespace App\Repository;

use App\Core\Repository;

class UserRepository extends Repository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM $this->tableName ORDER BY id";
        return $this->fetch($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";
        $params = ['id' => $id];
        $result = $this->fetch($sql, $params);
        return $result ? $result[0] : null;
    }

    public function update($user)
    {
        $sql = "UPDATE $this->tableName SET role = :role WHERE id = :id";
        $params = ['role' => $user->getRole(), 'id' => $user->getId()];
        $this->execute($sql, $params);
    }
}