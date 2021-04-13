<?php

// This library is built on top of PHPMailer

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require LIB_PATH.'PHPMailer'.DS.'Exception.php';

require LIB_PATH.'PHPMailer'.DS.'PHPMailer.php';

require LIB_PATH.'PHPMailer'.DS.'SMTP.php';

class email
{
    private $emailHost = EMAIL_HOST;
    private $emailPort = EMAIL_PORT;

    private $senderName = EMAIL_SENDER;
    private $username = EMAIL_USERNAME;
    private $password = EMAIL_PASSWORD;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function send($recipient_email, $recipient_name, $subject, $body)
    {
        try {
            $this->mail->setFrom($this->username, $this->senderName);
            $this->mail->addAddress($recipient_email, $recipient_name);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->isSMTP();
            $this->mail->Host = $this->emailHost;
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Username = $this->username;
            $this->mail->Password = $this->password;
            $this->mail->Port = $this->emailPort;
            $this->mail->send();
        } catch (Exception $e) {
            echo $e->errorMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function generateFromTemplate($template, ...$email_args)
    {
        require APP_PATH.'emails'.DS.$template.'.email.php';

        return [$subject, $body];
    }
}
