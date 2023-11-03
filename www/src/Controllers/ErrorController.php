<?php

namespace App\Controllers;

class ErrorController {

    public function page404(): void
    {
        http_response_code(404);
        echo "error 404, la page demandée n'existe pas";
    }
}