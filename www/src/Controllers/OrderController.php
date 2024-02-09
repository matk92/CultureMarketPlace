<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Core\Verificator;
use App\Forms\AddProductToCart;
use App\Models\OrderSlot;
use App\Repository\OrderSlotRepository;

class OrderController
{

    public function index(): int
    {
        $view = new View("Order/orders", "front");

        if (array_key_exists('order_id', $_SESSION)) {
            $order = (new Order())->populate($_SESSION['order_id']);
            if (!empty($order)) {
                $orderSlots = (new OrderSlotRepository())->getOrderSlots($order->getId());
                $order->setOrderSlots($orderSlots);
                $view->assign("order", $order);
            } else {
                unset($_SESSION['order_id']);
            }
        }

        return http_response_code(200);
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

    public function updateOrderSlot()
    {
        if (empty($_SESSION['user'])) {
            http_response_code(401);
            header('Location: /login');
            exit();
        }
        if (empty($_SESSION['order_id'])) {
            http_response_code(400);
            exit();
        }

        if (isset($_GET['id'])) {
            $order = (new Order())->populate($_SESSION['order_id']);
            $activeOrderSlots = (new OrderSlotRepository())->getOrderSlots($_SESSION['order_id']);
            $orderSlot = (new OrderSlot())->populate($_POST['id']);
            if (in_array($orderSlot, $activeOrderSlots) && $order->getStatus() === 0) {
                $orderSlot->delete(true);
                http_response_code(204);
            } else {
                http_response_code(400);
            }
        } else if (isset($_POST['id']) && isset($_POST['quantity'])) {
            $activeOrderSlots = (new OrderSlotRepository())->getOrderSlots($_SESSION['order_id']);
            $orderSlot = (new OrderSlot())->populate($_POST['id']);
            if (in_array($orderSlot, $activeOrderSlots)) {
                $orderSlot->setQuantity($_POST['quantity']);
                $orderSlot->save();
                http_response_code(204);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(400);
        }
        return $_POST;
    }
}
