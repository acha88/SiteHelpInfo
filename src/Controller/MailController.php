<?php

namespace App\Controller;

use App\Form\EmailType;
use App\Entity\Planning;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{
    /**
    * @Route("/agenda", name="mail")
    */
    public function mail_agenda(Request $request, EntityManagerInterface $manager): Response
    {
        $planning = new Planning();
        $form = $this->createForm(EmailType::class, $planning);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($planning);
            $manager->flush();
            return $this->redirectToRoute('email');
        }
        return $this->render('mail/mail_agenda.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    protected $mailer;
    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $this->mailer = $mailer;
        // création du mail
        $email = new TemplatedEmail();
        $email->from(Address::create('exemple@exemple.com'))
            ->to('mail@exemple.com')
            ->subject('Demande de rendez-vous sur le site web')
            ->htmlTemplate('mail/_sendEmail.html.twig');
        // envoi du mail et confirmation   
        $mailer->send($email);
        return $this->render('mail/succes.html.twig');
    }

    
}
