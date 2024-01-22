<?php

namespace App\Forms;

class EmailServerConfig
{

    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/configuration/email",
                "class" => "form",
                "id" => "form-config-email-server",
                "submit" => "Sauvegarder",
                "error" => "Erreur lors de la sauvegarde de la configuration"
            ],
            "inputs" => [
                "smtpHost" => [
                    "label" => "Hôte SMTP",
                    "type" => "text",
                    "id" => "form-config-smtpHost",
                    "required" => true,
                    "placeholder" => "smtp.example.com",
                ],
                "smtpPort" => [
                    "label" => "Port SMTP",
                    "type" => "text",
                    "id" => "form-config-smtpPort",
                    "required" => true,
                    "placeholder" => "587",
                ],
                "smtpEncryption" => [
                    "label" => "Type d'encryption SMTP",
                    "type" => "select",
                    "id" => "form-config-smtpEncryption",
                    "required" => true,
                    "placeholder" => "tls",
                    "options" => [
                        "tls" => "TLS",
                        "ssl" => "SSL",
                    ]
                ],
                "smtpUsername" => [
                    "label" => "Adresse email SMTP",
                    "type" => "text",
                    "id" => "form-config-smtpUsername",
                    "required" => true,
                    "placeholder" => "jhon.doe@mail.fr",
                ],
                "smtpPassword" => [
                    "label" => "Mot de passe SMTP",
                    "type" => "password",
                    "id" => "form-config-smtpPassword",
                    "required" => true,
                    "placeholder" => "password",
                ],
            ]
        ];
    }
}
