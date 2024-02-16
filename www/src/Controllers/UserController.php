<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Core\Security;
use App\Core\Controller;
use App\Forms\AccountRecover;
use App\Forms\UserInformation;
use App\Repository\UserRepository;


class UserController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function profile(): void
    {
        if ($_SESSION["user"]["id"] == null) {
            header('Location: /login');
            exit();
        }
        $view = new View("Admin/profile", "frontAdmin");
        $user = $this->userRepository->find($_SESSION["user"]["id"]);
        $form = new UserInformation($user);
        $formConfig = $form->getConfig();

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            if ($this->verificator->checkForm($formConfig, $_POST) === true) {
                $user->setFirstname($_POST["name"]);
                $user->setLastname($_POST["lastname"]);
                $user->save();

                $_SESSION["user"]["firstname"] = $user->getFirstname();
                $_SESSION["user"]["lastname"] = $user->getLastname();

                http_response_code(200);
            } else {
                http_response_code(409);
            }
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
        $view->assign("user", $user);
    }

    public function changeUserRole(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = $this->userRepository->find($_POST["id"]);

            if ($user) {
                $user->setRole($_POST["role"]);
                $user->save();
            }
        }

        header('Location: /admin/users');
        exit;
    }

    public function deleteUser(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

            $id = $_GET['id'];
            $hardDelete = $_GET['hardDelete'] == 'true' ? true : false;

            if (empty($id)) {
                http_response_code(400);
                header('Location: /profile');
                exit();
            }

            $user = $this->userRepository->find((int) $id);
            if (is_int($user) &&  $user == 0) {
                http_response_code(404);
                header('Location: /profile');
                exit();
            }

            $isSameUser = $user->getId() == $this->user->getId();
            // Seul un admin peut supprimer un autre utilisateur
            if ($isSameUser == false && $this->checkRole(User::_ROLE_ADMIN) == false) {
                http_response_code(403);
                header('Location: /profile');
                exit();
            }

            $user->setStatus(User::_STATUS_INACTIVE);
            $user->setRole(User::_ROLE_NONE);
            $user->delete($hardDelete);
            if ($isSameUser) {
                $this->security->logout();
                header('Location: /user/delete');
                exit();
            }

            http_response_code(200);
        } else {
            $view = (new View("User/accountDeleted", "adveritsement"));
            if (!is_null($this->user)) {
                $user = $this->userRepository->find($this->user->getId());
                $form = new AccountRecover($user);
                $formConfig = $form->getConfig();

                if ($_SERVER['REQUEST_METHOD'] === $formConfig['config']['method']) {
                    if ($this->verificator->checkForm($formConfig, $_POST)) {
                        $user->setIsdeleted(false);
                        $user->save();
                        header('Location: /');
                        exit();
                    } else
                        http_response_code(409);
                }

                $view->assign("form", $formConfig);
            }
        }
    }
}
