<?php
namespace App\Controller;
use Symfony\Component\Mime\Email;
use App\Repository\LessonRepository;
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
    #[Route('/home/contact', name: 'app_home_contact')]
    public function send(Request $request, MailerInterface $mailer): Response
    {
        if ($request->request->all()){
            $email = (new Email())
                    ->to('thoninoben@gamil.com')
                    ->from($request->request->get("email"))
                    ->subject($request->request->get("subject"))
                    ->text($request->request->get("message"))
                    ;
                    // dd($request->request->all());
            $mailer->send($email);
            $this->addFlash("success", "votre message a été envoyé");
            ;}
        return $this->render('home/contact.html.twig', [
        ]);
    }
    // #[Route('/home/contact', name: 'app_home_contact')]
    // public function send(MailerInterface $mailer): Response
    // {
    //     $email = (new Email())
    //         ->from('hello@example.com')
    //         ->to('thoninoben@gmail.com')
    //         ->subject('Time for Symfony Mailer!')
    //         ->text('Sending emails is fun again!')
    //         ->html('<p>See Twig integration for better HTML integration!</p>');
    //     $mailer->send($email);
    //     // dd($mailer);
    //     return $this->render('home/contact.html.twig', [
    //     ]);
    // }
}
