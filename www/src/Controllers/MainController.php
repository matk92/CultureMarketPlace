<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class MainController
{

    public function home(): void
    {
        new View("Main/home");
    }

    public function copyright(): void
    {
        new View("legal/copyright");
    }

    public function legal(): void
    {
        new View("legal/legalTerms");
    }

    public function privacy(): void
    {
        new View("legal/privacyPolicy");
    }

    public function refund(): void
    {
        new View("legal/refundPolicy");
    }

    public function terms(): void
    {
        new View("legal/termsConditionsSales");
    }
}
