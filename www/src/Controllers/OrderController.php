<?php

namespace App\Controllers;

use App\Core\View;

class OrderController
{

    public function index(): void
    {
        new View("Order/orders", "front");
    }

   
}
