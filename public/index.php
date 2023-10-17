<?php

use App\Controllers\Error;

// Recupérer l'URL
$path = "/" . trim($_GET['path'], '/');
// Recupérer fichier yaml
$fileRoutes = "routes.yaml";
if (file_exists($fileRoutes)) {
    $yaml = yaml_parse_file($fileRoutes);
} else {
    die("Le fichier de routing n'existe pas");
}

if (!empty($yaml[$path])) {
    $match = $yaml[$path];

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
    if (file_exists("Controllers/" . $controller . ".php")) {
        include "Controllers/" . $controller . ".php";
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
    include "Controllers/Error.php";
    $controller = new Error();
    $controller->page404();
}
