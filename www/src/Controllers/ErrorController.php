<?php

namespace App\Controllers;

class ErrorController {

    public function page404(): void
    {
        http_response_code(404);
        echo "<img src='assets/images/error404.jpg'width='100%' height='auto'>";
    }
}