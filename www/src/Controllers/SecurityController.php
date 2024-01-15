<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Mailer;
use App\Forms\Login;
use App\Forms\Register;
use App\Forms\Verification;
use App\Models\User;

class SecurityController
{

    public function login(): int|bool
    {
        $form = new Login();
        $formConfig = $form->getConfig();

        $view = new View("Security/login", "frontSecurity");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = (new User())->getOneBy(["email" => $_POST["email"]], "object");

            // Verification si l'utilisateur existe et si le mot de passe est correct
            if (!$user || !password_verify($_POST["pwd"], $user->getPwd())) {
                $formConfig["config"]["errorMessage"] = "Email ou mot de passe incorrect";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            // Verification si le compte est activé
            if ($user->getStatus() === User::_STATUS_INACTIVE) {
                $_SESSION["email"] = $user->getEmail();
                http_response_code(200);
                return header("Location: /verification");
            }

            $_SESSION["user"] = [
                "id" => $user->getId(),
                "email" => $user->getEmail(),
                "firstname" => $user->getFirstName(),
                "lastname" => $user->getLastName(),
                "status" => $user->getStatus(),
                "role" => $user->getRole()
            ];
            http_response_code(204);
            return header("Location: /");
        }

        return http_response_code(200);
    }

    public function verification(): int|bool
    {
        // Si l'email de l'utilisateur n'est pas en session, on le redirige vers la page de connexion pour lui forcer à se connecter
        if (!isset($_SESSION["email"])) {
            return header("Location: /login");
        }

        $form = new Verification();
        $formConfig = $form->getConfig();

        $view = new View("Security/verification", "frontSecurity");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = (new User())->getOneBy(["verificationcode" => $_POST["code"], "email" => $_SESSION["email"]], "object");

            // Verification si l'utilisateur existe et si le mot de passe est correct
            if (!$user) {
                $formConfig["config"]["errorMessage"] = "Code de vérification incorrect";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }
            if ($user->getStatus() > User::_STATUS_INACTIVE) {
                $formConfig["config"]["errorMessage"] = "Ce compte est déjà activé";
                $view->assign("form", $formConfig);
                return http_response_code(403);
            }

            $user->setStatus(User::_STATUS_ACTIVE);
            $user->save();
            http_response_code(204);
            return header("Location: /");
        }
        return http_response_code(200);
    }

    public function logout(): void
    {
        session_destroy();
        new View("Security/logout", "frontSecurity");
    }

    public function register(): int|bool
    {
        $form = new Register();
        $formConfig = $form->getConfig();

        $view = new View("Security/register", "frontSecurity");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            // if its method GET
            return http_response_code(200);
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $exist = (new User())->getOneBy(["email" => $_POST["email"]], "object");

            // Verification si l'utilisateur existe et si le compte est activé
            if ($exist) {
                $formConfig["config"]["errorMessage"] = "Cet email est déjà utilisé";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }
            // Verification si les mots de passe correspondent
            if ($_POST['pwd'] !== $_POST['pwdConfirm']) {
                $formConfig["config"]["errorMessage"] = "Les mots de passe ne correspondent pas";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            // if its method POST && !exist
            $newUser = new User();
            $newUser->setFirstName($_POST["name"]);
            $newUser->setLastName($_POST["lastname"]);
            $newUser->setEmail($_POST["email"]);
            $newUser->setPwd($_POST["pwd"]);
            $newUser->save();
            $_SESSION["email"] = $newUser->getEmail();


            if (!$this->sendVerificationCode()) {
                $formConfig["config"]["errorMessage"] = "Erreur lors de l'envoi du mail de vérification";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            header("Location: /verification");
        }
    }

    public function sendVerificationCode(): int|bool
    {
        // Si l'email de l'utilisateur n'est pas en session, on le redirige vers la page de connexion pour lui forcer à se connecter
        if (!isset($_SESSION["email"])) {
            http_response_code(405);
            return header("Location: /login");
        }

        $user = (new User())->getOneBy(["email" => $_SESSION["email"]], "object");
        if (!$user) {
            http_response_code(404);
            return header("Location: /login");
        }

        $user->resetVerificationCode();
        $user->save();

        $mailer = new Mailer();
        // Envoyer code de verification pour l'activation du compte
        $succes = $mailer->sendMail(
            $user->getEmail(),
            "Activation de votre compte",
            "<body>Bonjour " . $user->getFirstName() . " " . $user->getLastName() .
                ",<br><br>Voici votre code de vérification : <b>" . $user->getVerificationcode() .
                "</b><br><br>Cordialement,<br>L'équipe de Cultural Market Place
                </body>"
        );

        http_response_code($succes ? 200 : 409);
        return $succes;
    }
}
