<?php

namespace App;

use App\Controllers\ConfigController;

// Fonction que se déclenche quand on instancie une class qui n'existe pas
spl_autoload_register(function ($class) {
    $file = str_replace("App\\", "", $class);
    $file = str_replace("\\", "/", $file);
    $file = "src/" . $file .  ".php";

    if (file_exists($file)) {
        include $file;
    } else {
        die("Le fichier " . $file . " n'existe pas");
    }
});

// Si le fichier .env n'existe pas, on le crée
if (file_exists('.env') == 0) {
    file_put_contents('.env', '');
}


// Function pour charger les variables d'environnement
function loadEnv($path)
{
    // Si le fichier n'existe pas, on arrete le script
    if (!file_exists($path)) {
        die('.env file does not exist');
    }

    // On recupere les lignes du fichier
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // On parcours les lignes
    foreach ($lines as $line) {
        // Si la ligne contient un =, on recupere le nom et la valeur de la variable
        if (str_contains($line, '=')) {
            list($name, $value) = explode('=', $line, 2);
            // On les ajoute dans les variables d'environnement
            $_ENV[$name] = $value;
        }
    }

    // si la config de la BDD n'est pas renseignée, on redirige vers la page de configuration de la BDD
    if(!array_key_exists('BDD_PREFIX', $_ENV) || !array_key_exists('POSTGRES_PASSWORD', $_ENV) || !array_key_exists('POSTGRES_DB', $_ENV) || !array_key_exists('POSTGRES_USER', $_ENV)){
        $configController = new ConfigController();
        $configController->setBDDconfig();
        exit();
    }

    // si la config du serveur mail n'est pas renseignée, on redirige vers la page de configuration du serveur mail
    if(!array_key_exists('SMTP_HOST', $_ENV) || !array_key_exists('SMTP_PORT', $_ENV) || !array_key_exists('SMTP_USERNAME', $_ENV) || !array_key_exists('SMTP_PASSWORD', $_ENV) || !array_key_exists('MAIL_ENCRYPTION', $_ENV)){
        $configController = new ConfigController();
        $configController->setMailConfig();
        exit();
    }
}

// Usage
loadEnv(__DIR__ . '/.env');

// On démarre la session
session_start();
// recupérer cookie "user"
if (isset($_COOKIE["user"])) {
    $_SESSION["user"] = $_COOKIE["user"];
}

// Recupérer l'URL
$uri = strtolower($_SERVER['REQUEST_URI']);
$uri = strtok($uri, '?');
if (strlen($uri) > 1)
    $uri = rtrim($uri, '/');

// Recupérer fichier yaml
$fileRoutes = "routes.yaml";
if (file_exists($fileRoutes)) {
    $yaml = yaml_parse_file($fileRoutes);
} else {
    die("Le fichier de routing n'existe pas");
}

$controllersPath = "src/Controllers/";

if (!empty($yaml[$uri])) {
    $match = $yaml[$uri];

    // Check if there is a controller in the route
    if (!empty($match["controller"])) {
        $controller = $match['controller'];
    } else {
        die("La route" . $match . " ne possède pas d'action dans le fichier " . $fileRoutes);
    }

    //  Check there is an action in the route
    if (!empty($match["action"])) {
        $action = $match['action'];
    } else {
        die("La route" . $match . " ne possède pas d'action dans le fichier " . $fileRoutes);
    }

    // Check if controller file exist
    if (file_exists($controllersPath . $controller . ".php")) {
        include $controllersPath . $controller . ".php";
        $controller = "App\\Controllers\\" . $controller;
        if (class_exists($controller)) {
            $object = new $controller();
            if (method_exists($object, $action)) {

                if (isset($match["method"])) {
                    $requestMethod = $_SERVER["REQUEST_METHOD"];
                    $acceptedMethod = explode("|", $match["method"]);
                    if (!in_array($requestMethod, $acceptedMethod)) {
                        // Method Not Allowed
                        include $controllersPath . "/ErrorController.php";
                        $controller = new Controllers\ErrorController();
                        $controller->page405();
                        die();
                    }
                }
                $object->$action();
            } else {
                die("L'action " . $action . "n'existe pas");
            }
        } else {
            die("La class controller " . $controller . "n'existe pas");
        }
    } else {
        die("Le fichier controller " . $controller . " n'existe pas");
    }
} else {
    // Not Found
    include $controllersPath . "/ErrorController.php";
    $controller = new Controllers\ErrorController();
    $controller->page404();
}
