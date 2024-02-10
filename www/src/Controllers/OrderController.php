<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Core\Serializer;
use App\Models\Category;
use App\Core\Verificator;
use App\Models\OrderSlot;
use App\Forms\PaymentForm;
use App\Models\PaymentMethod;
use App\Forms\AddProductToCart;
use App\Models\PaymentMethodType;
use App\Forms\ValidatePaymentForm;
use App\Repository\OrderRepository;
use App\Repository\OrderSlotRepository;
use App\Repository\PaymentRepository;

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
        if (empty($_SESSION['user'])) {
            http_response_code(401);
            header('Location: /login');
            exit();
        }
        if (!array_key_exists('order_id', $_SESSION)) {
            http_response_code(400);
            header('Location: /orders');
            exit();
        }

        if (isset($_SESSION['payment_id']) || isset($_SESSION['paymentMethodId'])) {
            $paymentMethod = (new Payment())->populate($_SESSION['payment_id'] ?? $_SESSION['paymentMethodId'])->getPaymentMethod();
        }

        $view = new View("Order/payment-info", "front");
        $form = new PaymentForm($paymentMethod);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $order = (new Order())->populate($_SESSION['order_id']);
            if (!empty($order)) {
                $verificatior = new Verificator();
                // On vérifie que le formulaire est valide
                if ($verificatior->checkForm($formConfig, $_POST)) {
                    $paymentMethod  = (new Serializer())->serialize($_POST, PaymentMethod::class);
                    $paymentMethod->setUserId($_SESSION['user']['id']);
                    $paymentMethod->setPaymentMethodTypeId((new PaymentMethodType())->getOneBy(["name" => "Carte bancaire"])["id"]);
                    $paymentMethod->save();

                    if ($_POST['savePaymentMethod'] === "on") {
                        $_SESSION['paymentMethodId'] = $paymentMethod->getId();
                    }else {
                        unset($_SESSION['paymentMethodId']);
                    }

                    $payment = new Payment();
                    $payment->setOrderId($order->getId());
                    $payment->setPaymentMethodId($paymentMethod->getId());
                    $payment->setStatus(0);
                    $payment->save();

                    $_SESSION['payment_id'] = $payment->getId();


                    http_response_code(204);
                    header('Location: /orders/summary');
                    exit();
                } else {
                    http_response_code(400);
                }
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
    }

    public function summary(): void
    {
        if (empty($_SESSION['user'])) {
            http_response_code(401);
            header('Location: /login');
            exit();
        }
        if (!array_key_exists('order_id', $_SESSION) || !array_key_exists('payment_id', $_SESSION)) {
            http_response_code(400);
            header('Location: /orders');
            exit();
        }

        $order = (new OrderRepository())->find($_SESSION['order_id']);
        $payment = (new PaymentRepository())->find($_SESSION['payment_id']);
        $order->setOrderSlots((new OrderSlotRepository())->getOrderSlots($order->getId()));

        if (empty($order) || empty($payment)) {
            http_response_code(400);
            header('Location: /orders');
            exit();
        }

        $view = new View("Order/summary", "front");
        $form = new ValidatePaymentForm();
        $formConfig = $form->getConfig();


        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            // On vérifie que le formulaire est valide
            if ($verificatior->checkForm($formConfig, $_POST)) {
                $payment->setStatus(Payment::STATUS_PAID);
                $payment->save();
                $order->setStatus(Order::STATUS_PAID);
                $order->save();

                unset($_SESSION['order_id']);
                unset($_SESSION['payment_id']);

                http_response_code(204);
                header('Location: /orders/completed');
                exit();
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
        $view->assign("order", $order);
        $view->assign("payment", $payment);
    }

    public function completed(): void
    {
        if (empty($_SESSION['user'])) {
            http_response_code(401);
            header('Location: /login');
            exit();
        }

        $view = new View("Order/completed", "front");
        http_response_code(200);
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
        $orderSlotRepository = new OrderSlotRepository();
        $order = (new Order())->populate($_SESSION['order_id']);
        if (empty($order)) {
            http_response_code(400);
            exit();
        }
        if ($order->getStatus() !== 0) {
            http_response_code(400);
            echo "La commande ne peut plus être modifiée";
            exit();
        }

        if (isset($_GET['id'])) {
            $activeOrderSlots = $orderSlotRepository->getOrderSlots($_SESSION['order_id']);
            $ids = array_map(function ($orderSlot) {
                return $orderSlot->getId();
            }, $activeOrderSlots);

            $orderSlot = $orderSlotRepository->find($_GET['id']);
            if (!empty($orderSlot) && in_array($orderSlot->getId(), $ids)) {
                $orderSlot->delete(true);
                http_response_code(200);
                echo "Le produit a bien été supprimé";
                exit();
            } else {
                http_response_code(400);
                echo "Le produit n'existe pas ou ne fait pas partie de votre commande";
                exit();
            }
        } else if (isset($_POST['id']) && isset($_POST['quantity'])) {
            $activeOrderSlots = $orderSlotRepository->getOrderSlots($_SESSION['order_id']);
            $ids = array_map(function ($orderSlot) {
                return $orderSlot->getId();
            }, $activeOrderSlots);

            $orderSlot = $orderSlotRepository->find($_POST['id']);
            if (!empty($orderSlot) && in_array($orderSlot->getId(), $ids)) {
                if ($_POST['quantity'] > 0 & $_POST['quantity'] <= $orderSlot->getProduct()->getStock()) {
                    $orderSlot->setQuantity($_POST['quantity']);
                    $orderSlot->save();
                    http_response_code(200);
                    echo "La quantité a bien été modifiée";
                    exit();
                } else {
                    http_response_code(400);
                    echo "La quantité doit être comprise entre 1 et " . $orderSlot->getProduct()->getStock();
                    exit();
                }
            } else {
                http_response_code(400);
                echo "Le produit n'existe pas ou ne fait pas partie de votre commande";
                exit();
            }
        } else {
            http_response_code(400);
            echo "Requête invalide";
            exit();
        }
    }
}
