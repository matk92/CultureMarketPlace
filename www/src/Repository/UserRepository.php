<?php

namespace App\Repository;

use App\Core\Repository;

class UserRepository extends Repository
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM $this->tableName 
            WHERE isdeleted = false
            ORDER BY id";
        return $this->fetch($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id AND isdeleted = false";
        $params = ['id' => $id];
        $result = $this->fetch($sql, $params);
        return $result ? $result[0] : null;
    }

    public function findByRole($role)
    {
        $sql = "SELECT * FROM $this->tableName WHERE role = :role AND isdeleted = false";
        $params = ['role' => $role];
        return $this->fetch($sql, $params);
    }
}
