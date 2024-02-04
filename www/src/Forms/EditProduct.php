<?php

namespace App\Forms;

class EditProduct
{

    private $categories = [];

    public function __construct($categories)
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
                "id" => "form-edit-product",
                "submit" => "Enregistrer les modifications",
                "enctype" => "multipart/form-data",
                "error" => "Erreur lors de la modification du produit"
            ],
            "inputs" => [
                "name" => [
                    "label" => "Nom du produit",
                    "type" => "text",
                    "class" => "input-admin_products",
                    "id" => "form-edit-product-name",
                    "required" => true,
                    "placeholder" => "Pommes de terre",
                ],
                "image" => [
                    "label" => "Image du produit (Laissez vide pour conserver l\'image actuelle)",
                    "type" => "file",
                    "class" => "input-admin_products",
                    "id" => "form-edit-product-image",
                    "placeholder" => "Image du produit",
                    "accept" => "image/*"
                ],
                "price" => [
                    "label" => "Prix du produit",
                    "type" => "number",
                    "class" => "input-admin_products",
                    "id" => "form-edit-product-price",
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
                    "id" => "form-edit-product-stock",
                    "required" => true,
                    "placeholder" => "20",
                ],
                "description" => [
                    "label" => "Description du produit",
                    "type" => "textarea",
                    "class" => "input-admin_products",
                    "id" => "form-edit-product-description",
                    "required" => true,
                    "placeholder" => "Description du produit",
                ],
            ]
        ];
    }
}
