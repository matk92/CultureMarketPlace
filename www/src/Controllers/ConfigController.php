<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\BDDconfig;
use App\Forms\EmailServerConfig;

class ConfigController
{

    public function Welcome(): void
    {
        new View("Config/welcome", "frontConfig");
    }

    // Set bdd configuration in .env based on user input
    public function setBDDconfig(): int|bool
    {
        $form = new BDDconfig();
        $formConfig = $form->getConfig();

        $view = new View("Config/BDD_config", "frontInstaller");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            // if its method GET
            return http_response_code(200);
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $bddPrefix = strtolower($_POST['bddPrefix']);
            $bddPassword = $_POST['bddPassword'];
            $bddName = strtolower($_POST['bddName']);
            $bddUser = $_POST['bddUser'];

            if (empty($bddPrefix) || empty($bddPassword) || empty($bddName) || empty($bddUser)) {
                $formConfig["config"]["errorMessage"] = "Veuillez remplir tous les champs";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (!preg_match('/^[a-z0-9_]+$/', $bddPrefix)) {
                $formConfig["config"]["errorMessage"] = "Le prefix de la base de données ne doit contenir que des lettres minuscules, des chiffres et des underscores";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (!preg_match('/^[a-z0-9_]+$/', $bddName)) {
                $formConfig["config"]["errorMessage"] = "Le nom de la base de données ne doit contenir que des lettres minuscules, des chiffres et des underscores";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (!preg_match('/^[a-z0-9_]+$/', $bddUser)) {
                $formConfig["config"]["errorMessage"] = "Le nom de l'utilisateur ne doit contenir que des lettres minuscules, des chiffres et des underscores";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (strlen($bddPrefix) > 10) {
                $formConfig["config"]["errorMessage"] = "Le prefix de la base de données ne doit pas dépasser 10 caractères";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (strlen($bddName) > 10) {
                $formConfig["config"]["errorMessage"] = "Le nom de la base de données ne doit pas dépasser 10 caractères";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (strlen($bddPrefix) < 3) {
                $formConfig["config"]["errorMessage"] = "Le prefix de la base de données doit contenir au moins 3 caractères";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (strlen($bddName) < 3) {
                $formConfig["config"]["errorMessage"] = "Le nom de la base de données doit contenir au moins 3 caractères";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            $bddConfig = "BDD_PREFIX=$bddPrefix\nPOSTGRES_PASSWORD=$bddPassword\nPOSTGRES_DB=$bddName\nPOSTGRES_USER=$bddUser";

            file_put_contents('.env', $bddConfig);
            http_response_code(204);
            return header("Location: /");
        }
    }

    // Set mail configuration in .env based on user input
    public function setMailConfig(): int|bool
    {
        $form = new EmailServerConfig();
        $formConfig = $form->getConfig();

        $view = new View("Config/email_config", "frontInstaller");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            // if its method GET
            return http_response_code(200);
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $smtpHost = $_POST['smtpHost'];
            $smtpPort = $_POST['smtpPort'];
            $smtpEncryption = $_POST['smtpEncryption'];
            $smtpUsername = $_POST['smtpUsername'];
            $smtpPassword = $_POST['smtpPassword'];

            if (empty($smtpHost) || empty($smtpPort) || empty($smtpUsername) || empty($smtpPassword)) {
                $formConfig["config"]["errorMessage"] = "Veuillez remplir tous les champs";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (!preg_match('/^[0-9]+$/', $smtpPort)) {
                $formConfig["config"]["errorMessage"] = "Le port ne doit contenir que des chiffres";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            if (!preg_match('/^[a-zA-Z0-9_]+$/', $smtpEncryption)) {
                $formConfig["config"]["errorMessage"] = "Le type d'encryption ne doit contenir que des lettres minuscules, des lettres majuscules, des chiffres et des underscores";
                $view->assign("form", $formConfig);
                return http_response_code(409);
            }

            $mailConfig = "\n\nSMTP_HOST=$smtpHost\nSMTP_PORT=$smtpPort\nMAIL_ENCRYPTION=$smtpEncryption\nSMTP_USERNAME=$smtpUsername\nSMTP_PASSWORD=$smtpPassword";

            file_put_contents('.env', $mailConfig, FILE_APPEND);
            http_response_code(204);
            return header("Location: /");
        }
    }
}
