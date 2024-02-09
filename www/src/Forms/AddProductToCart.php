<?php

namespace App\Forms;

use App\Models\Product;

class AddProductToCart
{

    private $product;
    private $category;

    public function __construct($product,$category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/orders/add_product",
                "class" => "form",
                "id" => "form-oreder-add-product",
                "submit" => "Ajouter au panier",
                "error" => "Erreur lors de l'ajout du produit au panier"
            ],
            "inputs" => [
                "productid" => [
                    "type" => "hidden",
                    "defaultValue" => $this->product->getId()
                ],
                "quantity" => [
                    "label" => "Quantité (" . $this->category->getUnit() . ")",
                    "type" => "number",
                    "class" => "input-admin_products",
                    "min" => "1",
                    "max" => $this->product->getStock(),
                    "id" => "form-oreder-add-product-quantity",
                    "required" => true,
                    "placeholder" => "1" . $this->category->getUnit()
                ],
            ]
        ];
    }
}
