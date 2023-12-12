<?php

namespace App\Controllers;

use App\Core\View;

class CartController
{

    public function cart(): void
    {
        new View("cart/cart", "frontCart");
    }  
}