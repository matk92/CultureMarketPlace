<?php

namespace App\Forms;

class BDDconfig
{

    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/configuration/bdd",
                "class" => "form",
                "id" => "form-config-bdd",
                "submit" => "Sauvegarder",
                "error" => "Erreur lors de la sauvegarde de la configuration"
            ],
            "inputs" => [
                "bddPrefix" => [
                    "label" => "Prefix de la base de données",
                    "type" => "text",
                    "id" => "form-config-bddPrefix",
                    "required" => true,
                    "minlength" => 3,
                    "maxlength" => 10,
                    "placeholder" => "rbnm",
                ],
                "bddName" => [
                    "label" => "Nom de la base de données",
                    "type" => "text",
                    "id" => "form-config-bddName",
                    "minlength" => 3,
                    "maxlength" => 10,
                    "required" => true,
                    "placeholder" => "cmp",
                ],
                "bddUser" => [
                    "label" => "Utilisateur de la base de données",
                    "type" => "text",
                    "id" => "form-config-bddUser",
                    "required" => true,
                    "maxlength" => 10,
                    "placeholder" => "root",
                ],
                "bddPassword" => [
                    "label" => "Mot de passe de l'utilisateur",
                    "type" => "password",
                    "id" => "form-config-bddPassword",
                    "required" => true,
                    "placeholder" => "********",
                ],
            ]
        ];
    }
}
