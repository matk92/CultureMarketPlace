<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class MainController
{

    public function home(): void
    {
        new View("Main/home", "front");
    }

    public function copyright(): void
    {
        new View("legal/copyright");
    }

    public function legal(): void
    {
        new View("legal/legal");
    }

    public function privacy(): void
    {
        new View("legal/privacy");
    }

    public function refund(): void
    {
        new View("legal/refund");
    }

    public function terms(): void
    {
        new View("legal/terms");
    }
}
