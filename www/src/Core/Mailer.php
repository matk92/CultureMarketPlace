<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mailer
{
    private $mail;

    public function __construct()
    {
        if (isset($_ENV['SMTP_HOST']) && isset($_ENV['SMTP_USERNAME']) && isset($_ENV['SMTP_PASSWORD']) && isset($_ENV['SMTP_ENCRYPTION']) && isset($_ENV['SMTP_PORT'])) {
            $this->mail = new PHPMailer(true);
            //Server settings
            $this->mail->isSMTP();
            $this->mail->Host       = $_ENV['SMTP_HOST'];
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = $_ENV['SMTP_USERNAME'];
            $this->mail->Password   = $_ENV['SMTP_PASSWORD'];
            $this->mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION'];
            $this->mail->Port       = $_ENV['SMTP_PORT'];
        }
    }

    public function sendMail($to, $subject, $body): bool
    {
        $json = file_get_contents(__DIR__ . '/../Views/Main/home.json');
        $data = json_decode($json, true);
        try {
            //Recipients
            $this->mail->setFrom($_ENV['SMTP_USERNAME'], $data['site-name']);
            $this->mail->addAddress($to);

            //Content
            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = strip_tags($body);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            // echo $e->getMessage();
            return false;
        }
    }
}
