<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class MainController
{

    public function home(): void
    {
        new View("Main/home", "front");
    }

    public function copyright(): void
    {
        new View("legal/copyright", "front");
    }

    public function legal(): void
    {
        new View("legal/legalTerms", "front");
    }

    public function privacy(): void
    {
        new View("legal/privacyPolicy", "front");
    }

    public function refund(): void
    {
        new View("legal/refundPolicy", "front");
    }

    public function terms(): void
    {
        new View("legal/termsConditionsSales", "front");
    }
}
