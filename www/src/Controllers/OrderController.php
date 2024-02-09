<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Core\Verificator;
use App\Forms\AddProductToCart;

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


    public function addProduct(): void
    {

        if (empty($_SESSION['user'])) {
            http_response_code(401);
            header('Location: /login');
            exit();
        }

        $displayProduct = (new Product())->populate((int) $_POST['productid']);
        $category = (new Category())->populate($displayProduct->getCategoryId());
        $form = new AddProductToCart($displayProduct, $category);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {

            $verificatior = new Verificator();
            // On vérifie que le formulaire est valide
            if ($verificatior->checkForm($formConfig, $_POST)) {

                if (array_key_exists('order_id', $_SESSION)) {
                    $order = (new Order())->populate($_SESSION['order_id']);
                } else {
                    $order = new Order();
                    $order->setUserId($_SESSION['user']['id']);
                    $order->setStatus(0);
                    $order->save();
                    $_SESSION['order_id'] = $order->getId();
                }

                $order->addOrderSlot($displayProduct, $_POST['quantity']);
            }
        }

        http_response_code(204);
        header('Location: /products');
        exit();
    }
}
