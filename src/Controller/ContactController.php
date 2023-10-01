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

    private function captchaverify($recaptcha){
        
        $googleSecret = $_ENV["GOOGLE_CAPTCHA_SECRET"];
        
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$googleSecret&response=$recaptcha";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        
        $response = json_decode($response);

        return $response->success;        
    }
}
