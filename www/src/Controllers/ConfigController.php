<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Forms\BDDconfig;
use App\Core\Verificator;
use App\Forms\Adminconfig;
use App\Forms\EmailServerConfig;

class ConfigController
{

    public function welcome(): int|bool
    {
        new View("Config/welcome", "frontConfig");

        if (isset(($_GET["start"])) && $_GET["start"] == "true") {
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

                if ($bddPrefix !== "rbnm") {
                    $connection = new \PDO(
                        "pgsql:host=postgres;port=5432;dbname=cmp;user=root;password=123456"
                    );

                    $connection->exec("ALTER TABLE IF EXISTS rbnm_review RENAME TO " . $bddPrefix . "_review;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_user RENAME TO " . $bddPrefix . "_user;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_category RENAME TO " . $bddPrefix . "_category;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_product RENAME TO " . $bddPrefix . "_product;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_order_slot RENAME TO " . $bddPrefix . "_order_slot;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_order RENAME TO " . $bddPrefix . "_order;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_payement_method_type RENAME TO " . $bddPrefix . "_payement_method_type;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_payment_method RENAME TO " . $bddPrefix . "_payment_method;");
                    $connection->exec("ALTER TABLE IF EXISTS rbnm_payment RENAME TO " . $bddPrefix . "_payment;");
                    $connection = null; // Close the existing database connection
                }

                $connection = new \PDO(
                    "pgsql:host=postgres;port=5432;dbname=cmp;user=root;password=123456"
                );

                // $connection->exec("ALTER DATABASE cmp RENAME TO " . $bddName . ";");
                // $connection = null; // Close the existing database connection
                // $connection = new \PDO(
                //     "pgsql:host=postgres;port=5432;dbname=" . $bddName . ";user=root;password=123456"
                // );
                $checkUserQuery = "SELECT 1 FROM pg_roles WHERE rolname = :username";
                $checkUserStatement = $connection->prepare($checkUserQuery);
                $checkUserStatement->bindValue(':username', $bddUser);
                $checkUserStatement->execute();

                if (!$checkUserStatement->fetchColumn()) {
                    $createUserQuery = "CREATE USER " . $bddUser . " WITH ENCRYPTED PASSWORD '" . $bddPassword . "';";
                    $connection->exec($createUserQuery);
                }
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
            $verificatior = new Verificator();
            if ($verificatior->checkForm($formConfig, $_POST)) {
                $smtpHost = explode(",", $_POST['smtpHost'])[0];
                $smtpPort = explode(",", $_POST['smtpHost'])[1];
                $smtpEncryption = explode(",", $_POST['smtpHost'])[2];
                $smtpUsername = $_POST['smtpUsername'];
                $smtpPassword = $_POST['smtpPassword'];

                $mailConfig = "\n\nSMTP_HOST=$smtpHost\nSMTP_PORT=$smtpPort\nSMTP_ENCRYPTION=$smtpEncryption\nSMTP_USERNAME=$smtpUsername\nSMTP_PASSWORD=$smtpPassword";

                file_put_contents('.env', $mailConfig, FILE_APPEND);
                http_response_code(204);
                return header("Location: /");
            }
            // Si on arrive ici, c'est que le formulaire n'est pas valide
            $view->assign("form", $formConfig);
            return http_response_code(409);
        }
    }

    // Set admin configuration in .env based on user input
    public function setAdminConfig(): int|bool
    {
        $form = new Adminconfig();
        $formConfig = $form->getConfig();

        $view = new View("Config/admin_config", "frontInstaller");
        $view->assign("form", $formConfig);

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            // if its method GET
            return http_response_code(200);
        } else if ($_SERVER["REQUEST_METHOD"] === $formConfig["config"]["method"]) {
            $verificatior = new Verificator();
            if ($verificatior->checkForm($formConfig, $_POST)) {
                $pageTitle = $_POST['pageTitle'];
                // TODO : change site title in config

                $newUser = new User();
                $newUser->setFirstName($_POST["firstName"]);
                $newUser->setLastName($_POST["lastname"]);
                $newUser->setEmail($_POST["email"]);
                $newUser->setPwd($_POST["pwd"]);
                $newUser->save();
                $_SESSION["email"] = $_POST["email"];
                $adminConfig = "\n\nADMIN_FIRSTNAME=" . $_POST['firstName'] . "\nADMIN_LASTNAME=" . $_POST['lastname'] . "\nADMIN_EMAIL=" . $_POST['email'];
                file_put_contents('.env', $adminConfig, FILE_APPEND);


                // On essaie d'envoyer le mail de vérification
                if (!(new SecurityController())->sendVerificationCode()) {
                    $formConfig["config"]["errorMessage"] = "Erreur lors de l'envoi du mail de vérification, veuillez réessayer.";
                } else {
                    http_response_code(200);
                    header("Location: /verification");
                    exit();
                }
            }
            // Si on arrive ici, c'est que le formulaire n'est pas valide
            $view->assign("form", $formConfig);
            return http_response_code(409);
        }
    }
}
