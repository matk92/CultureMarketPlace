<?php

namespace App\Core;

class Verificator
{

    public function checkForm(&$config, $data): bool
    {
        if (count($config["inputs"]) !== count($data)) {
            die("Le nombre de champs ne correspond pas");
        }

        // TODO Token CSRF

        $errors = [];
        foreach ($config["inputs"] as $key => $input) {
            // Si le champ n'existe pas, on arrête tout, c'est une tentative de hack
            if (!isset($data[$key]))
                die("Le champ $key n'existe pas");

            // Si le champ est requis, on vérifie qu'il n'est pas vide
            if (isset($input["required"]) && $input["required"] === true && empty($data[$key])) {
                $errors[$key] = "Le champ " . $input["label"] . " est requis";
            }

            // Si le champ est de type email, on vérifie qu'il est valide
            if ($input["type"] == "email" && !self::checkEmail($data[$key])) {
                $errors[$key] = "Le champ " . $input["label"] . " n'est pas valide";
            }

            // Si le champ est de type password, on vérifie qu'il est valide
            if ($input["type"] == "password" && !isset($input["confirm"]) && !self::checkPassword($data[$key])) {
                $errors[$key] = "Le champ " . $input["label"] . " n'est pas valide";
            }

            // Si le champ est de type confirmation, on vérifie qu'ils correspondent
            if (isset($input["confirm"]) && $data[$key] !== $data[$input["confirm"]]) {
                $errors[$key] = "Le champ " . $input["label"] . " ne correspond pas";
            }

            // Si le champ est unique, on vérifie qu'il n'existe pas déjà
            if (isset($input["unicity"]) && !self::checkUnicity($key, $input["unicity"], $data[$key])) {
                $errors[$key] = "Le champ " . $input["label"] . " est déjà utilisé";
            }

            // Si le champ est de type string, on vérifie la longueur
            if ($input["type"] == "text" && (array_key_exists("minLength", $input) || array_key_exists("maxLength", $input)) && !self::checkStringLenght($data[$key], $input["minLength"] ?? null, $input["maxLength"] ?? null)) {
                if (array_key_exists("minLength", $input) && !array_key_exists("maxLength", $input))
                    $errors[$key] = "Le champ " . $input["label"] . " doit contenir au moins " . $input["minLength"] . " caractères";
                else if (array_key_exists("maxLength", $input) && !array_key_exists("minLength", $input))
                    $errors[$key] = "Le champ " . $input["label"] . " doit contenir au plus " . $input["maxLength"] . " caractères";
                else
                    $errors[$key] = "Le champ " . $input["label"] . " doit contenir entre " . $input["minLength"] . " et " . $input["maxLength"] . " caractères";
            }

            // Si le champ est de type number, on vérifie la valeur
            if ($input["type"] == "number" && !self::checkNumber($data[$key], $input["min"] ?? null, $input["max"] ?? null)) {
                if (isset($input["min"]) && !isset($input["max"]))
                    $errors[$key] = "Le champ " . $input["label"] . " doit être supérieur à " . $input["min"];
                else if (isset($input["max"]) && !isset($input["min"]))
                    $errors[$key] = "Le champ " . $input["label"] . " doit être inférieur à " . $input["max"];
                else
                    $errors[$key] = "Le champ " . $input["label"] . " doit être compris entre " . $input["min"] . " et " . $input["max"];
            }

            if (empty($errors[$key]))
                $config["inputs"][$key]["defaultValue"] = $data[$key];
        }

        $config["errors"] = $errors;
        return empty($errors);
    }

    public static function checkPassword(string $password): bool
    {
        if (strlen($password) < 8) {
            return false;
        }

        if (!preg_match("#[0-9]+#", $password)) {
            return false;
        }

        if (!preg_match("#[a-zA-Z]+#", $password)) {
            return false;
        }

        return true;
    }

    public static function checkEmail(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function checkStringLenght(string $string, ?int $min, ?int $max): bool
    {
        if (!empty($min) && strlen($string) < $min) {
            return false;
        }

        if (!empty($max) && strlen($string) > $max) {
            return false;
        }

        return true;
    }

    public static function checkNumber(int $number, ?int $min, ?int $max): bool
    {
        if (!empty($min) && $number < $min) {
            return false;
        }

        if (!empty($max) && $number > $max) {
            return false;
        }

        return true;
    }

    public static function checkUnicity(string $colName, string $model, string $value): bool
    {
        $model = new $model();
        $model = $model->getOneBy([$colName => $value], "object");

        if ($model) {
            return false;
        }

        return true;
    }
}
