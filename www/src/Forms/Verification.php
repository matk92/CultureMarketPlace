<?php

namespace App\Forms;

class Verification
{

    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/verification",
                "class" => "form",
                "id" => "form-verification",
                "submit" => "Vérifier",
                "error" => "Erreur lors de la verification du compte"
            ],
            "inputs" => [
                "code" => [
                    "label" => "Code de vérification",
                    "type" => "text",
                    "id" => "form-verification-code",
                    "required" => true,
                    "placeholder" => "xxx - xxx",
                    "minLength" => "6",
                    "maxLength" => "6",
                ],
            ]
        ];
    }
}
