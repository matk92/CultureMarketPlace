<?php

namespace App\Controllers;

class ErrorController {

    public function page404(): void
    {
        http_response_code(404);
        include "src/Views/Templates/error.tpl.php";
    }
}