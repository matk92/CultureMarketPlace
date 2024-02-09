<?php

namespace App\Repository;

use App\Core\Repository;


class CategoryRepository extends Repository
{
    public function getAll($limit = null, $offset = null, $return = "object")
    {
        $sql = "SELECT *
            FROM $this->tableName";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $this->fetch($sql);
    }
}
