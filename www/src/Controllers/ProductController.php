<?php

namespace App\Controllers;

use App\Core\View;

class ProductController
{

    public function index(): void
    {
        

        new View("Product/products", "front");
    }

   
}
