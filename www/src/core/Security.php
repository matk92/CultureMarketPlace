<?php

namespace App\Core;

use App\Models\User;

class Security
{

    public function authenticate($data, &$user)
    {
        $user = (new User())->getOneBy(["email" => $data["email"]], "object");

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

        return $user && password_verify($data["pwd"], $user->getPwd());
    }
}
