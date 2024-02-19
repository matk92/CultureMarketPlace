<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Mailer;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Core\Controller;
use App\Forms\PaymentForm;
use App\Models\PaymentMethod;
use App\Forms\AddProductToCart;
use App\Models\PaymentMethodType;
use App\Forms\ValidatePaymentForm;
use App\Repository\OrderRepository;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use App\Repository\OrderSlotRepository;
use App\Repository\PaymentMethodRepository;

class OrderController extends Controller
{
    protected OrderRepository $orderRepository;
    protected ?Order $order = null;
    protected ?Payment $payment = null;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = new OrderRepository();

        // Si l'utilisateur a une commande en cours, on la récupère
        if (array_key_exists('order_id', $_SESSION)) {
            $this->order = $this->orderRepository->find((int) $_SESSION['order_id']);
            if (is_int($this->order) && $this->order === 0) {
                unset($_SESSION['order_id']);
            }
            // On verifie que la commande correspond bien à l'utilisateur
            if ($this->order->getUserId() !== $this->user->getId()) {
                unset($_SESSION['order_id']);
                $this->order = null;
            }
        }

        // Si l'utilisateur a un paiement en cours, on le récupère
        if (array_key_exists('payment_id', $_SESSION)) {
            $this->payment = (new PaymentRepository())->find($_SESSION['payment_id']);
            if (is_int($this->payment) && $this->payment === 0) {
                unset($_SESSION['payment_id']);
            }
            // On verifie que le paiement correspond bien à l'utilisateur
            if ($this->payment->getOrder()->getUserId() !== $this->user->getId()) {
                unset($_SESSION['payment_id']);
                $this->payment = null;
            }
        }
    }

    public function index(): int
    {
        $view = new View("Order/orders", "front");

        if (!empty($this->order)) {
            $orderSlots = (new OrderSlotRepository())->getOrderSlots($this->order->getId());
            $this->order->setOrderSlots($orderSlots);
            $view->assign("order", $this->order);
        }

        return http_response_code(200);
    }

    public function paymentInfo(): void
    {
        if ($this->checkRole(User::_ROLE_USER) === false) {
            http_response_code(403);
            if ($this->user === null)
                header('Location: /login');
            exit();
        }

        if (empty($this->order)) {
            http_response_code(400);
            header('Location: /orders');
            exit();
        }

        $paymentMethod = null;
        if (!isset($_SESSION['payment_id']) && isset($_SESSION['paymentMethodId'])) {
            $paymentMethod = (new PaymentMethodRepository())->find((int) $_SESSION['paymentMethodId']);
        } else if (isset($_SESSION['payment_id'])) {
            $paymentMethod = (new PaymentRepository())->find($_SESSION['payment_id'])->getPaymentMethod();
        }

        $view = new View("Order/payment-info", "front");
        $form = new PaymentForm($paymentMethod);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            // On vérifie que le formulaire est valide
            if ($this->verificator->checkForm($formConfig, $_POST)) {
                $paymentMethod  = $this->serializer->serialize($_POST, PaymentMethod::class);
                $paymentMethod->setUserId($this->user->getId());
                $paymentMethod->setPaymentMethodTypeId((new PaymentMethodType())->getOneBy(["name" => "Carte bancaire"])["id"]);
                $paymentMethod->save();

                if ($_POST['savePaymentMethod'] === "on") {
                    $_SESSION['paymentMethodId'] = $paymentMethod->getId();
                } else {
                    unset($_SESSION['paymentMethodId']);
                }

                $payment = new Payment();
                $payment->setOrderId($this->order->getId());
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
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
    }

    public function summary(): void
    {
        if ($this->checkRole(User::_ROLE_USER) === false) {
            http_response_code(403);
            if ($this->user === null)
                header('Location: /login');
            exit();
        }
        if (empty($this->order) || empty($this->payment)) {
            http_response_code(400);
            header('Location: /orders');
            exit();
        }

        $orderSlots = (new OrderSlotRepository())->getOrderSlots($this->order->getId());
        $this->order->setOrderSlots($orderSlots);

        $view = new View("Order/summary", "front");
        $form = new ValidatePaymentForm();
        $formConfig = $form->getConfig();


        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            // On vérifie que le formulaire est valide
            if ($this->verificator->checkForm($formConfig, $_POST)) {
                $this->payment->setStatus(Payment::STATUS_PAID);
                $this->payment->save();
                $this->order->setStatus(Order::STATUS_PAID);
                $this->order->save();

                unset($_SESSION['order_id']);
                unset($_SESSION['payment_id']);

                http_response_code(204);
                header('Location: /orders/completed');
                exit();
            } else {
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
        $view->assign("order", $this->order);
        $view->assign("payment", $this->payment);
    }

    public function completed(): void
    {
        if ($this->checkRole(User::_ROLE_USER) === false) {
            http_response_code(403);
            if ($this->user === null)
                header('Location: /login');
            exit();
        }

        $mailer = new Mailer();
        // Envoyer mail de confirmation
        $mailer->sendMail(
            $this->user->getEmail(),
            "Cultural Market Place - Commande validée",
            "<body>Bonjour " . $this->user->getFirstName() . " " . $this->user->getLastName() .
                ",<br><br>Votre commande a bien été validée.<br><br>Cordialement,<br>L'équipe de Cultural Market Place</body>"
        );
        new View("Order/completed", "front");
        http_response_code(200);
    }


    public function addProduct(): void
    {
        if (!array_key_exists('productid', $_POST) || !array_key_exists('quantity', $_POST)) {
            http_response_code(400);
            exit();
        }
        if ($this->checkRole(User::_ROLE_USER) === false) {
            http_response_code(403);
            if ($this->user === null)
                header('Location: /login');
            exit();
        }

        $displayProduct = (new ProductRepository())->find((int) $_POST['productid']);
        if (is_int($displayProduct) && $displayProduct === 0) {
            http_response_code(404);
            header('Location: /products');
            exit();
        }

        $form = new AddProductToCart($displayProduct);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {

            // On vérifie que le formulaire est valide
            if ($this->verificator->checkForm($formConfig, $_POST)) {

                if (empty($this->order)) {
                    $this->order = new Order();
                    $this->order->setUserId($this->user->getId());
                    $this->order->setStatus(0);
                    $this->order->save();
                    $_SESSION['order_id'] = $this->order->getId();
                }

                $this->order->addOrderSlot($displayProduct, $_POST['quantity']);
            }
        }

        http_response_code(204);
        header('Location: /products');
        exit();
    }

    public function updateOrderSlot()
    {
        if ($this->checkRole(User::_ROLE_USER) === false) {
            http_response_code(403);
            if ($this->user === null)
                header('Location: /login');
            exit();
        }
        if (empty($this->order)) {
            http_response_code(400);
            exit();
        }
        // On vérifie que la commande n'est pas déjà payée
        if ($this->order->getStatus() !== 0) {
            http_response_code(400);
            echo "La commande ne peut plus être modifiée";
            exit();
        }

        $orderSlotRepository = new OrderSlotRepository();
        if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] === "DELETE") {
            $activeOrderSlots = $orderSlotRepository->getOrderSlots($this->order->getId());
            $ids = array_map(function ($orderSlot) {
                return $orderSlot->getId();
            }, $activeOrderSlots);

            $orderSlot = $orderSlotRepository->find($_GET['id']);
            if (!empty($orderSlot) && in_array($orderSlot->getId(), $ids)) {
                $orderSlot->delete(true, false);
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
