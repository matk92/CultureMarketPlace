<?php

namespace App\Core;

use App\Models\User;
use App\Core\Serializer;
use App\Core\Verificator;
use App\Repository\UserRepository;

class Controller
{
    protected Serializer $serializer;
    protected Verificator $verificator;
    protected Security $security;
    protected ?User $user = null;
    protected Mailer $mailer;
    protected string $siteName = "CMP";

    public function __construct()
    {
        $this->serializer = new Serializer();
        $this->verificator = new Verificator();
        $this->security = new Security();
        $this->mailer = new Mailer();

        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $this->user = (new UserRepository())->find($_SESSION['user']['id']);

            // Si l'utilisateur n'existe pas, on force la deconnexion
            if (is_int($this->user) && $this->user = 0) {
                $this->security->logout();
                exit();
            }
            // On met à jour les informations de l'utilisateur
            if ($this->user != null) {
                $_SESSION["user"] = [
                    "id" => $this->user->getId(),
                    "email" => $this->user->getEmail(),
                    "firstname" => $this->user->getFirstName(),
                    "lastname" => $this->user->getLastName(),
                    "status" => $this->user->getStatus(),
                    "role" => $this->user->getRole()
                ];
            }
        }

        if(file_exists(__DIR__ . '/../Views/Main/home.json')){
            $json = file_get_contents(__DIR__ . '/../Views/Main/home.json');
            $data = json_decode($json, true);
            if($data['site-name'] !== null){
                $this->siteName = $data['site-name'];
            }
        }
    }

    protected function checkRole(int $role): bool
    {
        return $this->user !== null && $this->user->getRole() >= $role;
    }
}
