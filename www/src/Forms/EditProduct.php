<?php

namespace App\Forms;

use App\Core\Form;
use App\Models\Product;

class EditProduct extends Form
{


    public function __construct(Product $product, $categories)
    {
        if(!isset($product) || !isset($categories)){
            throw new \Exception("Erreur lors de la création du formulaire de modification de produit, veuillez renseigner un produit et une liste de catégories");
        }

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
                "defaultValue" => $product->getName(),
                "placeholder" => "Pommes de terre",
            ],
            "image" => [
                "label" => "Image du produit (Laissez vide pour conserver l\'image actuelle)",
                "type" => "file",
                "class" => "input-admin_products",
                "id" => "form-edit-product-image",
                "placeholder" => "Image du produit",
                "defaultValue" => $product->getImage(),
                "accept" => "image/*"
            ],
            "price" => [
                "label" => "Prix du produit",
                "type" => "number",
                "class" => "input-admin_products",
                "id" => "form-edit-product-price",
                "required" => true,
                "defaultValue" => $product->getPrice(),
                "placeholder" => "€ 29,99",
            ],
            "categoryid" => [
                "label" => "Catégorie du produit",
                "type" => "select",
                "class" => "input-admin_products",
                "id" => "form-config-category",
                "required" => true,
                "defaultValue" => $product->getCategoryid(),
                "options" => $categoriesOptions,
            ],
            "stock" => [
                "label" => "Stock du produit",
                "type" => "number",
                "class" => "input-admin_products",
                "id" => "form-edit-product-stock",
                "required" => true,
                "defaultValue" => $product->getStock(),
                "placeholder" => "20",
            ],
            "description" => [
                "label" => "Description du produit",
                "type" => "textarea",
                "class" => "input-admin_products",
                "id" => "form-edit-product-description",
                "required" => true,
                "defaultValue" => $product->getDescription(),
                "placeholder" => "Description du produit",
            ],
        ];
        parent::__construct();
    }
}
