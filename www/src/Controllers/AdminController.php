<?php

namespace App\Controllers;

use App\Core\View;

class AdminController
{

    public function config(): void
    {
        new View("Admin/config", "front");
    }
}