<?php

namespace App\Repository;


class ReviewRepository
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

        $this->tableName = $_ENV["BDD_PREFIX"] . "_review";
    }

    public function getNonEvaluated($limit = null, $offset = null, $return = "object")
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

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        if ($return == "object") {
            $stmt->setFetchMode(\PDO::FETCH_CLASS, "App\Models\Review");
        }

        return $stmt->fetchAll();
    }
}
