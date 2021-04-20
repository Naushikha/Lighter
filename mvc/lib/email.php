<?php

// This is an example for a library that you can use in Lighter
// Built on top of PHPMailer

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require LIB_PATH.'PHPMailer'.DS.'Exception.php';

require LIB_PATH.'PHPMailer'.DS.'PHPMailer.php';

require LIB_PATH.'PHPMailer'.DS.'SMTP.php';

class email
{
    private $emailHost;
    private $emailPort;

    private $senderName;
    private $username;
    private $password;

    public function __construct()
    {
        lighterLoadConfig('email');
        $this->emailHost = EMAIL_HOST;
        $this->emailPort = EMAIL_PORT;

        $this->senderName = EMAIL_SENDER;
        $this->username = EMAIL_USERNAME;
        $this->password = EMAIL_PASSWORD;
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
