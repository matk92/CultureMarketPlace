<?php

namespace App\Controllers;

use App\Core\View;

class AdminController
{

    public function dashboard(): void
    {
        new View("Admin/dashboard", "frontAdmin");
    }
}