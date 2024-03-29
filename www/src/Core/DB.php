<?php

namespace App\Core;

use function PHPSTORM_META\type;

class DB
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

        $name = str_replace("App\\Models\\", "", get_called_class());
        $normalizeName = strtolower($name[0]) . substr($name, 1);
        $normalizedName = preg_replace('/(?<!^)([A-Z])/', '_$1', $normalizeName);
        $normalizedName = strtolower($normalizedName);
        $this->tableName = $_ENV["BDD_PREFIX"] . "_" . strtolower($normalizedName);

        if (method_exists($this, "populateRelations")) {
            $this->populateRelations();
        }
    }

    public function getChlidVars(): array
    {
        $objectVars = get_object_vars($this);
        $classVars = get_class_vars(get_class());
        $vars = array_diff_key($objectVars, $classVars);
        return $vars;
    }

    // Permets de faire un update ou un insert en fonction de l'id de l'objet
    public function save(): void
    {
        $attributes = $this->getChlidVars();

        // on verifie si l'objet a un id, si oui on fait un update, sinon on fait un insert
        $isUpdate = isset($attributes['id']);
        $execute = [];

        if ($isUpdate) {
            $sql = "UPDATE $this->tableName SET ";
            foreach ($attributes as $key => $value) {
                if (is_bool($value)) {
                    $value = $value ? 't' : 'f';
                }
                $sql .= "$key = :$key, ";
                $execute[":$key"] = $value;
            }

            // remove last comma and space
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id = " . $attributes['id'] . ";";
        } else {
            $sql = "INSERT INTO $this->tableName (";
            foreach ($attributes as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    continue;
                }

                $sql .= "$key, ";
            }

            // remove last comma and space
            $sql = substr($sql, 0, -2);
            $sql .= ") VALUES (";

            foreach ($attributes as $key => $value) {
                if (is_bool($value)) {
                    $value = ($value == true ? 't' : 'f');
                }
                $sql .= ":$key, ";
                $execute[":$key"] = $value;
            }

            // remove last comma and space
            $sql = substr($sql, 0, -2);
            $sql .= ");";
        }

        // on prepare la requete
        $stmt = $this->connection->prepare($sql);

        // on execute la requete
        $stmt->execute($execute);

        // on recupere l'id de l'objet si il n'en a pas
        if (!isset($attributes['id']) && method_exists($this, "setId")) {
            $this->setId($this->connection->lastInsertId());
        }
    }

    // Permets de supprimer un objet soft ou hard
    public function delete($hardDelete = false, $replace = true): void
    {
        if ($hardDelete) {
            if ($replace) {
                $attributes = $this->getChlidVars();
                foreach ($attributes as $key => $value) {
                    if ($key !== 'id' && is_string($value)) {
                        $method = "set" . ucfirst($key);
                        if (method_exists($this, $method))
                            $this->$method($key . "_deleted");
                    }
                }

                if (method_exists($this, "setIsdeleted"))
                    $this->setIsdeleted(true);

                $this->save();
            } else {
                $sql = "DELETE FROM $this->tableName WHERE id = :id";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([":id" => $this->getId()]);
            }
        } else {
            if (method_exists($this, "setIsdeleted"))
                $this->setIsdeleted(true);

            $this->save();
        }
    }

    public static function populate(int $id): object|int
    {
        return (new static())->getOneBy(["id" => $id], "object");
    }

    public function getOneBy(array $data, $return = "array"): object|array|int
    {
        $sql = "SELECT * FROM $this->tableName WHERE ";
        $execute = [];

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $sql .= $key . " ILIKE :" . $key . " AND ";
            } else {
                $sql .= $key . "=:" . $key . " AND ";
            }
            $execute[":" . $key] = $value;
        }
        $sql = substr($sql, 0, -5);

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($execute);

        if ($return == "object")
            $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        return $stmt->fetch();
    }
}
