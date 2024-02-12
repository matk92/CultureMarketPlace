<?php

namespace App\Forms;

use App\Models\Payment;
use App\Models\PaymentMethod;

class PaymentForm
{
    private $countries = [
        "France" => "France",
        "Belgique" => "Belgique",
        "Luxembourg" => "Luxembourg",
        "Allemagne" => "Allemagne",
        "Italie" => "Italie",
        "Espagne" => "Espagne",
        "Portugal" => "Portugal",
        "Royaume-Uni" => "Royaume-Uni",
        "Irlande" => "Irlande",
        "Pays-Bas" => "Pays-Bas",
        "Danemark" => "Danemark",
        "Suède" => "Suède",
        "Finlande" => "Finlande",
        "Norvège" => "Norvège",
        "Suisse" => "Suisse",
        "Autriche" => "Autriche",
        "Grèce" => "Grèce",
        "Pologne" => "Pologne",
        "République Tchèque" => "République Tchèque",
        "Slovaquie" => "Slovaquie",
        "Hongrie" => "Hongrie",
        "Roumanie" => "Roumanie",
        "Bulgarie" => "Bulgarie",
        "Croatie" => "Croatie",
        "Slovénie" => "Slovénie",
        "Serbie" => "Serbie",
        "Bosnie-Herzégovine" => "Bosnie-Herzégovine",
        "Monténégro" => "Monténégro",
        "Macédoine du Nord" => "Macédoine du Nord",
        "Albanie" => "Albanie",
        "Kosovo" => "Kosovo",
        "Turquie" => "Turquie",
        "Russie" => "Russie",
        "Ukraine" => "Ukraine",
        "Biélorussie" => "Biélorussie",
        "Moldavie" => "Moldavie",
        "Lettonie" => "Lettonie",
        "Lituanie" => "Lituanie",
        "Estonie" => "Estonie",
        "Islande" => "Islande",
        "Îles Féroé" => "Îles Féroé",
        "Groenland" => "Groenland",
        "États-Unis" => "États-Unis",
        "Canada" => "Canada",
        "Mexique" => "Mexique",
        "Brésil" => "Brésil",
        "Argentine" => "Argentine",
        "Chili" => "Chili",
        "Colombie" => "Colombie"
    ];
    private ?PaymentMethod $paymentMethod;


    public function __construct(PaymentMethod $paymentMethod = null)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "delivery-payment-address-form",
                "id" => "form-payment",
                "submit" => "Enregistrer la commande",
                "error" => "Erreur lors de l'enregistrement de la commande"
            ],
            "inputs" => [
                "cardHolderName" => [
                    "class" => "step-titles",
                    "required" => true,
                    "type" => "text",
                    "placeholder" => "Jean Dupont",
                    "id" => "form-payment-cardHolderName",
                    "label" => "Nom du titulaire de la carte",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getCardHolderName() : "",
                ],
                "cardHolderAddress" => [
                    "class" => "step-titles",
                    "required" => true,
                    "type" => "address",
                    "id" => "form-payment-address",
                    "label" => "Adresse de facturation",
                    "placeholder" => "15 rue des lilas",
                    "pattern" => "[0-9]+[a-zA-Z ]+",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getCardHolderAddress() : "",
                ],
                "cardHolderZipCode" => [
                    "class" => "step-titles",
                    "minLength" => 5,
                    "maxLength" => 5,
                    "type" => "number",
                    "required" => true,
                    "label" => "Code postal",
                    "placeholder" => "75000",
                    "id" => "form-payment-zipCode",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getCardHolderZipCode() : "",
                ],
                "cardHolderCity" => [
                    "class" => "step-titles",
                    "type" => "text",
                    "required" => true,
                    "label" => "Ville",
                    "placeholder" => "Paris",
                    "id" => "form-payment-city",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getCardHolderCity() : "",
                ],
                "cardHolderCountry" => [
                    "class" => "step-titles",
                    "label" => "Pays",
                    "type" => "select",
                    "required" => true,
                    "options" => $this->countries,
                    "id" => "form-payment-country",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getCardHolderCountry() : "",
                ],
                "cardNumber" => [
                    "class" => "step-titles",
                    "type" => "text",
                    "minLength" => 19,
                    "maxLength" => 19,
                    "required" => true,
                    "pattern" => "[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}",
                    "label" => "Numéro de carte",
                    "id" => "form-payment-cardNumber",
                    "placeholder" => "1234 5678 1234 5678",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getCardNumber() : "",
                ],
                "expirationDate" => [
                    "class" => "step-titles",
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "MM/AA",
                    "label" => "Date d'expiration",
                    "pattern" => "[0-9]{2}/[0-9]{2}",
                    "id" => "form-payment-expirationDate",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getExpirationDate() : "",
                ],
                "securityCode" => [
                    "class" => "step-titles",
                    "minLength" => 3,
                    "maxLength" => 3,
                    "required" => true,
                    "type" => "number",
                    "placeholder" => "123",
                    "label" => "Cryptogramme visuel",
                    "id" => "form-payment-securityCode",
                    "defaultValue" => $this->paymentMethod ? $this->paymentMethod->getSecurityCode() : "",
                ],
                "savePaymentMethod" => [
                    "class" => "checkbox",
                    "type" => "checkbox",
                    "label" => "Enregistrer cette carte pour mes prochains achats",
                    "checked" => $this->paymentMethod ? $this->paymentMethod->getId() : "",
                    "id" => "form-payment-savePaymentMethod",
                ],
            ]
        ];
    }
}
