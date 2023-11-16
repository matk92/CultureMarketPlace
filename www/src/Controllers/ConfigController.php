<?php

namespace App\Controllers;

use App\Core\View;

class ConfigController
{

    public function Welcome(): void
    {
        new View("config/welcome", "frontConfig");
    }  
}