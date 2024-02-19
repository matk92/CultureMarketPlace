<?php

namespace App\Forms;

use App\Core\Form;

class AddProduct extends Form
{

    public function __construct(array $categories)
    {
        $categoriesOptions = [];
        foreach ($categories as $category) {
            $categoriesOptions[$category->getId()] = $category->getName() . " - " . $category->getUnit();
        }

        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form",
            "id" => "form-product",
            "submit" => "Ajouter produit",
            "enctype" => "multipart/form-data",
            "errorMessage" => "Erreur lors de l'ajout du produit"
        ];
        $this->inputs = [
            "name" => [
                "label" => "Nom du produit",
                "type" => "text",
                "class" => "input-admin_products",
                "id" => "form-product-name",
                "required" => true,
                "placeholder" => "Pommes de terre",
                "unicity" => "App\Models\Product",
            ],
            "image" => [
                "label" => "Image du produit",
                "type" => "file",
                "class" => "input-admin_products",
                "id" => "form-product-image",
                "required" => true,
                "placeholder" => "Image du produit",
                "accept" => "image/*"
            ],
            "price" => [
                "label" => "Prix du produit",
                "type" => "number",
                "class" => "input-admin_products",
                "id" => "form-product-price",
                "step" => "0.01",
                "required" => true,
                "placeholder" => "€ 29,99",
            ],
            "categoryid" => [
                "label" => "Catégorie du produit",
                "type" => "select",
                "class" => "input-admin_products",
                "id" => "form-config-category",
                "required" => true,
                "options" => $categoriesOptions,
            ],
            "stock" => [
                "label" => "Stock du produit",
                "type" => "number",
                "class" => "input-admin_products",
                "id" => "form-product-stock",
                "required" => true,
                "placeholder" => "20",
            ],
            "description" => [
                "label" => "Description du produit",
                "type" => "textarea",
                "class" => "input-admin_products",
                "id" => "form-product-description",
                "required" => true,
                "placeholder" => "Description du produit",
            ],
        ];
        parent::__construct();
        
    }
}
