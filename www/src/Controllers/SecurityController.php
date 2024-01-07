<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\Login;
use App\Forms\Register;
use App\Models\User;

class SecurityController
{

    public function login(): void
    {
        $form = new Login();
        $formConfig = $form->getConfig();

        $view = new View("Security/login", "frontSecurity");
        $view->assign("form", $formConfig);
    }

    public function logout(): void
    {
        new View("Security/logout", "frontSecurity");
    }

    public function register(): int|bool
    {
        $form = new Register();
        $formConfig = $form->getConfig();

        $view = new View("Security/register", "frontSecurity");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            // if its method GET
            return http_response_code(200);
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $exist = (new User())->getOneBy(["email" => $_POST["email"]]);

            if ($exist) {
                $formConfig["config"]["errorMessage"] = "Cet email est déjà utilisé";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            // if its method POST
            $myUser = new User();
            $myUser->setFirstName($_POST["name"]);
            $myUser->setLastName($_POST["lastname"]);
            $myUser->setEmail($_POST["email"]);
            $myUser->setPwd($_POST["pwd"]);
            $myUser->save();

            return http_response_code(201);
        }
    }
}
