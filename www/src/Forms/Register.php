<?php

namespace App\Forms;

class Register
{

    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "form",
                "id" => "form-register",
                "submit" => "Créer compte",
                "error" => "Erreur lors de la création du compte"
            ],
            "inputs" => [
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
                    "id" => "form-register-passwordconfirm",
                    "required" => true,
                    "placeholder" => "Retapez votre mot de passe...",
                ]
            ]
        ];
    }
}
