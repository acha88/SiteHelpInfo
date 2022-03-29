<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{
    /**
     * @Route("/email", name="mail")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        
        
              
        $mailer->send($email);
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }
}
