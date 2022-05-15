<?php

namespace App\Controller;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Repository\LessonRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(LessonRepository $lessonRepo): Response
    {
        return $this->render('home/index.html.twig', [
            'lessons' => $lessonRepo->findAll(),
        ]);
    }

    // #[Route('/home/contact', name: 'app_home_contact')]
    // public function email(Request $request, MailerInterface $mailer): Response
    // {
    //     if ($request->request->all()){
    //         $email = (new Email())
    //                 ->to('thoninoben@gamil.com')
    //                 ->from($request->request->get("email"))
    //                 ->subject($request->request->get("subject"))
    //                 ->text($request->request->get("message"))
    //                 ;
    //                 dd($request->request->all());
    //         $mailer->send($email);
    //         $this->addFlash("success", "votre message a été envoyé");
    //         ;}
    //     return $this->render('home/contact.html.twig', [
    //     ]);
    // }

    #[Route('/home/contact', name: 'app_home_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        
        // $transport = Transport::fromDsn('smtp://localhost');
        // $mailer = new Mailer($transport);

        $mail = (new TemplatedEmail())
        ->from(new Address('expediteur@demo.test', 'Mon nom'))
        ->to('destinataire@demo.test')
        ->subject('Mon beau sujet')
        ->htmlTemplate('mail/template.html.twig')
;
            $this->addFlash("success", "votre message a été envoyé");
            return $this->render('home/contact.html.twig', [
    

//         $email = (new Email())
//         ->from('hello@example.com')
//         ->to('thoninobizira@gmail.com')
//         ->subject('Time for Symfony Mailer!')
//         ->text('Sending emails is fun again!')
//         ->html('<p>See Twig integration for better HTML integration!</p>');
//         // dd($request->request->all());
//         if ($request){$mailer->send($email);}
//         $this->addFlash("success", "votre message a été envoyé");
//         return $this->render('home/contact.html.twig', [

        ]);
    }
}
