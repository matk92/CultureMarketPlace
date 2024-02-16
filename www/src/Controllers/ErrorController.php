<?php

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller
{

    public function page404(): void
    {
        http_response_code(404);
        $errorCode = 404;
        include "src/Views/Templates/error.tpl.php";
    }

    public function page403(): void
    {
        http_response_code(403);
        $errorCode = 403;
        include "src/Views/Templates/error.tpl.php";
    }

    public function page405(): void
    {
        http_response_code(405);
        $errorCode = 405;
        include "src/Views/Templates/error.tpl.php";
    }
}
