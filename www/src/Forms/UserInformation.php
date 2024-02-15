<?php

namespace App\Forms;

use App\Core\Form;
use App\Models\User;

class UserInformation extends Form
{

    public function __construct(User $user)
    {
        parent::__construct();

        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "profileFormAdmin",
            "id" => "form-profile",
            "submit" => "Enregistrer les modifications",
            "error" => "Erreur lors de la modification du profil"
        ];
        $this->inputs = [
            "name" => [
                "label" => "Prénom",
                "type" => "text",
                "id" => "form-profil-name",
                "class" => "input-box-user",
                "defaultValue" => $user->getFirstname(),
                "required" => true,
                "placeholder" => "Votre prénom",
            ],
            "lastname" => [
                "label" => "Nom",
                "type" => "text",
                "id" => "form-profil-lastname",
                "class" => "input-box-user",
                "defaultValue" => $user->getLastname(),
                "required" => true,
                "placeholder" => "Votre nom",
            ],
        ];
    }
}
