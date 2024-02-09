<?php

namespace App\Repository;

use App\Core\Repository;
use App\Models\Category;

class ProductRepository extends Repository
{

    public function getAll(int $limit = null, int $offset = null, string $return = "object"): array
    {
        $sql = "SELECT p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, COALESCE(AVG(r.rating), 0) AS rating, c.name AS categoryname, c.id AS categoryid, c.unit AS categoryunit
        FROM $this->tableName p
        LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_review r ON p.id = r.productid 
        LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_category c ON p.categoryid = c.id 
        WHERE p.archived = false ";

        $sql .= "GROUP BY p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, c.name, c.id, c.unit";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $this->fetch($sql);
    }

    public function getAllByCategory(int $category, int $limit = null, int $offset = null): array
    {
        $sql = "SELECT p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, COALESCE(AVG(r.rating), 0) AS rating
            FROM $this->tableName p
            LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_review r ON p.id = r.productid 
            WHERE p.categoryid = :categoryid AND p.archived = false ";

        $sql .= "GROUP BY p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $this->fetch($sql, [":categoryid" => $category]);
    }

    public function delete(int $id): bool
    {
        $sql = "UPDATE $this->tableName SET archived = true WHERE id = :id";
        $execute = [":id" => $id];

        return $this->execute($sql, $execute);
    }
}
