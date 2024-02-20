<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Controller;

class MainController extends Controller
{

    public function home(): void
    {
        new View("Main/home", "front");
    }

    public function generateSitemap()
    {
        $yaml = yaml_parse_file("routes.yaml");
        $routes = [];
        foreach ($yaml as $key => $value) {
            // On prend pas en compte la route sitemap.xml
            if ($key === "/sitemap.xml") continue;
            // Si la route a un role ça veut dire que c'est une route protégée donc on ne l'ajoute pas
            if (array_key_exists("role", $value)) continue;
            // Si la route a une methode et que ce n'est pas GET on ne l'ajoute pas
            if ((array_key_exists("method", $value) && !str_contains("GET", $value["method"]))) continue;

            // Si la route a un parametre on va chercher les données dans la base de données pour construire les routes
            if (str_contains($key, ":")) {
                // on recupere le nom de la route
                $fixedRoute = explode(":", $key)[0];
                // on recupere le nom du parametre
                $getParam = 'get' . ucfirst(explode(":", $key)[1]);
                // on recupere le nom du repository
                $repositoryName = "App\\Repository\\" . ucfirst(trim($fixedRoute, "/")) . "Repository";
                $repository = new $repositoryName();
                // On recupere tous les objets (s'il y un propriété isdeleted on ne prend pas en compte les objets supprimés)
                $data = $repository->findAll();

                // On construit les routes et si on trouve une date de modification on l'ajoute
                foreach ($data as $item) {
                    $route = [
                        "path" => $fixedRoute . str_replace(" ", "-", $item->$getParam())
                    ];

                    // Si l'objet a une methode getUpdatedAt on l'ajoute pour la date de modification
                    if (method_exists($item, "getUpdatedAt") || method_exists($item, "getInsertedAt")) {
                        $route["lastmod"] = $item->getUpdatedAt() ?? $item->getInsertedAt();
                    }
                    if (method_exists($item, "getImage")) {
                        $route["image"] = $item->getImage();
                    }

                    $routes[] = $route;
                }
            } else {
                $routes[] = [
                    "path" => $key
                ];
            }
        }


        $file = new \DOMDocument();
        $file->formatOutput = true;

        $urlset = $file->createElement("urlset");
        $urlset->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
        $file->appendChild($urlset);

        foreach ($routes as $route) {
            $url = $file->createElement("url");
            $loc = $file->createElement("loc", "https://" . $_SERVER["HTTP_HOST"] . $route["path"]);
            $url->appendChild($loc);
            $urlset->appendChild($url);
            if (array_key_exists("lastmod", $route)) {
                $lastmod = $file->createElement("lastmod", $route["lastmod"]);
                $url->appendChild($lastmod);
            }
            if (array_key_exists("image", $route)) {
                $image = $file->createElement("image:image");
                $url->appendChild($image);
                $imageLoc = $file->createElement("image:loc", "https://" . $_SERVER["HTTP_HOST"] . "/" . $route["image"]);
                $image->appendChild($imageLoc);
            }
        }
        if (is_dir("tmp") === false) {
            mkdir("tmp", 0777, true);
        }
        if (file_exists("tmp/sitemap.xml")) {
            unlink("tmp/sitemap.xml");
        }
        $file->save("tmp/sitemap.xml");

        header("Content-Type: application/xml");
        readfile("tmp/sitemap.xml");
    }

    public function copyright(): void
    {
        new View("legal/copyright", "front");
    }

    public function legal(): void
    {
        new View("legal/legalTerms", "front");
    }

    public function privacy(): void
    {
        new View("legal/privacyPolicy", "front");
    }

    public function refund(): void
    {
        new View("legal/refundPolicy", "front");
    }

    public function terms(): void
    {
        new View("legal/termsConditionsSales", "front");
    }
}