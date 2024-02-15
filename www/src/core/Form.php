<?php

namespace App\Core;

class Form
{

    protected $crsf_token;
    protected $config;
    protected $inputs = [];

    public function __construct()
    {
        $this->crsf_token = $this->generateCrsfToken();
    }


    private function generateCrsfToken()
    {
        if (empty($_SESSION['crsf_token'])) {
            $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['crsf_token'];
    }


    public function getConfig(): array
    {
        if(!isset($this->crsf_token) || empty($this->crsf_token))
            die("Erreur lors de la génération du formulaire : Token CSRF invalide, assurez-vous d'incorporer le parent::__construct() dans le constructeur de votre formulaire");
        if(!isset($this->config) || empty($this->config))
            die("Erreur lors de la génération du formulaire : Configuration invalide, assurez-vous de configurer \$this->config dans le constructeur de votre formulaire");
        if(!isset($this->inputs) || empty($this->inputs))
            die("Erreur lors de la génération du formulaire : Inputs fields invalide, assurez-vous de configurer \$this->inputs dans le constructeur de votre formulaire");

        return [
            "config" => $this->config,
            "inputs" => [
                ...$this->inputs,
                "crsf_token" => [
                    "type" => "hidden",
                    "defaultValue" => $this->crsf_token
                ]
            ]
        ];
    }
}
