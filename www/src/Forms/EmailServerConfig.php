<?php

namespace App\Forms;

use App\Core\Form;

class EmailServerConfig extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "/configuration/email",
            "class" => "form",
            "id" => "form-config-email-server",
            "submit" => "Sauvegarder",
            "errorMessage" => "Erreur lors de la sauvegarde de la configuration"
        ];
        $this->inputs = [
            "smtpHost" => [
                "label" => "Hôte SMTP",
                "type" => "select",
                "id" => "form-config-smtpHost",
                "required" => true,
                "placeholder" => "smtp.example.com",
                "options" => [
                    "smtp.office365.com,587,TLS" => "smtp.office365.com - TLS",
                    "smtp-mail.outlook.com,587,TLS" => "smtp-mail.outlook.com - TLS",
                    "smtp.gmail.com,587,TLS" => "smtp.gmail.com - TLS",
                    "smtp.gmail.com,465,SSL" => "smtp.gmail.com - SSL",
                    "smtp.mail.yahoo.com,587,TLS" => "smtp.mail.yahoo.com - TLS",
                    "smtp.mail.yahoo.com,465,TLS" => "smtp.mail.yahoo.com - TLS",
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
        ];
        parent::__construct();
    }
}
