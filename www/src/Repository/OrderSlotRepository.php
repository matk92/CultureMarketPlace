<?php

namespace App\Repository;

use App\Core\Repository;

class OrderSlotRepository extends Repository
{

    public function getOrderSlots(int $orderId): array
    {
        $sql = "SELECT *
            FROM $this->tableName os
            WHERE orderid = :orderid
            ORDER BY os.id";

        $execute = [":orderid" => $orderId];

        return $this->fetch($sql, $execute);
    }
    
}
