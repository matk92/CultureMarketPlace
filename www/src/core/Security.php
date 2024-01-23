<?php

namespace App\Core;

use App\Models\User;

class Security
{

    public function login($data, &$user)
    {
        $user = (new User())->getOneBy(["email" => $data["email"]], "object");

        return $user && password_verify($data["pwd"], $user->getPwd());
    }
}
