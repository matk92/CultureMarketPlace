<?php

namespace App\Repository;

use App\Core\Repository;

class OrderRepository extends Repository
{


    public function getOrdersByUser(int $userId): array
    {
        $sql = "SELECT *
        FROM $this->tableName o
        WHERE userid = :userid";
        
        $execute = [":userid" => $userId];

        return $this->fetch($sql, $execute);
    }
}
