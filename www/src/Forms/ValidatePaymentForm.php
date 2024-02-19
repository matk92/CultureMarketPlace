<?php

namespace App\Forms;

use App\Core\Form;

class ValidatePaymentForm extends Form
{
    public function __construct()
    {
        $this->config = [
            "method" => "POST",
            "action" => "",
            "class" => "payment-validate-form",
            "id" => "form-validate",
            "submit" => "Valider la commande",
            "errorMessage" => "Veuillez accepter les conditions de remboursement et de vente",
        ];
        $this->inputs = [
            "refundConditions" => [
                "required" => true,
                "class" => "checkbox",
                "type" => "checkbox",
                "id" => "form-validate-refundConditions",
                "label" => "J’a lu et j’accepte les politiques de remboursement",
            ],
            "salesConditions" => [
                "required" => true,
                "type" => "checkbox",
                "class" => "checkbox",
                "id" => "form-validate-salesConditions",
                "label" => "J’a lu et j’accepte les conditions générales de vente",
            ],
        ];
        parent::__construct();
    }
}
