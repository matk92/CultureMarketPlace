<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\BDDconfig;
use App\Core\Verificator;
use App\Forms\EmailServerConfig;

class ConfigController
{

    public function welcome(): int|bool
    {
        new View("Config/welcome", "frontConfig");

        if ($_GET["start"] == "true") {
            file_put_contents('.env', '');
            http_response_code(204);
            header("Location: /");
            exit();
        }

        return http_response_code(200);
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
        } else if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            if ($verificatior->checkForm($formConfig, $_POST)) {
                $bddPrefix = strtolower($_POST['bddPrefix']);
                $bddPassword = $_POST['bddPassword'];
                $bddName = strtolower($_POST['bddName']);
                $bddUser = $_POST['bddUser'];

                $bddConfig = "BDD_PREFIX=$bddPrefix\nPOSTGRES_PASSWORD=$bddPassword\nPOSTGRES_DB=$bddName\nPOSTGRES_USER=$bddUser";

                $connection = new \PDO(
                    "pgsql:host=postgres;port=5432;dbname=cmp;user=root;password=123456"
                );

                $connection->exec("ALTER TABLE IF EXISTS rbnm_review RENAME TO " . $bddPrefix . "_review;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_user RENAME TO " . $bddPrefix . "_user;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_categorie RENAME TO " . $bddPrefix . "_categorie;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_product RENAME TO " . $bddPrefix . "_product;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_order_slot RENAME TO " . $bddPrefix . "_order_slot;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_order RENAME TO " . $bddPrefix . "_order;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_payement_method_type RENAME TO " . $bddPrefix . "_payement_method_type;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_payment_method RENAME TO " . $bddPrefix . "_payment_method;");
                $connection->exec("ALTER TABLE IF EXISTS rbnm_payment RENAME TO " . $bddPrefix . "_payment;");
                $connection = null; // Close the existing database connection

                $connection = new \PDO(
                    "pgsql:host=postgres;port=5432;dbname=cmp;user=root;password=123456"
                );

                // $connection->exec("ALTER DATABASE cmp RENAME TO " . $bddName . ";");
                // $connection = null; // Close the existing database connection
                // $connection = new \PDO(
                //     "pgsql:host=postgres;port=5432;dbname=" . $bddName . ";user=root;password=123456"
                // );
                // $connection->exec("CREATE USER " . $bddUser . " WITH ENCRYPTED PASSWORD '" . $bddPassword . "';");
                $connection->exec("GRANT ALL PRIVILEGES ON DATABASE cmp TO " . $bddUser . ";");
                $connection->exec("GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO " . $bddUser . ";");
                $connection->exec("GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO " . $bddUser . ";");
                $connection->exec("GRANT ALL PRIVILEGES ON ALL FUNCTIONS IN SCHEMA public TO " . $bddUser . ";");
                $connection = null; // Close the existing database connection
                $connection = new \PDO(
                    "pgsql:host=postgres;port=5432;dbname=cmp;user=" . $bddUser . ";password=" . $bddPassword . ""
                );

                $connection->exec("REVOKE ALL PRIVILEGES ON DATABASE cmp FROM root;");
                $connection->exec("REVOKE ALL PRIVILEGES ON ALL TABLES IN SCHEMA public FROM root;");
                $connection->exec("REVOKE ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public FROM root;");
                $connection->exec("REVOKE ALL PRIVILEGES ON ALL FUNCTIONS IN SCHEMA public FROM root;");

                file_put_contents('.env', $bddConfig);
                http_response_code(204);
                header("Location: /");
                exit();
            }

            // Si on arrive ici, c'est que le formulaire n'est pas valide
            $view->assign("form", $formConfig);
            return http_response_code(409);
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
        } else if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
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

            $mailConfig = "\n\nSMTP_HOST=$smtpHost\nSMTP_PORT=$smtpPort\nSMTP_ENCRYPTION=$smtpEncryption\nSMTP_USERNAME=$smtpUsername\nSMTP_PASSWORD=$smtpPassword";

            file_put_contents('.env', $mailConfig, FILE_APPEND);
            http_response_code(204);
            return header("Location: /");
        }
    }
}
