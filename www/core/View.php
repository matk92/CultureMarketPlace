<?php

namespace App\Core;

class View
{

    private String $view;
    private String $template;

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

    public function __destruct()
    {
        include $this->template;
    }
}
