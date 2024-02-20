<?php

namespace App\Forms;

use App\Core\Form;
use App\Models\Category;

class AddCategory extends Form
{

    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "form-category",
            "id" => "form-category",
            "submit" => "Ajouter categorie",
            "errorMessage" => "Erreur lors de l'ajout de une categorie"
        ];
        $this->inputs = [
            "name" => [
                "label" => "Nom de la categorie",
                "type" => "text",
                "class" => "input-category",
                "id" => "form-category-name",
                "required" => true,
                "minLength" => 3,
                "maxLength" => 50,
                "placeholder" => "Legumes",
                "unicity" => Category::class,
            ],
            "amount" => [
                "label" => "Quantite",
                "type" => "number",
                "class" => "input-category",
                "id" => "form-category-amount",
                "required" => true,
                "defaultValue" => 1,
                "min" => 1,
                "placeholder" => "1",
                "max" => 10000,
            ],
            "unit" => [
                "label" => "Unité",
                "type" => "select",
                "class" => "input-category",
                "id" => "form-category-unit",
                "required" => true,
                "placeholder" => "Kg",
                "options" => [
                    "Kg" => "Kilogrammes",
                    "g" => "Grammes",
                    "L" => "Litres",
                    "cl" => "Centilitres",
                    "ml" => "Millilitres",
                    "piece" => "Pièce",
                    "cm" => "Centimètres",
                    "m" => "Mètres"
                ]
            ]
        ];

        parent::__construct();
    }
}
