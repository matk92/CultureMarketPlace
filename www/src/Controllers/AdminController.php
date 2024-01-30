<?php

namespace App\Controllers;

use App\Core\View;

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

    public function products(): void
    {
        new View("Admin/products", "frontAdmin");
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

            $data['site-name'] = $_POST['site-name'];
            $data['footer-text'] = $_POST['footer-text'];
            $data['footer-facebook'] = $_POST['facebook-url'];
            $data['footer-twitter'] = $_POST['twitter-url'];
            $data['footer-instagram'] = $_POST['instagram-url'];
            $data['home-text1'] = $_POST['home-text1'];
            $data['home-text2'] = $_POST['home-text2'];
            $data['home-text3'] = $_POST['home-text3'];
            $data['home-discover-text'] = $_POST['home-discover-text'];

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