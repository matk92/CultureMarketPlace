<?php

namespace App\Forms;

use App\Core\Form;

class Login extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form",
            "id" => "form-login",
            "submit" => "Connexion",
            "errorMessage" => "Identifiants incorrects"
        ];
        $this->inputs = [
            "email" => [
                "label" => "email",
                "type" => "email",
                "id" => "form-login-email",
                "required" => true,
                "placeholder" => "Votre email",
            ],
            "pwd" => [
                "label" => "Mot de passe",
                "type" => "password",
                "id" => "form-login-pwd",
                "required" => true,
                "placeholder" => "Votre mot de passe",
                "dismissible" => "true",
            ],
            "remember" => [
                "label" => "Rester connecté",
                "type" => "checkbox",
                "id" => "form-login-remember",
                "placeholder" => "",
                "class" => "rememberme-security",
            ],
        ];
        parent::__construct();
    }
}
