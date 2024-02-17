<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Forms\AddCategory;
use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{

    protected CategoryRepository $categoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = new CategoryRepository();
    }



    public function index()
    {
        $view = new View("Admin/categories", "frontAdmin");
        $form = new AddCategory();
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            if ($this->verificator->checkForm($formConfig, $_POST) === true) {
                $newCategory = $this->serializer->serialize($_POST, Category::class);
                $newCategory->save();

                $view->assign("added", true);
                http_response_code(200);
            } else {
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }

        $categories = $this->categoryRepository->getAll();
        $view->assign("categories", $categories);
        $view->assign("form", $formConfig);
    }



    public function delete(): void
    {
        $id = $_GET['id'];

        if (empty($id)) {
            http_response_code(400);
            header('Location: /admin/products');
            exit();
        }

        $category = $this->categoryRepository->find((int) $id);
        if (is_int($category) && $category == 0) {
            http_response_code(404);
            header('Location: /admin/category');
            exit();
        }

        $category->delete();

        header('Location: /admin/category');
        http_response_code(200);
    }
}
