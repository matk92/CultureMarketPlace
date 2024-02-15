<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;
use App\Models\Category;
use App\Core\Verificator;
use App\Forms\AddProduct;
use App\Forms\EditProduct;
use App\Forms\AddProductToCart;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class ProductController
{

    public function index(): int
    {
        $_GET['filter'] = $_GET['filter'] ?? 0;

        $view = new View("Product/products", "front");
        if(isset($_GET['filter']) && $_GET['filter'] != 0){
            $products = (new ProductRepository())->getAllByCategory($_GET['filter']);
        } else {
            $products = (new ProductRepository())->getAll();
        }
        $filters = (new CategoryRepository())->getAll();

        if (isset($_GET['pid']) && $_GET['pid'] != "") {
            $displayProduct = (new Product())->populate((int) $_GET['pid']);
            $category = (new Category())->populate($displayProduct->getCategoryId());
            $comments = (new ReviewRepository())->getProductComments($displayProduct->getId());

            $form = new AddProductToCart($displayProduct, $category);
            $formConfig = $form->getConfig();
            $view->assign("form", $formConfig);
            $view->assign("displayProduct", $displayProduct);
            $view->assign("comments", $comments);
        }

        $view->assign("products", $products);
        $view->assign("filters", $filters);
        return http_response_code(200);
    }

    public function edit()
    {
        $view = new View("Admin/products", "frontAdmin");
        $categories = (new CategoryRepository())->getAll();
        $form = new EditProduct($categories);
        $formConfig = $form->getConfig();

        if (!isset($_GET['id'])) {
            http_response_code(400);
            header('Location: /admin/products');
            exit();
        }

        $editProduct = (new Product())->populate((int) $_GET['id']);
        if (!$editProduct) {
            http_response_code(404);
            header('Location: /admin/products');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            // On vérifie que le formulaire est valide
            if ($verificatior->checkForm($formConfig, array_merge($_POST, $_FILES)) === true) {
                $editProduct->setName($_POST["name"]);
                $editProduct->setDescription($_POST["description"]);
                $editProduct->setPrice($_POST["price"]);
                $editProduct->setStock($_POST["stock"]);
                $editProduct->setCategoryId($_POST["category"]);

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
                header('Location: /admin/products');
                exit();
            } else {
                $view->assign("form", $formConfig);
                http_response_code(409);
            }
        } else {
            $formConfig['inputs']['name']['defaultValue'] = $editProduct->getName();
            $formConfig['inputs']['description']['defaultValue'] = $editProduct->getDescription();
            $formConfig['inputs']['price']['defaultValue'] = $editProduct->getPrice();
            $formConfig['inputs']['stock']['defaultValue'] = $editProduct->getStock();
            $formConfig['inputs']['category']['defaultValue'] = $editProduct->getCategoryId();
            $formConfig['inputs']['image']['defaultValue'] = $editProduct->getImage();

            http_response_code(200);
        }


        $view->assign("form", $formConfig);
        $products = (new ProductRepository())->getAll();
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

        $product = (new Product())->populate((int) $id);
        if($product == 0){
            http_response_code(404);
            header('Location: /admin/products');
            exit();
        }

        $product->delete();

        header('Location: /admin/products');
        http_response_code(200);
    }
}
