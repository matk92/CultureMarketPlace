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
}