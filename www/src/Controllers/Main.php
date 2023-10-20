<?php

namespace App\Controllers;

class Main
{

    public function home(): void
    {
        new View("Views/Main/home.view.php");
    }

   
}
