<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;
use App\Core\Controller;
use App\Forms\AddProduct;
use App\Repository\UserRepository;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class AdminController extends Controller
{

    // page Dashboard permettant de visualiser les statistiques de vente
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
            // On vérifie que le formulaire est valide
            if ($this->verificator->checkForm($formConfig, array_merge($_POST, $_FILES)) === true) {
                $newProduct = $this->serializer->serialize($_POST, Product::class);

                // Save image into folder "documents/product"
                $imageFolder = "documents/products/";
                if (!is_dir($imageFolder)) {
                    mkdir($imageFolder, 0777, true);
                }
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

        $products = (new ProductRepository())->getAll();
        $view->assign("products", $products);
        $view->assign("form", $formConfig);
    }

    public function settings(): void
    {
        new View("Admin/settings", "frontAdmin");
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

    public function resetUserPassword(): int
    {
        if (!isset($_GET['id'])) {
            return http_response_code(400);
        }

        $user = (new UserRepository())->find((int) $_GET['id']);
        if (is_int($user) && $user === 0) {
            return http_response_code(404);
        }

        $newPwd = $user->resetPassword();
        $user->save();
        // Envoyer code de verification pour l'activation du compte
        $succes = $this->mailer->sendMail(
            $user->getEmail(),
            "Réinitialisation de votre mot de passe",
            "<body>Bonjour " . $user->getFirstname() . " " . $user->getLastname() .
                ",<br><br>Vous avez demandé la réinitialisation de votre mot de passe sur notre site." .
                ",<br><br>Voici votre nouveau mot de passe : <b>" . $newPwd .
                "</b><br><br>Cordialement,<br>L'équipe de " . $this->siteName . "
                        </body>"
        );

        return http_response_code($succes ? 200 : 409);
    }
}
