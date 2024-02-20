<?php

namespace App;

use App\Controllers\ConfigController;
use App\Controllers\ErrorController;

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

// On démarre la session
session_start();


// Methode pour charger les variables d'environnement
// Si les variables d'environnement ne sont pas renseignées, on redirige vers les page de configuration correspondantes
function loadEnv($path)
{
    // Si le fichier n'existe pas, c'est que le projet n'est pas configuré et on affiche la page de welcome
    if (!file_exists($path)) {
        $configController = (new ConfigController())->welcome();
        exit();
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
    if (!array_key_exists('BDD_PREFIX', $_ENV) || !array_key_exists('POSTGRES_PASSWORD', $_ENV) || !array_key_exists('POSTGRES_DB', $_ENV) || !array_key_exists('POSTGRES_USER', $_ENV)) {
        $configController = new ConfigController();
        $configController->setBDDconfig();
        exit();
    }

    // si la config du serveur mail n'est pas renseignée, on redirige vers la page de configuration du serveur mail
    if (!array_key_exists('SMTP_HOST', $_ENV) || !array_key_exists('SMTP_PORT', $_ENV) || !array_key_exists('SMTP_USERNAME', $_ENV) || !array_key_exists('SMTP_PASSWORD', $_ENV) || !array_key_exists('SMTP_ENCRYPTION', $_ENV)) {
        $configController = new ConfigController();
        $configController->setMailConfig();
        exit();
    }

    // si la config de l'admin n'est pas renseignée, on redirige vers la page de configuration de l'admin
    if (!array_key_exists('ADMIN_FIRSTNAME', $_ENV) || !array_key_exists('ADMIN_LASTNAME', $_ENV) || !array_key_exists('ADMIN_EMAIL', $_ENV)) {
        $configController = new ConfigController();
        $configController->setAdminConfig();
        exit();
    }
}

loadEnv(__DIR__ . '/.env');

// Si on a un cookie user et que la session user n'existe pas, ça veut dire que l'utilisateur a coché "se souvenir de moi"
// On recupere les informations du cookie et on les ajoute dans la session
if (isset($_COOKIE["user"]) && !isset($_SESSION["user"])) {
    $_SESSION["user"] = json_decode($_COOKIE["user"], true);
}

// Recupération et nettoyage de l'uri
$uri = strtok(strtolower($_SERVER['REQUEST_URI']), '?');
if (strlen($uri) > 1)
    $uri = rtrim($uri, '/');

// Recupérer fichier yaml
$fileRoutes = "routes.yaml";
if (file_exists($fileRoutes)) {
    // On as toujours un erreur "Undefined" car le library yaml est installé dans le docker file
    $yaml = yaml_parse_file($fileRoutes);
} else {
    die("Le fichier de routing n'existe pas ! pas le bonne emplacement ? " . $fileRoutes);
}


if (!empty($yaml[$uri])) {
    $match = $yaml[$uri];

    // Check if there is a controller in the route
    if (empty($match["controller"])) {
        die("La route" . $match . " ne possède pas d'action dans le fichier " . $fileRoutes);
    }
    //  Check there is an action in the route
    if (empty($match["action"])) {
        die("La route" . $match . " ne possède pas d'action dans le fichier " . $fileRoutes);
    }
    $controller = "App\\Controllers\\" . $match["controller"];
    // Check if controller exist
    if (!class_exists($controller)) {
        die("La class controller " . $controller . " n'existe pas");
    }
    $controller = new $controller();
    $action = $match["action"];
    // Check if action exist
    if (!method_exists($controller, $action)) {
        die("L'action " . $action . " dans le controller " . $match["controller"] . " n'existe pas");
    }

    // On verifie la methode de la requete
    if (isset($match["method"])) {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $acceptedMethod = explode(" | ", $match["method"]);
        if (in_array($requestMethod, $acceptedMethod) === false) {
            (new ErrorController())->page405();
            die();
        }
    }
    // On verifie le role de l'utilisateur
    if (isset($match["role"])) {
        if (!isset($_SESSION["user"]) || (int) $_SESSION["user"]["role"] < (int) $match["role"]) {
            (new ErrorController())->page403();
            die();
        }
    }

    $controller->$action();
} else {
    // On prend tous les routes dans le fichier routes.yaml qui contiennent des paramètres (":")
    $paramRoutes = array_filter($yaml, function ($key) {
        return strpos($key, ":") !== false;
    }, ARRAY_FILTER_USE_KEY);

    // On essaye de trouver une route qui correspond à l'uri
    foreach ($paramRoutes as $path => $params) {
        // On prend le debut de la route
        $fixedRoute = explode(":", $path)[0];
        // On verifie si la route commence par le debut de la route
        if (strpos($uri, $fixedRoute) === 0) {
            $route = $path;
            $match = $params;
            break;
        }
    }

    // Si on a trouvé une route on essaye de recuperer les informations, sinon on affiche une page 404
    if (isset($match) && isset($route)) {
        $paramName = explode(":", $route)[1];
        $paramValue = str_replace("-", " ", explode($fixedRoute, $uri)[1]);
        // Pour trouver le repository on a besoin  de respecter la convention de nommage de la route
        // Il faut que la premmiere partie de la route soit le prefix du repository
        $repositoryName = "App\\Repository\\" . ucfirst(trim($fixedRoute, "/")) . "Repository";

        // On verifie que le parametre et la valeur ne sont pas vide et que le repository existe
        if (!empty($paramName) && !empty($paramValue) && class_exists($repositoryName)) {
            // On instancie le repository
            $repository = new $repositoryName();
            // On recupere l'objet
            $object = $repository->findOneBy([$paramName => $paramValue]);
            // On verifie que l'objet existe et que la route contient un controller et une action
            if (!empty($object) && is_object($object) && !empty($match['controller']) && !empty($match['action'])) {
                $controller = "App\\Controllers\\" . $match['controller'];
                // On verifie que le controller existe
                if (!class_exists($controller)) {
                    die("La class controller " . $controller . " n'existe pas");
                }
                $controller = new $controller();
                $action = $match['action'];
                // On verifie que l'action existe
                if (!method_exists($controller, $action)) {
                    die("L'action " . $action . " n'existe pas");
                }
                $controller->$action($object);
            } else (new ErrorController())->page405();
        } else (new ErrorController())->page404();
    } else (new ErrorController())->page404();
}
