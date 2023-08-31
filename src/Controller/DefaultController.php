<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(Request $request, MailerInterface $mailer ): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            //dd($form->getData());
            $email = (new Email())
            ->from('contact@if-web-dev.com')
            ->to('contact@if-web-dev.com')
            //->cc('cc@example.com')
            ->bcc('ifwebdev@hotmail.com')
            //->replyTo($form->getData()['email'])
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Message concernant un '.$form->getData()['prestation'])
        /*->text( 
            'Madame ou monsieur: '.$form->getData()['fullName'].
            'E-mail du client: '.$form->getData()['email'].
            'Prestation demandée: '.$form->getData()['prestation'].
            'Intitulé du message: '.$form->getData()['message'])*/
            ->html(
                '<p>Madame ou monsieur: '.$form->getData()['fullName'].'</p>
                 <p>E-mail du client: '.$form->getData()['email'].'</p>
                 <p>Prestation demandée: '.$form->getData()['prestation'].'</p>
                 <p>Intitulé du message: '.$form->getData()['message'].'</p>')
            ;
    
            $mailer->send($email);
            $this->addFlash('success','Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_default');
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
