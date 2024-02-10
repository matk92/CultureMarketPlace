<?php

namespace App\Repository;

use App\Core\Repository;

class PaymentRepository extends Repository
{


    public function getPaymentByOrder(int $orderId): array
    {
        $sql = "SELECT *
        FROM $this->tableName o
        WHERE userid = :orderid";
        
        $execute = [":orderid" => $orderId];

        return $this->fetch($sql, $execute);
    }
}
