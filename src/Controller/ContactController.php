<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {

        $contactForm = $this->createForm(ContactType::class);

        $contactForm->handleRequest($request);

        if($contactForm->isSubmitted()) {
            dd($_COOKIE);
        }

        return $this->render(view: 'contact/index.html.twig', parameters: [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
