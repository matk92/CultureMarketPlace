<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;
use App\Core\Controller;
use App\Forms\EditProduct;
use App\Forms\CommentProduct;
use App\Forms\AddProductToCart;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class ProductController extends Controller
{

    protected ProductRepository $productRepository;
    protected CategoryRepository $categoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->productRepository = new ProductRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function index(): int
    {
        $_GET['filter'] = $_GET['filter'] ?? 0;

        $view = new View("Product/products", "front");
        if (isset($_GET['filter']) && $_GET['filter'] != 0) {
            $products = $this->productRepository->getAllByCategory($_GET['filter']);
        } else {
            $products = $this->productRepository->getAll();
        }
        $filters = $this->categoryRepository->getAll();

        if (isset($_GET['pid']) && $_GET['pid'] != "") {
            $displayProduct = $this->productRepository->find((int) $_GET['pid']);
            if (is_int($displayProduct) && $displayProduct == 0) {
                http_response_code(404);
                header('Location: /products');
                exit();
            }
            $view->assign("displayProduct", $displayProduct);

            $form = new AddProductToCart($displayProduct);
            $formConfig = $form->getConfig();
            $view->assign("form", $formConfig);

            $formComment = new CommentProduct($displayProduct);
            $formCommentConfig = $formComment->getConfig();
            $view->assign("formComment", $formCommentConfig);

            $comments = (new ReviewRepository())->getProductComments($displayProduct->getId());
            $view->assign("comments", $comments);
        }

        $view->assign("products", $products);
        $view->assign("filters", $filters);
        return http_response_code(200);
    }

    public function edit()
    {
        $view = new View("Admin/products", "frontAdmin");

        if (!isset($_GET['id'])) {
            http_response_code(400);
            header('Location: /admin/products');
            exit();
        }

        $editProduct = $this->productRepository->find((int) $_GET['id']);
        if (is_int($editProduct) && $editProduct == 0) {
            http_response_code(404);
            header('Location: /admin/products');
            exit();
        }

        $categories = $this->categoryRepository->getAll();
        $form = new EditProduct($editProduct, $categories);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            // On vérifie que le formulaire est valide
            if ($this->verificator->checkForm($formConfig, array_merge($_POST, $_FILES)) === true) {
                $editProduct = $this->serializer->serialize($_POST, Product::class, $editProduct);

                if (!empty($_FILES['image']['name'])) {
                    // Save image into folder "documents/product"
                    $imageFolder = "documents/products/";
                    $imageName = $editProduct->getName() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $imagePath = $imageFolder . $imageName;
                    $destination = __DIR__ . "/../../" . $imagePath;
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    // Save path in $editProduct->setImage()
                    $editProduct->setImage($imagePath);
                }

                // Save product in database
                $editProduct->save();

                http_response_code(200);
            } else {
                $view->assign("form", $formConfig);
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }


        $view->assign("form", $formConfig);
        $products = $this->productRepository->getAll();
        $view->assign("products", $products);
    }

    public function delete(): void
    {
        $id = $_GET['id'];

        if (empty($id)) {
            http_response_code(400);
            header('Location: /admin/products');
            exit();
        }

        $product = $this->productRepository->find((int) $id);
        if (is_int($product) && $product == 0) {
            http_response_code(404);
            header('Location: /admin/products');
            exit();
        }

        $product->delete(true);

        header('Location: /admin/products');
        http_response_code(200);
    }
}
