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
        }
    }

    protected function checkRole(int $role): bool
    {
        return $this->user !== null && $this->user->getRole() >= $role;
    }
}
