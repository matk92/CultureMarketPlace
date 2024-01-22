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
        new View("Main/copyright");
    }

    public function legal(): void
    {
        new View("Main/legal");
    }

    public function privacy(): void
    {
        new View("Main/privacy");
    }

    public function refund(): void
    {
        new View("Main/refund");
    }

    public function terms(): void
    {
        new View("Main/terms");
    }
}
