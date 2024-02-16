<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Core\Security;
use App\Models\Product;
use App\Core\Verificator;
use App\Forms\AddProduct;
use App\Forms\EditProduct;
use App\Forms\AccountRecover;
use App\Forms\UserInformation;
use App\Repository\UserRepository;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class AdminController
{

    public function dashboard(): void
    {
        $view = new View("Admin/dashboard", "frontAdmin");
        $productRepository = new ProductRepository();
        $productsSales = $productRepository->getSalesStats();
        $salesByMonth = $productRepository->getSalesByMonthStats();
        $salesByCategory = $productRepository->getSalesByCategoryStats();

        $view->assign("productsSales", json_encode($productsSales));
        $view->assign("salesByMonth", json_encode($salesByMonth));
        $view->assign("salesByCategory", json_encode($salesByCategory));
        http_response_code(200);
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
                $view->assign("added", true);
            } else {
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }

        try {
            $products = (new ProductRepository())->getAll();
        } catch (\Exception $e) {
            var_dump($e);
        }
        $view->assign("products", $products);
        $view->assign("form", $formConfig);
    }

    public function settings(): void
    {
        new View("Admin/settings", "frontAdmin");
    }

    public function profile(): void
    {
        if ($_SESSION["user"]["id"] == null) {
            header('Location: /login');
            exit();
        }
        $view = new View("Admin/profile", "frontAdmin");
        $user = (new User())->populate($_SESSION["user"]["id"]);
        $form = new UserInformation($user);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificator = new Verificator();
            if ($verificator->checkForm($formConfig, $_POST) === true) {
                $user->setFirstname($_POST["name"]);
                $user->setLastname($_POST["lastname"]);
                $user->save();

                $_SESSION["user"]["firstname"] = $user->getFirstname();
                $_SESSION["user"]["lastname"] = $user->getLastname();

                http_response_code(200);
            } else {
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
        $view->assign("user", $user);
    }

    public function comments(): void
    {
        $view =  new View("Admin/comments", "frontAdmin");
        $comments = (new ReviewRepository())->getNonEvaluated();
        $view->assign("comments", $comments);
    }

    public function users(): void
    {
        $view = new View("Admin/users", "frontAdmin");
        $users = (new UserRepository())->getAll();
        $view->assign("users", $users);
    }

    public function changeUserRole(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = (new User())->populate($_POST["id"]);

            if ($user) {
                $user->setRole($_POST["role"]);
                $user->save();
            }
        }

        header('Location: /admin/users');
        exit;
    }

    public function deleteUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            $id = $_GET['id'];
            $hardDelete = $_GET['hardDelete'] == 'true' ? true : false;

            if (empty($id)) {
                http_response_code(400);
                header('Location: /profile');
                exit();
            }

            $user = (new User())->populate((int) $id);
            if (is_int($user) &&  $user == 0) {
                http_response_code(404);
                header('Location: /profile');
                exit();
            }

            //Check that user is the current user or current user is admin
            $isSameUser = $user->getId() == $_SESSION['user']['id'];
            $isAdmin = $_SESSION['user']['role'] == 10;
            if ($isSameUser == false && $isAdmin == false) {
                http_response_code(403);
                header('Location: /profile');
                exit();
            }

            $user->setStatus(User::_STATUS_INACTIVE);
            $user->setRole(User::_ROLE_NONE);
            $user->delete($hardDelete);
            if ($isSameUser) {
                (new Security())->logout();
                header('Location: /user/delete');
                exit();
            }

            http_response_code(200);
        } else {
            $view = (new View("User/accountDeleted", "adveritsement"));
            if (array_key_exists('user', $_SESSION)) {
                $user = (new User())->populate($_SESSION['user']['id']);
                $form = new AccountRecover($user);
                $formConfig = $form->getConfig();

                if ($_SERVER['REQUEST_METHOD'] === $formConfig['config']['method']) {
                    $verificator = new Verificator();
                    if ($verificator->checkForm($formConfig, $_POST)) {
                        $user->setIsdeleted(false);
                        $user->save();
                        header('Location: /');
                        exit();
                    } else
                        http_response_code(409);
                }

                $view->assign("form", $formConfig);
            }
        }
    }

    public function frameworksettings(): void
    {
        $_SESSION['settings_success'] = "Les modifications ont été appliquées avec succès.";

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

            $data['background-color'] = htmlspecialchars($_POST['background-color']);
            $data['background-color2'] = htmlspecialchars($_POST['background-color2']);
            $data['title-color'] = htmlspecialchars($_POST['title-color']);
            $data['subtitle-color'] = htmlspecialchars($_POST['subtitle-color']);
            $data['nav-color'] = htmlspecialchars($_POST['nav-color']);
            $data['footer-color'] = htmlspecialchars($_POST['footer-color']);
            $data['home-discover-color'] = htmlspecialchars($_POST['home-discover-color']);

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

            // Générer le fichier SCSS avec les valeurs des variables
            $colors = [
                'background-color' => $data['background-color'],
                'background-color2' => $data['background-color2'],
                'title-color' => $data['title-color'],
                'subtitle-color' => $data['subtitle-color'],
                'nav-color' => $data['nav-color'],
                'footer-color' => $data['footer-color'],
                'home-discover-color' => $data['home-discover-color'],
            ];

            $scss = ":root {\n";
            foreach ($colors as $name => $value) {
                $scss .= "  --$name: {$value};\n";
            }
            $scss .= "}";

            file_put_contents(__DIR__ . '/../../assets/css/partials/_colors_pallet.scss', $scss);

            header('Location: /admin/settings');
            exit;
        } else {

            new View("Admin/frameworksettings", "frontAdmin");
        }
    }

    public function designGuide(): void
    {
        new View("Admin/designguide", "frontAdmin");
    }
}
