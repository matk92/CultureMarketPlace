<?php

namespace App\Forms;

use App\Core\Form;

class BDDconfig extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "/configuration/bdd",
            "class" => "form",
            "id" => "form-config-bdd",
            "submit" => "Sauvegarder",
            "error" => "Erreur lors de la sauvegarde de la configuration"
        ];
        $this->inputs = [
            "bddPrefix" => [
                "label" => "Prefix de la base de données",
                "type" => "text",
                "defaultValue" => "rbnm",
                "id" => "form-config-bddPrefix",
                "required" => true,
                "minLength" => 3,
                "maxLength" => 10,
                "placeholder" => "rbnm",
            ],
            "bddName" => [
                "label" => "Nom de la base de données",
                "type" => "text",
                "defaultValue" => "cmp",
                "id" => "form-config-bddName",
                "minLength" => 3,
                "maxLength" => 10,
                "required" => true,
                "placeholder" => "cmp",
            ],
            "bddUser" => [
                "label" => "Utilisateur de la base de données",
                "type" => "text",
                "id" => "form-config-bddUser",
                "required" => true,
                "maxLength" => 10,
                "placeholder" => "admin",
            ],
            "bddPassword" => [
                "label" => "Mot de passe de l'utilisateur",
                "type" => "password",
                "id" => "form-config-bddPassword",
                "required" => true,
                "placeholder" => "********",
            ],
        ];
        parent::__construct();
    }
}
