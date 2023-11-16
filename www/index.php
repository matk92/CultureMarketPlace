<?php

namespace App;

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
}

// Usage
loadEnv(__DIR__ . '/.env');

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
