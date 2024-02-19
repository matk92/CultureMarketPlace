<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Core\Controller;
use App\Core\Mailer;
use App\Forms\CommentProduct;
use App\Repository\UserRepository;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;

class ReviewController extends Controller
{
    protected $reviewRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reviewRepository = new ReviewRepository();
    }

    public function evaluate(): void
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            header('Location: /admin/comments');
            exit();
        }

        $review = $this->reviewRepository->find((int) $_GET['id']);
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
        if (!isset($_POST['productid']) || $this->checkRole(User::_ROLE_USER) === false) {
            http_response_code(400);
            header('Location: /products?pid=' . $_POST['productid'] . '&errorComment=true');
            exit();
        }
        $product = (new ProductRepository())->find((int) $_POST['productid']);
        if (is_int($product) && $product === 0) {
            http_response_code(404);
            header('Location: /products?pid=' . $_POST['productid'] . '&errorComment=true');
            exit();
        }

        $form = new CommentProduct($product);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            // On vérifie que le formulaire est valide
            if ($this->verificator->checkForm($formConfig, $_POST) === true) {
                $review = $this->serializer->serialize($_POST, Review::class);
                $review->setUserId($this->user->getId());
                $review->save();

                // On envoie un mail aux modérateurs pour les prévenir qu'un commentaire a été ajouté
                $moderateurs = (new UserRepository())->findByRole(User::_ROLE_MODERATOR);

                foreach ($moderateurs as $moderateur) {
                    $this->mailer->sendMail(
                        $moderateur->getEmail(),
                        "Nouveau commentaire ajouté",
                        "Un nouveau commentaire a été ajouté sur le produit " . $product->getName() . " par " . $this->user->getFirstname() . " " . $this->user->getLastname() . ".
                        <br>
                        Veulliez le verifier à partir de ce lien : 
                            <br><br><a href='http://" . $_SERVER['HTTP_HOST'] . "/admin/comments'>Commentaires</a>"
                    );
                }

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
