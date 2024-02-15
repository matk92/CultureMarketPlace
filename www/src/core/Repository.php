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

    protected function fetch($sql, $execute = null): array
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($execute);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->modelName);
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
}