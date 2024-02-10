<?php

namespace App\Forms;


class ValidatePaymentForm
{
    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "payment-validate-form",
                "id" => "form-validate",
                "submit" => "Valider la commande",
                "error" => "Erreur lors de la validation de la commande"
            ],
            "inputs" => [
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
            ]
        ];
    }
}
