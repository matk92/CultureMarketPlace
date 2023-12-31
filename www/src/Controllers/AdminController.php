<?php

namespace App\Controllers;

use App\Core\View;

class AdminController
{

    public function dashboard(): void
    {
        new View("Admin/dashboard", "frontAdmin");
    }
    
    public function pages(): void
    {
        new View("Admin/pages", "frontAdmin");
    }

    public function products(): void
    {
        new View("Admin/products", "frontAdmin");
    }

    public function settings(): void
    {
        new View("Admin/settings", "frontAdmin");
    }

    public function profile(): void
    {
        new View("Admin/profile", "frontAdmin");
    }

    public function notifications(): void
    {
        new View("Admin/notifications", "frontAdmin");
    }
}