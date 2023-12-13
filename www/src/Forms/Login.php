<?php
namespace App\Forms;
class Login
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"form",
                "id"=>"form-login",
                "submit"=>"Connexion",
                "error"=>"Identifiants incorrects"
            ],
            "inputs"=>[
                "email"=>[
                    "label" => "email",
                    "type"=>"email",
                    "id"=>"form-login-email",
                    "required"=>true,
                    "placeholder"=>"Votre email",
                    "class"=>"form-input",
                ],
                "pwd"=>[
                    "label" => "Mot de passe",
                    "type"=>"password",
                    "id"=>"form-login-pwd",
                    "required"=>true,
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-input",
                ]
            ]
        ];
    }

}