<?php

namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification
{
    private $renderer;
    private $mailer;

    public function __construct(Environment $renderer, MailerInterface $mailer)
    {
        $this->renderer = $renderer;
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact)
    {
        $message = (new TemplatedEmail())
            ->from('fatoon29@gmail.com')
            ->to('fatoon29@gmail.com')
            ->subject($contact->getSubject())
            ->replyTo($contact->getEmail())
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact,
            ]);
        
        
        $this->mailer->send($message);
    }

}
