<?php

namespace App\Controllers;

use App\Core\View;

class SecurityController
{

    public function login(): void
    {
        new View("Security/login", "frontSecurity");
    }

    public function logout(): void
    {

        new View("Security/logout", "frontSecurity");
    }

    public function register(): void
    {
        new View("Security/register", "frontSecurity");
    }
}
