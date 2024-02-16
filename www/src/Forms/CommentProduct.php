<?php

namespace App\Forms;

use App\Core\Form;
use App\Models\Product;

class CommentProduct extends Form
{


    public function __construct(Product $product)
    {
        $this->config = [
            "method" => "POST",
            "action" => "/product/comment",
            "class" => "form-comment-product",
            "id" => "form-comment-product",
            "submit" => "Commenter",
            "error" => "Erreur lors de l'ajout commentaire"
        ];

        $this->inputs = [
            "productid" => [
                "type" => "hidden",
                "defaultValue" => $product->getId()
            ],
            "stars" => [
                "required" => true,
                "label" => "Note (sur 5)",
                "type" => "number",
                "class" => "input-comment-product",
                "min" => 0,
                "max" => 5,
                "id" => "form-comment-product-stars",
                "placeholder" => "Notez le produit"
            ],
            "comment" => [
                "required" => true,
                "label" => "Ajouter un commentaire",
                "type" => "textarea",
                "class" => "input-comment-product",
                "maxLenght" => 255,
                "id" => "form-comment-product-comment",
                "placeholder" => "Le produit " . $product->getName() . " est super !"
            ],
        ];

        parent::__construct();
    }
}
