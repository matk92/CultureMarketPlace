<?php

namespace App\Controllers;

use App\Core\View;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;

class ProductController
{

    public function index(): int
    {
        $_GET['filter'] = $_GET['filter'] ?? 0;

        $view = new View("Product/products", "front");
        $products = (new ProductRepository())->getAllByCategory($_GET['filter']);
        $filters = (new CategoryRepository())->getAll();

        $view->assign("products", $products);
        $view->assign("filters", $filters);
        return http_response_code(200);
    }

    public function delete(): void
    {
        $id = $_GET['id'];

        if (empty($id)) {
            http_response_code(400);
            header('Location: /admin/products');
            exit();
        }

        if(!(new ProductRepository())->delete($id)) {
            http_response_code(500);
            header('Location: /admin/products');
            exit();
        }

        header('Location: /admin/products');
        http_response_code(200);
    }
}
