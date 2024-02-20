<?php

namespace App\Core;

use PDO;
use Throwable;

class Repository
{
    protected $connection;
    protected $modelName;
    protected $tableName;

    public function __construct()
    {
        // connexion à la base de données
        try {
            $this->connection = new PDO(
                "pgsql:host=postgres;port=5432;dbname=" . $_ENV["POSTGRES_DB"] . ";user=" . $_ENV["POSTGRES_USER"] . ";password=" . $_ENV["POSTGRES_PASSWORD"]
            );
        } catch (Throwable $th) {
            echo "Erreur de connexion : " . $th->getMessage();
        }

        $name = str_replace("App\\Repository\\", "", get_called_class());
        $name = str_replace("Repository", "", $name);

        $this->modelName = "App\Models\\" . ucfirst($name);
        // Check if model exists
        if (!class_exists($this->modelName)) {
            die("Model " . $this->modelName . " not found");
        }

        $normalizeName = strtolower($name[0]) . substr($name, 1);
        $normalizedName = preg_replace('/(?<!^)([A-Z])/', '_$1', $normalizeName);
        $normalizedName = strtolower($normalizedName);
        $this->tableName = $_ENV["BDD_PREFIX"] . "_" . strtolower($normalizedName);
    }

    protected function fetch($sql, $execute = null, $fetchMode = PDO::FETCH_CLASS): array
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($execute);
        if ($fetchMode === PDO::FETCH_CLASS) {
            $stmt->setFetchMode($fetchMode, $this->modelName);
        } else {
            $stmt->setFetchMode($fetchMode);
        }
        return $stmt->fetchAll();
    }

    protected function execute($sql, $execute): bool
    {
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($execute);
    }

    public function find(int $id): ?object
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
        $execute = ["id" => $id];

        return $this->fetch($sql, $execute)[0] ?? null;
    }

    public function findOneBy(array $criteria): ?object
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE ";
        $execute = [];
        foreach ($criteria as $key => $value) {
            if (is_string($value)) {
                $sql .= $key . " ILIKE :" . $key . " AND ";
            } else {
                $sql .= $key . " = :" . $key . " AND ";
            }
            $execute[$key] = $value;
        }
        $sql = rtrim($sql, " AND ");

        return $this->fetch($sql, $execute)[0] ?? null;
    }

    public function findAll(): array
    {
        if (method_exists((new $this->modelName), "getIsdeleted"))
            $sql = "SELECT * FROM " . $this->tableName . " WHERE isdeleted = false";
        else
            $sql = "SELECT * FROM " . $this->tableName;
            
        return $this->fetch($sql);
    }
}