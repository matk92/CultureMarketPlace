<?php

namespace App\Controllers;

class ErrorController {

    public function page404(): void
    {
        http_response_code(404);
        include "src/Views/Templates/error.tpl.php";
    }

    public function page403(): void
    {
        http_response_code(403);
        // TODO page
        include "src/Views/Templates/error.tpl.php";
    }

    public function page405(): void
    {
        http_response_code(405);
        // TODO page
        include "src/Views/Templates/error.tpl.php";
    }
}