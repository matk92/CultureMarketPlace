<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Mailer;
use App\Core\Security;
use App\Core\Verificator;
use App\Forms\Login;
use App\Forms\Register;
use App\Forms\Verification;
use App\Models\User;

class SecurityController
{

    public function login()
    {
        $form = new Login();
        $formConfig = $form->getConfig();

        $view = new View("Security/login", "frontSecurity");

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {

            $verificatior = new Verificator();
            if ($verificatior->checkForm($formConfig, $_POST)) {
                $security = new Security();
                $user = null;

                // On verifie si l'utilisateur existe et si le mot de passe est correct
                if (!$security->login($_POST, $user)) {
                    $formConfig["config"]["errorMessage"] = "Identifiants incorrects";
                    $view->assign("form", $formConfig);
                    return http_response_code(409);
                } else if ($user->getStatus() === User::_STATUS_INACTIVE) {
                    // Si l'utilisateur n'a pas activé son compte, on le redirige vers la page de verification
                    $_SESSION["email"] = $user->getEmail();
                    http_response_code(200);
                    return header("Location: /verification");
                } else {
                    // L'utilisateur est connecté, on le redirige vers la page d'accueil
                    $_SESSION["user"] = [
                        "id" => $user->getId(),
                        "email" => $user->getEmail(),
                        "firstname" => $user->getFirstName(),
                        "lastname" => $user->getLastName(),
                        "status" => $user->getStatus(),
                        "role" => $user->getRole()
                    ];

                    // Si l'utilisateur a coché la case "Rester connecté", on stocke ses informations en cookie
                    if (isset($_POST["remember"])) {
                        setcookie("user", json_encode($_SESSION["user"]), time() + 3600 * 24 * 30, "/");
                    }

                    http_response_code(204);
                    return header("Location: /");
                }
            }

            // Si on arrive ici, c'est que le formulaire n'est pas valide
            http_response_code(409);
        } else {
            http_response_code(200);
        }

        $view->assign("form", $formConfig);
    }

    public function verification(): int|bool
    {
        // Si l'email de l'utilisateur n'est pas en session, on le redirige vers la page de connexion pour lui forcer à se connecter
        if (!isset($_SESSION["email"])) {
            header("Location: /login");
            exit();
        }

        $form = new Verification();
        $formConfig = $form->getConfig();
        $view = new View("Security/verification", "frontSecurity");

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            if ($verificatior->checkForm($formConfig, $_POST)) {
                $user = (new User())->getOneBy(["verificationcode" => $_POST["code"], "email" => $_SESSION["email"]], "object");

                // Verification si l'utilisateur existe et si le mot de passe est correct
                if ($user->getStatus() > User::_STATUS_INACTIVE) {
                    $formConfig["config"]["errorMessage"] = "Ce compte est déjà activé, veuillez vous connecter.";
                    $view->assign("form", $formConfig);
                    return http_response_code(403);
                }
                if (!$user) {
                    $formConfig["config"]["errorMessage"] = "Code de vérification incorrect.";
                    $view->assign("form", $formConfig);
                    return http_response_code(409);
                }

                $user->setStatus(User::_STATUS_ACTIVE);
                $user->save();
                http_response_code(204);
                header("Location: /login");
                exit();
            }

            // Si on arrive ici, c'est que le formulaire n'est pas valide
            $view->assign("form", $formConfig);
            return http_response_code(409);
        }

        $view->assign("form", $formConfig);
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

        if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();

            // On vérifie que le formulaire est valide
            if ($verificatior->checkForm($formConfig, $_POST) === true) {
                $newUser = new User();
                $newUser->setFirstName($_POST["name"]);
                $newUser->setLastName($_POST["lastname"]);
                $newUser->setEmail($_POST["email"]);
                $newUser->setPwd($_POST["pwd"]);

                // On stocke l'email de l'utilisateur en session pour la vérification
                $newUser->save();
                $_SESSION["email"] = $newUser->getEmail();

                // On essaie d'envoyer le mail de vérification
                if (!$this->sendVerificationCode()) {
                    $formConfig["config"]["errorMessage"] = "Erreur lors de l'envoi du mail de vérification, veuillez réessayer.";
                } else {
                    $view->assign("form", $formConfig);
                    header("Location: /verification");
                    exit();
                }
            } else {
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }
        }

        $view->assign("form", $formConfig);
        return http_response_code(200);
    }

    public function sendVerificationCode()
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
