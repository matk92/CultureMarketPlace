<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Review;

class ReviewController
{

    public function evaluate(): void
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            header('Location: /admin/comments');
            exit();
        }

        $review = (new Review())->populate((int) $_GET['id']);
        if (!$review) {
            http_response_code(404);
            header('Location: /admin/comments');
            exit();
        }

        $review->setIsApproved($_GET["isapproved"] === "true");
        $review->save();

        http_response_code(200);
        header('Location: /admin/comments');
        exit();

    }
}
