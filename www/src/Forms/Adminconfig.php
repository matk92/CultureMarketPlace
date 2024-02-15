<?php

namespace App\Forms;

use App\Core\Form;

class Adminconfig extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "/configuration/admin",
            "class" => "form",
            "id" => "form-config-admin",
            "submit" => "Sauvegarder",
            "error" => "Erreur lors de la sauvegarde de la configuration"
        ];
        $this->inputs = [
            "pageTitle" => [
                "label" => "Titre du site",
                "type" => "text",
                "required" => true,
                "minLength" => 3,
                "id" => "form-config-pageTitle",
                "placeholder" => "Cultural Market Place",
            ],
            "firstName" => [
                "label" => "Votre prénom",
                "type" => "text",
                "id" => "form-config-firstName",
                "minLength" => 2,
                "required" => true,
                "placeholder" => "Jhon",
            ],
            "lastname" => [
                "label" => "Nom",
                "type" => "text",
                "id" => "form-register-lastname",
                "minLength" => 2,
                "required" => true,
                "placeholder" => "Doe",
            ],
            "email" => [
                "label" => "email",
                "type" => "email",
                "id" => "form-register-email",
                "required" => true,
                "placeholder" => "jhon.doe@mail.com",
                "unicity" => "App\Models\User",
            ],
            "pwd" => [
                "label" => "Mot de passe",
                "type" => "password",
                "id" => "form-register-pwd",
                "required" => true,
                "placeholder" => "Password...",
            ],
            "pwdConfirm" => [
                "label" => "Confirmer votre mot de passe",
                "type" => "password",
                "id" => "form-register-password-confirm",
                "required" => true,
                "placeholder" => "Retapez votre mot de passe...",
                "confirm" => "pwd"
            ]
        ];
        parent::__construct();
    }
}
