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
        // création du mail
        $email = (new Email())
            ->from($user->getUser()->getEmail())
            ->to('carre.HelpInfo@free.fr')
            ->subject('Confirmation rendez-vous de formation')
            ->text('Madame, Monsieur, Merci de bien vouloir me confirmer mon créneau horaire choisi. Cordialement.');
        // envoi du mail et confirmation   
        $mailer->send($email);
        $this->addFlash('Un email de confirmation vous a été envoyé sur votre adresse de contact.');
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }
}
