<?php

namespace App\Repository;

use App\Core\Repository;

class ReviewRepository extends Repository
{
    public function getNonEvaluated($limit = null, $offset = null): array
    {
        $sql = "SELECT c.id, c.isapproved, c.inserted, c.comment, c.rating, u.firstname, u.lastname FROM $this->tableName c
                LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_user u ON c.userid = u.id 
                WHERE isapproved is null";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $this->fetch($sql);
    }

    public function getProductComments($productId): array
    {
        $sql = "SELECT c.id, c.isapproved, c.inserted, c.comment, c.rating, u.firstname, u.lastname FROM $this->tableName c
                LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_user u ON c.userid = u.id 
                WHERE productid = :productid AND isapproved = true";
        $execute = [":productid" => $productId];

        return $this->fetch($sql, $execute);
    }
}
