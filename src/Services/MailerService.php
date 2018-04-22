<?php

namespace App\Services;

use App\DataTransferObject\Enquiry;

class MailerService
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendContactMail(Enquiry $enquiry)
    {
        $message = (new \Swift_Message('Kontakformular'))
            ->setFrom('seminar@bogdanfinn.de')
            ->setTo('niklas.kolloge@gmail.com')
            ->setBody($this->createEmailBody($enquiry));
        $this->mailer->send($message);
    }

    private function createEmailBody(Enquiry $enquiry)
    {
        $name = $enquiry->getName();
        $email = $enquiry->getEmail();
        $subject = $enquiry->getSubject();
        $body = $enquiry->getBody();

        return "Eine Kontakanfrage wurde erstellt von $name.
        
        E-Mail Adresse: $email
        Betreff: $subject
        
        Nachricht: 
        $body";
    }
}