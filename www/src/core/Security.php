<?php

namespace App\Core;

use App\Models\User;

class Security
{

    public function authenticate($data, &$user)
    {
        $user = (new User())->getOneBy(["email" => $data["email"]], "object");
        // var_dump($user);
        if (is_int($user) && $user == 0) {
            return false;
        }
        if ($user && password_verify($data["pwd"], $user->getPwd())) {

            if ($user->getStatus() !== User::_STATUS_INACTIVE) {
                // L'utilisateur est connecté, on le redirige vers la page d'accueil
                $_SESSION["user"] = [
                    "id" => $user->getId(),
                    "email" => $user->getEmail(),
                    "firstname" => $user->getFirstName(),
                    "lastname" => $user->getLastName(),
                    "status" => $user->getStatus(),
                    "role" => $user->getRole()
                ];

                // Si l'utilisateur a coché la case "Rester connecté", on stocke ses informations en cookie
                if (isset($data["remember"])) {
                    setcookie("user", json_encode($_SESSION["user"]), time() + 3600 * 24 * 30, "/");
                }
            }

            return true;
        }else{
            return false;
        }

    }
}
