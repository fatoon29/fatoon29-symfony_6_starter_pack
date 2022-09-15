<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()):
            $notification->notify($contact);
            return $this->redirectToRoute('contact_success');
        endif;

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/contact-success', name: 'contact_success')]
    public function contactSuccess()
    {
        return $this->render('contact/contact-success.html.twig');
    }
}
