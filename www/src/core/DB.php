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
            $this->connection = new \PDO("pgsql:host=postgres;dbname=".$_ENV["POSTGRES_DB"].";charset=utf8", $_ENV["POSTGRES_USER"], $_ENV["POSTGRES_PASSWORD"]);
        } catch (\Throwable $th) {
            echo "Erreur de connexion : " . $th->getMessage();
        }

        $this->tableName = $_ENV["BDD_PREFIX"] . strtolower(str_replace("App\\Models\\", "", get_called_class()));
    }

    // Permets de faire un update ou un insert en fonction de l'id de l'objet
    public function save(): void
    {

        // il faut recuperer les attributs de la classe que herite DB
        $attributes = $this->getAttributes();

        // on verifie si l'objet a un id
        if (isset($attributes['id'])) {
            // si oui on fait un update
            $sql = "UPDATE $this->tableName SET ";
            foreach ($attributes as $key => $value) {
                if ($key != "id" && !empty($value)) {
                    $sql .= "$key = \"$value\", ";
                }
            }

            // modify manually updatedAt TIMESTAMP because we can't do it automatically with postgreSQL
            if (isset($attributes['updatedAt'])) {
                $sql .= "updatedAt = NOW()";
            } else {
                // remove last comma and space
                $sql = substr($sql, 0, -2);
            }

            $sql .= " WHERE id = " . $attributes['id'];
        } else {
            // sinon on fait un insert
            $sql = "INSERT INTO $this->tableName (";
            foreach ($attributes as $key => $value) {
                if ($key != "id") {
                    $sql .= "$key, ";
                }
            }
            $sql = substr($sql, 0, -2);
            $sql .= ") VALUES (";
            foreach ($attributes as $key => $value) {
                if ($key != "id" && !empty($value)) {
                    $sql .= "\"$value\", ";
                }
            }
            $sql = substr($sql, 0, -2);
            $sql .= ")";
        }

        // on prepare la requete
        $stmt = $this->connection->prepare($sql);

        // on execute la requete
        $stmt->execute();

        // on recupere l'id de l'objet si il n'en a pas
        if (!isset($attributes['id'])) {
            $this->setId($this->connection->lastInsertId());
        }
    }

    // Si l'entity a un id, on recupere les informations de la base de données et on les injecte dans l'objet
    public function populate()
    {
        $attributes = $this->getAttributes();

        if (isset($attributes['id'])) {
            $sql = "SELECT * FROM $this->tableName WHERE id = :id";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":id", $attributes['id']);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // On parcours le tableau de resultat
            foreach ($result as $key => $value) {
                try {
                    // On essaye de setter la valeur dans l'objet
                    $function = 'set' . ucfirst($key);
                    $this->$function($value);
                } catch (\Throwable $th) {
                }
            }
        }
    }
}
