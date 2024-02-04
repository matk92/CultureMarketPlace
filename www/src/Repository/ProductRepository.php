<?php

namespace App\Repository;

use App\Models\Category;

class ProductRepository
{


    private $connection;
    private $tableName;

    public function __construct()
    {
        // connexion à la base de données
        try {
            $this->connection = new \PDO(
                "pgsql:host=postgres;port=5432;dbname=" . $_ENV["POSTGRES_DB"] . ";user=" . $_ENV["POSTGRES_USER"] . ";password=" . $_ENV["POSTGRES_PASSWORD"]
            );
        } catch (\Throwable $th) {
            echo "Erreur de connexion : " . $th->getMessage();
        }

        $this->tableName = $_ENV["BDD_PREFIX"] . "_product";
    }

    public function getAll(int $limit = null, int $offset = null, string $return = "object") : array
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

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if ($return == "object") {
            $stmt->setFetchMode(\PDO::FETCH_CLASS, "App\Models\Product");
        }

        return $stmt->fetchAll();
    }

    public function getAllByCategory(int $category = 0, int $limit = null, int $offset = null, string $return = "object") : array
    {
        $sql = "SELECT p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived, COALESCE(AVG(r.rating), 0) AS rating
            FROM $this->tableName p
            LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_review r ON p.id = r.productid ";
        if ($category > 0) {
            $sql .= "WHERE p.categoryid = " . $category . " AND p.archived = false ";
        }
        $sql .= "GROUP BY p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, p.archived";

        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if ($return == "object") {
            $stmt->setFetchMode(\PDO::FETCH_CLASS, "App\Models\Product");
        }

        return $stmt->fetchAll();
    }

    public function delete(int $id): bool
    {
        $sql = "UPDATE $this->tableName SET archived = true WHERE id = :id";
        $execute = [":id" => $id];

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute($execute);
    }
}
