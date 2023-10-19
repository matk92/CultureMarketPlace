<?php

namespace App;

spl_autoload_register(function ($class) {
    $file = str_replace("App\\", "", $class);
    $file = str_replace("\\", "/", $file);
    $file .= ".php";
    if (file_exists($file)) {
        include $file;
    } else {
        die("Le fichier " . $file . " n'existe pas");
    }
});

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
    include $controllersPath . "/Error.php";
    $controller = new Controllers\Error();
    $controller->page404();
}
