<?php

namespace App\Core;

class Form
{

    protected $csrf_token;
    protected $config;
    protected $inputs = [];

    public function __construct()
    {
        $this->csrf_token = $this->generatecsrfToken();
    }


    private function generatecsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }


    public function getConfig(): array
    {
        if(!isset($this->csrf_token) || empty($this->csrf_token))
            die("Erreur lors de la génération du formulaire : Token CSRF invalide, assurez-vous d'incorporer le parent::__construct() dans le constructeur de votre formulaire");
        if(!isset($this->config) || empty($this->config))
            die("Erreur lors de la génération du formulaire : Configuration invalide, assurez-vous de configurer \$this->config dans le constructeur de votre formulaire");
        if(!isset($this->inputs) || empty($this->inputs))
            die("Erreur lors de la génération du formulaire : Inputs fields invalide, assurez-vous de configurer \$this->inputs dans le constructeur de votre formulaire");

        return [
            "config" => $this->config,
            "inputs" => [
                ...$this->inputs,
                "csrf_token" => [
                    "type" => "hidden",
                    "defaultValue" => $this->csrf_token
                ]
            ]
        ];
    }
}
