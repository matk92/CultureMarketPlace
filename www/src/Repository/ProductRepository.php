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

    public function getAllByCategory(int $category = 0, int $limit = null, int $offset = null, string $return = "object")
    {
        $sql = "SELECT p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid, COALESCE(AVG(r.rating), 0) AS rating
            FROM $this->tableName p
            LEFT JOIN " . $_ENV["BDD_PREFIX"] . "_review r ON p.id = r.productid ";
        if ($category > 0) {
            $sql .= "WHERE p.categoryid = " . $category . " ";
        }
        $sql .= "GROUP BY p.id, p.name, p.image, p.description, p.price, p.stock, p.categoryid";

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
}
