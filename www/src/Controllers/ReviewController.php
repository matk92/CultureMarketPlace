<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Review;
use App\Models\Product;
use App\Core\Verificator;
use App\Forms\CommentProduct;

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


    public function addComment(): void
    {
        if (!isset($_POST['productid']) || !isset($_SESSION['user'])) {
            http_response_code(400);
            header('Location: /products?pid=' . $_POST['productid'] . '&errorComment=true');
            exit();
        }
        $product = (new Product())->populate((int) $_POST['productid']);
        if (is_int($product) && $product === 0) {
            http_response_code(404);
            header('Location: /products?pid=' . $_POST['productid'] . '&errorComment=true');
            exit();
        }

        $form = new CommentProduct($product);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            // On vérifie que le formulaire est valide
            if ($verificatior->checkForm($formConfig, $_POST) === true) {
                $review = new Review();
                $review->setComment($_POST['comment']);
                $review->setRating($_POST['stars']);
                $review->setUserId($_SESSION['user']['id']);
                $review->setProductId($product->getId());
                $review->save();

                header('Location: /products?pid=' . $product->getId() . '&errorComment=false');
                exit();
            }
        } else {
            http_response_code(409);
        }

        header('Location: /products?pid=' . $product->getId() . '&errorComment=true');
        exit();
    }
}
