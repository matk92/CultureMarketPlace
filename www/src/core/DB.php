<?php

namespace App\Core;

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

        $this->tableName = $_ENV["BDD_PREFIX"] . strtolower(str_replace("App\\Models\\", "", get_called_class()));
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
                $sql .= "$key = :$key, ";
                $execute[":$key"] = $value;
            }

            // remove last comma and space
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id = " . $attributes['id'] . ";";
        } else {
            $sql = "INSERT INTO $this->tableName (";
            foreach ($attributes as $key => $value) {
                $sql .= "$key, ";
            }

            // remove last comma and space
            $sql = substr($sql, 0, -2);
            $sql .= ") VALUES (";

            foreach ($attributes as $key => $value) {
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

    public static function populate($id): object|int
    {
        return (new static())->getOneBy(["id" => $id], "object");
    }

    public function getOneBy(array $data, $return = "array"): object|array|int
    {
        $sql = "SELECT * FROM $this->tableName WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        if ($return == "object")
            $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        $stmt->bindValue(":id", $data['id']);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        $object = new static();

        // On parcours le tableau de resultat
        foreach ($result as $key => $value) {
            try {
                // On essaye de setter la valeur dans l'objet
                $function = 'set' . ucfirst($key);
                $object->$function($value);
            } catch (\Throwable $th) {
            }
        }
        return $object;
    }
}
