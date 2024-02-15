<?php

namespace App\Forms;

use App\Core\Form;
use App\Models\Category;
use App\Models\Product;

class AddProductToCart extends Form
{


    public function __construct(Product $product, Category $category)
    {
        $this->config = [
            "method" => "POST",
            "action" => "/orders/add_product",
            "class" => "form",
            "id" => "form-oreder-add-product",
            "submit" => "Ajouter au panier",
            "error" => "Erreur lors de l'ajout du produit au panier"
        ];
        
        $this->inputs = [
            "productid" => [
                "type" => "hidden",
                "defaultValue" => $product->getId()
            ],
            "quantity" => [
                "label" => "Quantité (" . $category->getUnit() . ")",
                "type" => "number",
                "class" => "input-admin_products",
                "min" => "1",
                "max" => $product->getStock(),
                "id" => "form-oreder-add-product-quantity",
                "required" => true,
                "placeholder" => "1" . $category->getUnit()
            ],
        ];
        parent::__construct();

    }
}
