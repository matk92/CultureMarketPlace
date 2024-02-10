<?php

namespace App\Forms;


class PaymentForm
{
    private $countries = [
        "FR" => "France",
        "BE" => "Belgique",
        "LU" => "Luxembourg",
        "DE" => "Allemagne",
        "IT" => "Italie",
        "ES" => "Espagne",
        "PT" => "Portugal",
        "GB" => "Royaume-Uni",
        "IE" => "Irlande",
        "NL" => "Pays-Bas",
        "DK" => "Danemark",
        "SE" => "Suède",
        "FI" => "Finlande",
        "NO" => "Norvège",
        "CH" => "Suisse",
        "AT" => "Autriche",
        "GR" => "Grèce",
        "PL" => "Pologne",
        "CZ" => "République Tchèque",
        "SK" => "Slovaquie",
        "HU" => "Hongrie",
        "RO" => "Roumanie",
        "BG" => "Bulgarie",
        "HR" => "Croatie",
        "SI" => "Slovénie",
        "RS" => "Serbie",
        "BA" => "Bosnie-Herzégovine",
        "ME" => "Monténégro",
        "MK" => "Macédoine du Nord",
        "AL" => "Albanie",
        "XK" => "Kosovo",
        "TR" => "Turquie",
        "RU" => "Russie",
        "UA" => "Ukraine",
        "BY" => "Biélorussie",
        "MD" => "Moldavie",
        "LV" => "Lettonie",
        "LT" => "Lituanie",
        "EE" => "Estonie",
        "IS" => "Islande",
        "FO" => "Îles Féroé",
        "GL" => "Groenland",
        "US" => "États-Unis",
        "CA" => "Canada",
        "MX" => "Mexique",
        "BR" => "Brésil",
        "AR" => "Argentine",
        "CL" => "Chili",
        "CO" => "Colombie"
    ];

    public function __construct()
    {
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
                    "class" => "",
                    "required" => true,
                    "type" => "text",
                    "placeholder" => "Jean Dupont",
                    "id" => "form-payment-cardHolderName",
                    "label" => "Nom du titulaire de la carte",
                ],
                "cardHolderAddress" => [
                    "class" => "",
                    "required" => true,
                    "type" => "address",
                    "id" => "form-payment-address",
                    "label" => "Adresse de facturation",
                    "placeholder" => "15 rue des lilas",
                    "pattern" => "[0-9]+[a-zA-Z ]+",
                ],
                "cardHolderZipCode" => [
                    "class" => "",
                    "minLength" => 5,
                    "maxLength" => 5,
                    "type" => "number",
                    "required" => true,
                    "label" => "Code postal",
                    "placeholder" => "75000",
                    "id" => "form-payment-zipCode",
                ],
                "cardHolderCity" => [
                    "class" => "",
                    "type" => "text",
                    "required" => true,
                    "label" => "Ville",
                    "placeholder" => "Paris",
                    "id" => "form-payment-city",
                ],
                "cardHolderCountry" => [
                    "class" => "",
                    "label" => "Pays",
                    "type" => "select",
                    "required" => true,
                    "options" => $this->countries,
                    "id" => "form-payment-country",
                ],
                "cardNumber" => [
                    "class" => "",
                    "type" => "text",
                    "minLength" => 19,
                    "maxLength" => 19,
                    "required" => true,
                    "pattern" => "[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}",
                    "label" => "Numéro de carte",
                    "id" => "form-payment-cardNumber",
                    "placeholder" => "1234 5678 1234 5678",
                ],
                "expirationDate" => [
                    "class" => "",
                    "type" => "text",
                    "required" => true,
                    "placeholder" => "MM/AA",
                    "label" => "Date d'expiration",
                    "pattern" => "[0-9]{2}/[0-9]{2}",
                    "id" => "form-payment-expirationDate",
                ],
                "securityCode" => [
                    "class" => "",
                    "minLength" => 3,
                    "maxLength" => 3,
                    "required" => true,
                    "type" => "number",
                    "placeholder" => "123",
                    "label" => "Cryptogramme visuel",
                    "id" => "form-payment-securityCode",
                ],
                "savePaymentMethod" => [
                    "class" => "checkbox",
                    "type" => "checkbox",
                    "label" => "Enregistrer cette carte pour mes prochains achats",
                    "id" => "form-payment-savePaymentMethod",
                ],
            ]
        ];
    }
}
