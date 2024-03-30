<?php

namespace App\Service;

class SendGridService
{
    public $email;

    public function __construct()
    {
        $this->email = new \SendGrid\Mail\Mail();
    }

    public function sendMail($subject, $to, $data, $viewPath)
    {
        $this->email->setFrom(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));
        $this->email->setSubject($subject);
        $this->email->addTo($to);

        $this->email->addContent("text/html", view($viewPath, compact('data'))->render());

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        $sendgrid->send($this->email);
    }
}
