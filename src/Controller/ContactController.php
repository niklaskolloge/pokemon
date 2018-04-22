<?php

namespace App\Controller;

use App\DataTransferObject\Enquiry;
use App\Form\EnquiryType;
use App\Services\MailerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerService $mailerService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, MailerService $mailerService)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);

        return $this->render('contact/index.html.twig', ['form' => $form->createView()]);
    }
}