<?php

namespace App\Forms;

class AddProduct
{

    private $categories = [];

    public function __construct(array $categories)
    {
        foreach ($categories as $category) {
            $this->categories[$category->getId()] = $category->getName() . " - " . $category->getUnit();
        }
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "form",
                "id" => "form-product",
                "submit" => "Ajouter produit",
                "enctype" => "multipart/form-data",
                "error" => "Erreur lors de l'ajout du produit"
            ],
            "inputs" => [
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
                    "required" => true,
                    "placeholder" => "€ 29,99",
                ],
                "category" => [
                    "label" => "Catégorie du produit",
                    "type" => "select",
                    "class" => "input-admin_products",
                    "id" => "form-config-category",
                    "required" => true,
                    "options" => $this->categories,
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
            ]
        ];
    }
}
