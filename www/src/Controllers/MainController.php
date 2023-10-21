<?php

namespace App\Controllers;

use App\Core\View;

class MainController
{

    public function home(): void
    {
        new View("Main/home", "front");
    }

   
}
