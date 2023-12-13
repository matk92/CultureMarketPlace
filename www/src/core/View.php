<?php

namespace App\Core;

class View
{

    private String $view;
    private String $template;
    private array $data = [];

    public function __construct(string $view, string $template = "back")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view): void
    {
        $view = "src/Views/" . $view . ".view.php";
        if (!file_exists($view)) {
            die("la vue n'existe pas :" . $view);
        }
        $this->view = $view;
    }

    public function setTemplate($template): void
    {
        $template = "src/Views/Templates/" . $template . ".tpl.php";
        if (!file_exists($template)) {
            die("le template n'existe pas :" . $template);
        }
        $this->template = $template;
    }

    public function assign(String $key, $value): void
    {
        $this->data[$key]=$value;
    }

    public function modal(string $name, array $config): void
    {
        $modal = "src/Views/Modals/".$name.".php";
        if(!file_exists($modal)){
            die("le modal n'existe pas :".$modal);
        }
        include $modal;
    }

    public function __destruct()
    {
        // Permet d'extraire les données du tableau $data et de les transformer en variables
        extract($this->data);
        include $this->template;
    }
}
