<?php

namespace App\Forms;

use App\Core\Form;

class Register extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form",
            "id" => "form-register",
            "submit" => "Créer compte",
            "error" => "Erreur lors de la création du compte"
        ];

        $this->inputs = [
            "name" => [
                "label" => "Prénom",
                "type" => "text",
                "id" => "form-register-name",
                "required" => true,
                "placeholder" => "Votre prénom",
            ],
            "lastname" => [
                "label" => "Nom",
                "type" => "text",
                "id" => "form-register-lastname",
                "required" => true,
                "placeholder" => "Votre nom",
            ],
            "email" => [
                "label" => "email",
                "type" => "email",
                "id" => "form-register-email",
                "required" => true,
                "placeholder" => "Votre email",
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
