<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require LIB_PATH.'Exception.php';

require LIB_PATH.'PHPMailer.php';

require LIB_PATH.'SMTP.php';

class email
{
    private $username = EMAIL_USERNAME;
    private $password = EMAIL_PASSWORD;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function send($recipient_email, $recipient_name, $subject, $body)
    {
        try {
            $this->mail->setFrom('slmosys.aesn38@gmail.com', 'Sri Lanka Maths Olympiad');
            $this->mail->addAddress($recipient_email, $recipient_name);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Username = $this->username;
            $this->mail->Password = $this->password;
            $this->mail->Port = 587;
            $this->mail->send();
        } catch (Exception $e) {
            echo $e->errorMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function generateTemplate($template, ...$email_args)
    {
        require APP_PATH.'emails'.DS.$template.'.email.php';

        return [$subject, $body];
    }
}
