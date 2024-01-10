<?php

namespace App\Controllers;

use App\Core\View;

class OrderController
{

    public function index(): void
    {
        new View("Order/orders", "front");
    }

    public function paymentInfo(): void
    {
        new View("Order/payment-info", "front");
    }

    public function summary(): void
    {
        new View("Order/summary", "front");
    }
   
}
