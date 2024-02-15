<?php

namespace App\Forms;

use App\Core\Form;

class EditProduct extends Form
{


    public function __construct($categories)
    {
        parent::__construct();
        $categoriesOptions = [];
        foreach ($categories as $category) {
            $categoriesOptions[$category->getId()] = $category->getName() . " - " . $category->getUnit();
        }

        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form",
            "id" => "form-edit-product",
            "submit" => "Enregistrer les modifications",
            "enctype" => "multipart/form-data",
            "error" => "Erreur lors de la modification du produit"
        ];
        $this->inputs = [
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
                "options" => $categoriesOptions,
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
        ];
    }
}
