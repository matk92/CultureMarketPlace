<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Verificator;
use App\Forms\AddProduct;
use App\Forms\EditProduct;
use App\Models\Product;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class AdminController
{

    public function dashboard(): void
    {
        new View("Admin/dashboard", "frontAdmin");
    }

    public function pages(): void
    {
        new View("Admin/pages", "frontAdmin");
    }

    public function products()
    {
        $view = new View("Admin/products", "frontAdmin");
        $categories = (new CategoryRepository())->getAll();
        $form = new AddProduct($categories);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            // On vérifie que le formulaire est valide
            if ($verificatior->checkForm($formConfig, array_merge($_POST, $_FILES)) === true) {
                $newProduct = new Product();
                $newProduct->setName($_POST["name"]);
                $newProduct->setDescription($_POST["description"]);
                $newProduct->setPrice($_POST["price"]);
                $newProduct->setStock($_POST["stock"]);
                $newProduct->setCategoryId($_POST["category"]);

                // Save image into folder "documents/product"
                $imageFolder = "documents/products/";
                $imageName = $newProduct->getName() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imagePath = $imageFolder . $imageName;
                $destination = __DIR__ . "/../../" . $imagePath;
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                // Save path in $newProduct->setImage()
                $newProduct->setImage($imagePath);

                // Save product in database
                $newProduct->save();

                http_response_code(201);
            } else {
                $view->assign("form", $formConfig);
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
        $products = (new ProductRepository())->getAll();
        $view->assign("products", $products);
    }

    public function settings(): void
    {
        new View("Admin/settings", "frontAdmin");
    }

    public function profile(): void
    {
        new View("Admin/profile", "frontAdmin");
    }

    public function notifications(): void
    {
        new View("Admin/notifications", "frontAdmin");
    }

    public function frameworksettings(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents(__DIR__ . '/../Views/Main/home.json');

            $data = json_decode($json, true);

            $data['site-name'] = htmlspecialchars($_POST['site-name']);
            $data['site-subtitle'] = htmlspecialchars($_POST['site-subtitle']);
            $data['footer-text'] = htmlspecialchars($_POST['footer-text']);
            $data['footer-facebook'] = htmlspecialchars($_POST['facebook-url']);
            $data['footer-twitter'] = htmlspecialchars($_POST['twitter-url']);
            $data['footer-instagram'] = htmlspecialchars($_POST['instagram-url']);
            $data['home-text1'] = htmlspecialchars($_POST['home-text1']);
            $data['home-text2'] = htmlspecialchars($_POST['home-text2']);
            $data['home-text3'] = htmlspecialchars($_POST['home-text3']);
            $data['home-discover-text'] = htmlspecialchars($_POST['home-discover-text']);

            //background image + favicon
            if (isset($_FILES['site-background-image']) && $_FILES['site-background-image']['error'] === 0) {
                $tmp_name = $_FILES['site-background-image']['tmp_name'];
                $name = 'background_img';
                $ext = pathinfo($_FILES['site-background-image']['name'], PATHINFO_EXTENSION);
                $new_name = $name . '.' . $ext;
                $destination = __DIR__ . '/../../assets/images/' . $new_name;

                move_uploaded_file($tmp_name, $destination);

                $data['site-background-image'] = $new_name . '?' . time();
            }

            if (isset($_FILES['site-favicon']) && $_FILES['site-favicon']['error'] === 0) {
                $tmp_name = $_FILES['site-favicon']['tmp_name'];
                $name = 'favicon';
                $ext = pathinfo($_FILES['site-favicon']['name'], PATHINFO_EXTENSION);
                $new_name = $name . '.' . $ext;
                $destination = __DIR__ . '/../../assets/images/' . $new_name;

                move_uploaded_file($tmp_name, $destination);

                $data['site-favicon'] = $new_name . '?' . time();
            }

            if (isset($_FILES['home-discover-image']) && $_FILES['home-discover-image']['error'] === 0) {
                $tmp_name = $_FILES['home-discover-image']['tmp_name'];
                $name = 'home_discover_img';
                $ext = pathinfo($_FILES['home-discover-image']['name'], PATHINFO_EXTENSION);
                $new_name = $name . '.' . $ext;
                $destination = __DIR__ . '/../../assets/images/' . $new_name;

                move_uploaded_file($tmp_name, $destination);

                $data['home-discover-image'] = $new_name . '?' . time();
            }

            $json = json_encode($data, JSON_PRETTY_PRINT);

            file_put_contents(__DIR__ . '/../Views/Main/home.json', $json);

            header('Location: /admin/settings');
            exit;
        } else {

            new View("Admin/frameworksettings", "frontAdmin");
        }
    }
}
