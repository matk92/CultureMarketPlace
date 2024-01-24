<?php

namespace App\Forms;

class PasswordReset
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
                "id" => "form-login",
                "submit" => "Réinitialiser",
            ],
            "inputs" => [
                "email" => [
                    "label" => "email",
                    "type" => "email",
                    "id" => "form-login-email",
                    "required" => true,
                    "placeholder" => "Votre email",
                ],
            ]
        ];
    }
}
