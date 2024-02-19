<?php

namespace App\Forms;

use App\Core\Form;

class Verification extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "/verification",
            "class" => "form",
            "id" => "form-verification",
            "submit" => "Vérifier",
            "errorMessage" => "Erreur lors de la verification du compte"
        ];
        $this->inputs = [
            "code" => [
                "label" => "Code de vérification",
                "type" => "text",
                "id" => "form-verification-code",
                "required" => true,
                "placeholder" => "xxx - xxx",
                "minLength" => "6",
                "maxLength" => "6",
                "dismissible" => "true",
            ],
        ];
        parent::__construct();
    }
}
