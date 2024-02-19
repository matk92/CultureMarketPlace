<?php

namespace App\Forms;

use App\Core\Form;
use App\Models\User;

class AccountRecover extends Form
{


    public function __construct(User $user)
    {
        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form",
            "id" => "form-account-recover",
            "submit" => "Recuperer mon compte",
            "errorMessage" => "Erreur lors de la récupération du compte"
        ];

        $this->inputs = [
            "userid" => [
                "type" => "hidden",
                "defaultValue" => $user->getId()
            ],
        ];
        parent::__construct();
    }
}
