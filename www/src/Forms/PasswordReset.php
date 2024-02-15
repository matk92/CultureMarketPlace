<?php

namespace App\Forms;

use App\Core\Form;

class PasswordReset extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form",
            "id" => "form-login",
            "submit" => "Réinitialiser",
        ];
        $this->inputs = [
            "email" => [
                "label" => "email",
                "type" => "email",
                "id" => "form-login-email",
                "required" => true,
                "placeholder" => "Votre email",
            ],
        ];
        parent::__construct();
    }
}
